<?php
namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientesImport implements ToModel, WithHeadingRow
{
    public $siteId;

    public function __construct($siteId)
    {
        $this->siteId = $siteId;
    }

    public function model(array $row)
    {
        // Eliminar espacios adicionales en los encabezados
        $row = array_map('trim', $row);

         
        // Ahora que has eliminado los espacios, accede a las columnas sin error
        return new Cliente([
            'nombre' => $row[1],      // Primera columna (CLIENTE)
            'no_cliente' => $row[2],  // Segunda columna (NO. CLIENTE)
            'fecha_pago' => $row[3],  // Tercera columna (FECHA DE PAGO)
            'pago' => $row[4],        // Cuarta columna (PAGO)
            'ip' => request()->ip(), // IP del usuario
            'site_id' => $this->siteId, // El site_id que recibes
        ]);
    }
}
