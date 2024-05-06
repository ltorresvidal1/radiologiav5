<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_citas extends Model
{
    use HasFactory;
    use HasUuids;


    protected $fillable = [
        'sede_id',
        'sala_id',
        'medico_id',
        'paciente_id',
        'convenio_id',
        'fecha',
        'hora',
        'comentarios',
        'fechadeseada',
        'prioridad',

    ];

    protected $casts = [
        'id' => 'string',
        'sede_id' => 'string',
        'sala_id' => 'string',
        'medico_id' => 'string',
        'paciente_id' => 'string',
        'convenio_id' => 'string',
    ];
}
