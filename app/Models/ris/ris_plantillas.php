<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_plantillas extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "ris_plantillas";

    protected $fillable = [
        'nombre',
        'plantilla',
        'idestado'
    ];


    protected $casts = [
        'id' => 'string'
    ];
}
