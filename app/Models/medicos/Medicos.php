<?php

namespace App\Models\medicos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicos extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'id',
        'documento',
        'nombre',
        'registromedico',
        'firma',
        'idestado'
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
