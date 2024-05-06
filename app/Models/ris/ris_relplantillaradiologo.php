<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_relplantillaradiologo extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'plantilla_id',
        'medico_id',

    ];
    protected $table = 'ris_relplantillasradiologos';

    protected $casts = [
        'plantilla_id' => 'string',
        'medico_id' => 'string',
    ];
}
