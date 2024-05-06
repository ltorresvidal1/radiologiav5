<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_estudios extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "estudios";

    protected $fillable = [
        'cups',
        'nombre',
        'modalidad',
        'valor',
        'idestado'

    ];

    protected $casts = [
        'id' => 'string'
    ];
}
