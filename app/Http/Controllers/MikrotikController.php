<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Mikrotik;
use phpseclib3\Net\SSH2;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;  

class MikrotikController extends Controller
{
    public function index(Request $request)
{
    $site = Site::find($request->site_id);
    $mikrotiks = Mikrotik::where('id_site', $request->site_id)->get();

     function pingAddress($host, $port, $timeout = 2)
    {
        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if ($connection) {
            fclose($connection);
            return true;  
        }
        return false;  
    }

     foreach ($mikrotiks as $mikrotik) {
        $host = "mogunet.gdcwisp.com";  
        $port = $mikrotik->puerto;  
        $mikrotik->status = pingAddress($host, $port) ? 'En línea' : 'No responde';
    }

    return view('router.index', compact('mikrotiks', 'site'));
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'id_site' => 'required|integer',
    ]);

    $subred = "192.168."; 
    $site_id = $request->id_site; 
    $base_ip = $subred . $site_id . ".";  

    for ($i = 2; $i < 254; $i++) {  
        $nueva_ip = $base_ip . $i;

        if (!Mikrotik::where('ip', $nueva_ip)->exists()) {
            $ip_asignada = $nueva_ip;
            break;
        }
    }

    if (!isset($ip_asignada)) {
        return response()->json(['error' => 'No hay IPs disponibles en la subred'], 400);
    }

    do {
        $puerto = rand(2000, 65000);
    } while (Mikrotik::where('puerto', $puerto)->exists());

    $router = new Mikrotik;
    $router->nombre = $request->nombre;
    $router->id_site = $request->id_site;
    $router->usuario = $request->user;
    $router->pass = $request->pass;

    $router->ip = $ip_asignada;
    $router->puerto = $puerto;
    
    $mikrotik_ip = env('CHR_DOMAIN'); 
    $mikrotik_user =  env('CHR_USER');
    $mikrotik_pass =  env('CHR_PASS');

    $site = Site::where('id', $request->id_site)->first();

    try {
        $ssh = new SSH2($mikrotik_ip);

        if (!$ssh->login($mikrotik_user, $mikrotik_pass)) {
            return response()->json(['error' => 'Error de autenticación en MikroTik'], 401);
        }

        $comando = "/ip firewall nat add chain=dstnat action=dst-nat protocol=tcp dst-port={$puerto} to-address={$ip_asignada} to-port=22 comment={$request->nombre}";
        $comando2 = "/ppp secret add name={$request->nombre} password=MOGU_3456TIK service=ovpn remote-address={$ip_asignada} local-address=192.168.1.1";
        
        $ssh->exec($comando);
        $ssh->exec($comando2);

        $router->save();
        return redirect()->route('dashboard')->with('success', 'Guardado correctamente.');

    } catch (\Exception $e) {
        return redirect()->route('dashboard')->with('error', 'Contacta a soporte.');
    }
    
    return redirect()->route('dashboard')->with('error', 'Contacta a soporte.');
}
 
 
public function clientes_corte()
{
    // Obtener la fecha actual usando Carbon
    $fecha_actual = Carbon::now()->toDateString(); // Formato 'Y-m-d'

    // Iniciar una transacción para garantizar la integridad de los datos
    DB::beginTransaction();

    try {
        // Consultar clientes con fecha de pago vencida
        $clientes_cortados = DB::table('clientes')
            ->where('fecha_pago', '<', $fecha_actual)
            ->where('estado', '!=', 'cortado') // Evitar actualizar clientes ya cortados
            ->get();

        // Agrupar clientes por site_id
        $clientes_por_mikrotik = [];
        foreach ($clientes_cortados as $cliente) {
            $clientes_por_mikrotik[$cliente->site_id][] = $cliente;
        }


        // Recorrer cada grupo de clientes por MikroTik
        foreach ($clientes_por_mikrotik as $site_id => $clientes) {
            // Obtener la información del MikroTik
            $mikrotik = DB::table('mikrotiks')
                ->where('id', $site_id)
                ->first();
            $chr = 'mogunet.gdcwisp.com';
        
            if ($mikrotik) {
                // Conectar al MikroTik via SSH
                $ssh = new SSH2($chr, $mikrotik->puerto); // IP y puerto del MikroTik
                if (!$ssh->login($mikrotik->usuario, $mikrotik->pass)) {
                    throw new \Exception("Error al conectar al MikroTik {$mikrotik->ip}");
                }

                // Enviar las IPs de los clientes cortados al MikroTik
                foreach ($clientes as $cliente) {
                    if (!empty($cliente->ip)) {
                        $comando = "/ip firewall address-list add list=Corte  address={$cliente->ip}";
                        $ssh->exec($comando);
                    }
                }
            }
        }

        // Actualizar el estado de los clientes cortados
              DB::table('clientes')
             ->where('fecha_pago', '<', $fecha_actual)
             ->where('estado', '!=', 'cortado')
             ->update(['estado' => 'cortado']);

         // Confirmar la transacción
         DB::commit();

        return response()->json([
            'mensaje' => 'Corte realizado correctamente',
            'clientes_cortados' => $clientes_cortados, // Lista de clientes actualizados
        ]);
    } catch (\Exception $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();

        return response()->json([
            'mensaje' => 'Error al realizar el corte',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}
