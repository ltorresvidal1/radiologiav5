<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicosremitentes extends Model
{
    use HasFactory;
    protected $table = "ris_medicosremitentes";

    protected $fillable = [
        'codigo',
        'nombre',
        'idestado',
    ];
}
