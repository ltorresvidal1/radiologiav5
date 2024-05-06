<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ris_agendados', function (Blueprint $table) {

            $table->string('medicoremintente_id')->nullable();
            $table->string('cie10')->nullable();
            $table->string('prioridad_id')->nullable();
            $table->string('procedencia_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ris_agendados', function (Blueprint $table) {
            $table->dropColumn('medicoremintente_id');
            $table->dropColumn('cie10');
            $table->dropColumn('prioridad_id');
            $table->dropColumn('administradora');
        });
    }
};
