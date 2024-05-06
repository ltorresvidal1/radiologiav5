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
        Schema::create('ris_salas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('codigo');
            $table->foreignUuid('sede_id');
            $table->string('nombre');
            $table->foreignUuid('modalidad_id');
            $table->string('aetitle')->nullable();
            $table->integer('idestado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_salas');
    }
};
