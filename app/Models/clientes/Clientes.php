<?php

namespace App\Models\clientes;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Clientes extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'nit',
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'logo',
        'fechainicial',
        'fechafinal',
        'idestado'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    /*public function user()
    {
        return $this->belongsTo(User::class);
    }*/
}
