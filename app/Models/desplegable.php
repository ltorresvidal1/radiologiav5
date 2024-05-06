<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desplegable extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ventana',
        'estado',
        'created_at',
        'updated_at'
    ];
}
