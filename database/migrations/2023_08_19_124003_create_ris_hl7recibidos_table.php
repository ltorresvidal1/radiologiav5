<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ris_hl7recibidos', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_orden');
            $table->string('numero_examen');
            $table->string('identificacion_paciente');
            $table->string('tipo_id_paciente');
            $table->string('apellidos_paciente');
            $table->string('nombres_paciente');
            $table->string('fechanacimiento_paciente');
            $table->string('sexo_paciente');
            $table->string('direccion_paciente');
            $table->string('ciudad_paciente');
            $table->string('municipio_paciente');
            $table->string('departamento_paciente');
            $table->string('pais_paciente');
            $table->string('telefono_paciente');
            $table->string('celular_paciente');
            $table->string('unidad_funcional');
            $table->string('fecha_admision');
            $table->string('nit_empresa');
            $table->string('nombre_empresa');
            $table->string('numero_orden');
            $table->string('fecha_inicio');
            $table->string('fecha_finalizacion');
            $table->string('usuario_doctor');
            $table->string('codigo_doctor');
            $table->string('apellido_doctor');
            $table->string('nombre_doctor');
            $table->string('sala');
            $table->string('puesto_atencion');
            $table->string('nit_administradora');
            $table->string('nombre_administradora');
            $table->string('cups');
            $table->string('nombre_cups');
            $table->integer('prioridad');
            $table->string('procedencia');
            $table->string('modalidad');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_hl7recibidos');
    }
};
