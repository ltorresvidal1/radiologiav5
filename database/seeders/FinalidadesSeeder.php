<?php

namespace Database\Seeders;

use App\Models\ris\ris_finalidades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $finalidad1 = new ris_finalidades();
        $finalidad1->nombre = "Diagnóstico";
        $finalidad1->idestado = "1";
        $finalidad1->created_at = "2024-04-16 09:12";
        $finalidad1->save();

        $finalidad2 = new ris_finalidades();
        $finalidad2->nombre = "Terapéutico";
        $finalidad2->idestado = "1";
        $finalidad2->created_at = "2024-04-16 09:12";
        $finalidad2->save();

        $finalidad3 = new ris_finalidades();
        $finalidad3->nombre = "Protección Específica";
        $finalidad3->idestado = "1";
        $finalidad3->created_at = "2024-04-16 09:12";
        $finalidad3->save();

        $finalidad4 = new ris_finalidades();
        $finalidad4->nombre = "Detección temprana de enfermedad general";
        $finalidad4->idestado = "1";
        $finalidad4->created_at = "2024-04-16 09:12";
        $finalidad4->save();

        $finalidad5 = new ris_finalidades();
        $finalidad5->nombre = "Detección temprana de enfermedad laboral";
        $finalidad5->idestado = "1";
        $finalidad5->created_at = "2024-04-16 09:12";
        $finalidad5->save();
    }
}
