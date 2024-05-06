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
        Schema::create('lecturas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('study_id', 100);
            $table->foreignUuid('medico_id');
            $table->string('estudio');
            $table->text('informe');
            $table->date('fechaestudio');
            $table->integer('validado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturas');
    }
};
