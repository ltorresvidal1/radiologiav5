<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ris_agendados extends Model
{
    use HasFactory;
    protected $table = "ris_agendados";

    protected $fillable = [
        'serviciotransito_id',
        'administradora',
        'admision',
        'numero_orden',
        'medico_id',
    ];

    protected $casts = [
        'medico_id' => 'string',
    ];
}
