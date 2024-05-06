<?php

namespace App\Models\Menuperfiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuperfiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu',
        'perfile_id',
        'cliente_id'
    ];



    public function clientes(){

       // return $this->('perfiles');
    }
}
