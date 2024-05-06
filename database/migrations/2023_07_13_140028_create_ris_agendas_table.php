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
        Schema::create('ris_agendas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sede_id');
            $table->foreignUuid('sala_id');
            $table->date('fechainicial');
            $table->time('horainicial');
            $table->date('fechafinal');
            $table->time('horafinal');
            $table->json('dias')->nullable();
            $table->integer('idestado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_agendas');
    }
};
