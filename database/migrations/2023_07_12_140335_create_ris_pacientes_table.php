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
        Schema::create('ris_pacientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('idtipoid');
            $table->string('documento');
            $table->string('primernombre');
            $table->string('segundonombre')->nullable();
            $table->string('primerapellido');
            $table->string('segundoapellido')->nullable();
            $table->date('fechanacimiento');
            $table->integer('idsexo');
            $table->string('direccion')->nullable();
            $table->string('barrio')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->integer('idestado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_pacientes');
    }
};
