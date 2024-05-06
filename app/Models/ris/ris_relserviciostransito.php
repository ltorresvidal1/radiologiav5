<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_relserviciostransito extends Model
{
    use HasFactory;

    protected $fillable = [
        'admision',
        'estudio_id',
        'modalidad_id',
        'sala_id',
        'finalidad_id',

    ];
    protected $table = 'ris_relserviciostransito';

    protected $casts = [
        'estudio_id' => 'string',
        'modalidad_id' => 'string',
        'sala_id' => 'string',
    ];
}
