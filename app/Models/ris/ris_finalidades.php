<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ris_finalidades extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'idestado',
    ];
}
