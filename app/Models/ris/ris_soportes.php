<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ris_soportes extends Model
{
    use HasFactory;
    protected $table = "ris_soportes";

    protected $fillable = [
        'admision',
        'soporte',
        'url',
        'user_id',
        'pdf',
    ];

    protected $casts = [
        'user_id' => 'string',
    ];
}
