<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_pacientes extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "ris_pacientes";

    protected $fillable = [
        'idtipoid',
        'documento',
        'primernombre',
        'segundonombre',
        'primerapellido',
        'segundoapellido',
        'fechanacimiento',
        'idsexo',
        'direccion',
        'barrio',
        'celular',
        'telefono',
        'correo',
        'idestado'

    ];



    protected $casts = [
        'id' => 'string',
    ];
}
