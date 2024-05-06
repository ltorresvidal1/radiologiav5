<?php

namespace Database\Seeders;

use App\Models\ris\medicosremitentes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MedicosremitentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicoremitente1 = new medicosremitentes();
        $medicoremitente1->codigo = "01";
        $medicoremitente1->nombre = "MEDICO GENERAL";
        $medicoremitente1->idestado = "1";
        $medicoremitente1->created_at = "2024-04-16 09:12";
        $medicoremitente1->save();

        $medicoremitente2 = new medicosremitentes();
        $medicoremitente2->codigo = "02";
        $medicoremitente2->nombre = "JOSE ROMERO TINOCO";
        $medicoremitente2->idestado = "1";
        $medicoremitente2->created_at = "2024-04-16 09:12";
        $medicoremitente2->save();
    }
}
