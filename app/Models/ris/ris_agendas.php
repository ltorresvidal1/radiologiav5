<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_agendas extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'sede_id',
        'sala_id',
        'fechainicial',
        'horainicial',
        'fechafinal',
        'horafinal',
        'dias',
        'idestado'

    ];

    protected $casts = [
        'id' => 'string',
        'sede_id' => 'string',
        'sala_id' => 'string'
    ];
}
