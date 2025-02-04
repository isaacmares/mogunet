<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pago;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientesImport;


class ClientesController extends Controller
{
    public function index($id)
    {
        $clientes = Cliente::where('site_id', $id)->paginate(100);  
        return view('clientes.index', compact('clientes', 'id'));
    }
    public function create($id)
    {
         $ultimoCliente = Cliente::where('site_id', $id)->orderBy('no_cliente', 'desc')->first();
    
         if ($ultimoCliente) {
            $ultimoNoCliente = strval($ultimoCliente->no_cliente); 
            $noClienteSiguiente = str_pad((int)$ultimoNoCliente + 1, strlen($ultimoNoCliente), '0', STR_PAD_LEFT);
        } else {
             $noClienteSiguiente = '2025010001';
        }
    
         if ($ultimoCliente && $ultimoCliente->ip) {
             $ultimaIp = ip2long($ultimoCliente->ip);
    
             $siguienteIp = long2ip($ultimaIp + 1);
        } else {
             $siguienteIp = '192.168.0.1'; 
        }
    
         return view('clientes.create', compact('noClienteSiguiente', 'siguienteIp', 'id'));
    }
    
    public function store(Request $request){
        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->no_cliente = $request->no_cliente;
        $cliente->pago = $request->pago;
        $cliente->ip = $request->ip_cliente;
        $cliente->fecha_pago = $request->fecha_pago;
        $cliente->site_id = $request->site_id;
        $cliente->save();
        return redirect()->route('clientes.index', ['id' => $request->site_id])
                             ->with('success', 'Cliente creado correctamente.');

    }
    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',  
        ]);
         $file = $request->file('file');
         $path = $file->storeAs('import', $file->getClientOriginalName(), 'public');
         if ($file->isValid()) {
             $fullPath = storage_path('app/public/' . $path);
            Excel::import(new ClientesImport($request->site_id), $fullPath);
             return redirect()->route('clientes.index', ['id' => $request->site_id])
                             ->with('success', 'Clientes importados correctamente.');
        }
        return back()->with('error', 'No se cargó ningún archivo válido.');
    }
    
    public function pago(Request $request){
 
    $pago = new Pago();
    $pago -> id_cliente = $request->id_cliente;
    $pago -> amount = $request->amount;
    $pago -> payment_date = $request->payment_date;
    $pago -> payment_method = $request->payment_method;
    $pago -> save();
    return back()->with('success', 'Pago guardado.');
    }

    public function Pagos($id){
    $cliente = Cliente::find($id);
    $pagos = Pago::where('id_cliente', $id)->get();
    return view('clientes.pagos', compact('cliente', 'pagos'));
    }
 
}
