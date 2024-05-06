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
        Schema::create('ris_relserviciostransito', function (Blueprint $table) {
            $table->id();
            $table->string('admision');
            $table->foreignUuid('estudio_id');
            $table->foreignUuid('modalidad_id');
            $table->foreignUuid('sala_id');
            $table->foreignId('finalidad_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris_relserviciostransito');
    }
};
