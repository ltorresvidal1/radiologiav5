<?php

namespace Database\Seeders;

use App\Models\ris\procedencias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProcedenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedencia1 = new procedencias();
        $procedencia1->codigo = "01";
        $procedencia1->nombre = "Hospitalización";
        $procedencia1->idestado = "1";
        $procedencia1->created_at = "2024-04-16 09:12";
        $procedencia1->save();

        $procedencia2 = new procedencias();
        $procedencia2->codigo = "02";
        $procedencia2->nombre = "Servicios Ambulatorios";
        $procedencia2->idestado = "1";
        $procedencia2->created_at = "2024-04-16 09:12";
        $procedencia2->save();

        $procedencia3 = new procedencias();
        $procedencia3->codigo = "03";
        $procedencia3->nombre = "Urgencias";
        $procedencia3->idestado = "1";
        $procedencia3->created_at = "2024-04-16 09:12";
        $procedencia3->save();
    }
}
