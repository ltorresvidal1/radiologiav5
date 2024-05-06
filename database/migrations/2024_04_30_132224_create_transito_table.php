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
        Schema::create('transito', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('idsios');
            $table->string('admision');
            $table->date('fecha');
            $table->foreignUuid('paciente_id');
            $table->string('unidadfuncional');
            $table->string('cantidad');
            $table->foreignUuid('medico_id');
            $table->foreignUuid('sede_id');
            $table->foreignUuid('convenio_id');
            $table->foreignUuid('estudio_id');
            $table->string('procedencia');
            $table->integer('idestado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transito');
    }
};
