<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_salas extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "ris_salas";

    protected $fillable = [
        'codigo',
        'sede_id',
        'modalidad_id',
        'aetitle',
        'nombre',
        'idestado'

    ];



    protected $casts = [
        'id' => 'string',
        'sede_id' => 'string',
        'modalidad_id' => 'string'
    ];
}
