<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_convenios extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "convenios";

    protected $fillable = [
        'codigo',
        'nit',
        'dv',
        'nombre',
        'direccion',
        'telefono',
        'idestado'

    ];

    protected $casts = [
        'id' => 'string'
    ];
}
