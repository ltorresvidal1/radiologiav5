<?php

namespace App\Models\lecturas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class lecturas extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [

        'study_id',
        'medico_id',
        'estudio',
        'informe',
        'fechaestudio',
        'validado'
    ];

    protected $casts = [
        'id' => 'string',
        'medico_id' => 'string'
    ];
}
