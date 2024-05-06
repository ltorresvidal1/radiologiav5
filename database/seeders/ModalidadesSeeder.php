<?php

namespace Database\Seeders;

use App\Models\ris\ris_modalidades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modalidad1 = new ris_modalidades();
        $modalidad1->codigo = "RX";
        $modalidad1->nombre = "RADIOGRAFÍA";
        $modalidad1->idestado = "1";
        $modalidad1->created_at = "2022-08-16 09:12";
        $modalidad1->save();

        $modalidad2 = new ris_modalidades();
        $modalidad2->codigo = "TC";
        $modalidad2->nombre = "TOMOGRAFÍA COMPUTARIZADA";
        $modalidad2->idestado = "1";
        $modalidad2->created_at = "2022-08-16 09:12";
        $modalidad2->save();

        $modalidad3 = new ris_modalidades();
        $modalidad3->codigo = "RM";
        $modalidad3->nombre = "RESONANCIA MAGNÉTICA ";
        $modalidad3->idestado = "1";
        $modalidad3->created_at = "2022-08-16 09:12";
        $modalidad3->save();

        $modalidad4 = new ris_modalidades();
        $modalidad4->codigo = "US";
        $modalidad4->nombre = "ECOGRAFÍA";
        $modalidad4->idestado = "1";
        $modalidad4->created_at = "2022-08-16 09:12";
        $modalidad4->save();
        /*
        $modalidad = new ris_modalidades();
        $modalidad->codigo = "RX";
        $modalidad->nombre = "RADIOGRAFÍA";
        $modalidad->idestado = "1";
        $modalidad->created_at = "2022-08-16 09:12";
        $modalidad->save();*/
    }
}
