<?php

namespace App\Models\usuariosclientes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuariosclientes extends Model
{
    use HasFactory;
    use HasUuids;

    protected  $fillable = [
        'user_id',
        'cliente_id'
    ];
    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'cliente_id' => 'string'
    ];
}
