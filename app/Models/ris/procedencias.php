<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class procedencias extends Model
{
    use HasFactory;
    protected $table = "ris_procedencias";

    protected $fillable = [
        'codigo',
        'nombre',
        'idestado',
    ];
}
