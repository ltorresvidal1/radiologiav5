<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ris_hl7recibidos extends Model
{
    use HasFactory;

    protected $table = "ris_hl7recibidos";

    protected $fillable = [
        'fecha_orden',
        'numero_examen',
        'identificacion_paciente',
        'tipo_id_paciente',
        'apellidos_paciente',
        'nombres_paciente',
        'fechanacimiento_paciente',
        'sexo_paciente',
        'direccion_paciente',
        'ciudad_paciente',
        'municipio_paciente',
        'departamento_paciente',
        'pais_paciente',
        'telefono_paciente',
        'celular_paciente',
        'unidad_funcional',
        'fecha_admision',
        'nit_empresa',
        'nombre_empresa',
        'numero_orden',
        'fecha_inicio',
        'fecha_finalizacion',
        'usuario_doctor',
        'codigo_doctor',
        'apellido_doctor',
        'nombre_doctor',
        'sala',
        'puesto_atencion',
        'nit_administradora',
        'nombre_administradora',
        'cups',
        'nombre_cups',
        'prioridad',
        'procedencia',
        'modalidad',
        'message'
    ];
}
