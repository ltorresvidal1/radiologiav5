<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transito extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "transito";

    protected $fillable = [
        'idsios',
        'admision',
        'fecha',
        'paciente_id',
        'unidadfuncional',
        'cantidad',
        'medico_id',
        'sede_id',
        'convenio_id',
        'estudio_id',
        'procedencia',
        'idestado'
    ];

    protected $casts = [
        'id' => 'string',
        'paciente_id' => 'string',
        'medico_id' => 'string',
        'sede_id' => 'string',
        'convenio_id' => 'string',
        'estudio_id' => 'string',
    ];
}
