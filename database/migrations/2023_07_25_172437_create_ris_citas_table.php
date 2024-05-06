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
        Schema::create('ris_citas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sede_id');
            $table->foreignUuid('sala_id');
            $table->foreignUuid('medico_id')->nullable();
            $table->foreignUuid('paciente_id')->nullable();
            $table->foreignUuid('convenio_id')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->longText('comentarios')->nullable();
            $table->date('fechadeseada')->nullable();
            $table->integer('prioridad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_citas');
    }
};
