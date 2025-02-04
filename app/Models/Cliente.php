<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'no_cliente',
        'fecha_pago',
        'pago',
        'ip',
        'site_id',
    ];
}
