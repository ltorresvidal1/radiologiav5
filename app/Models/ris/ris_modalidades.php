<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_modalidades extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "ris_modalidades";

    protected $fillable = [
        'codigo',
        'nombre',
        'idestado'
    ];


    protected $casts = [
        'id' => 'string',
    ];
}
