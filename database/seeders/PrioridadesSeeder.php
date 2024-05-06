<?php

namespace Database\Seeders;

use App\Models\ris\ris_prioridades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioridadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $prioridad1 = new ris_prioridades();
        $prioridad1->nombre = "Baja";
        $prioridad1->color = "badge bg-info";
        $prioridad1->idestado = "1";
        $prioridad1->created_at = "2022-08-16 09:12";
        $prioridad1->save();

        $prioridad2 = new ris_prioridades();
        $prioridad2->nombre = "Media";
        $prioridad2->color = "badge bg-warning";
        $prioridad2->idestado = "1";
        $prioridad2->created_at = "2022-08-16 09:12";
        $prioridad2->save();

        $prioridad3 = new ris_prioridades();
        $prioridad3->nombre = "Alta";
        $prioridad3->color = "badge bg-danger";
        $prioridad3->idestado = "1";
        $prioridad3->created_at = "2022-08-16 09:12";
        $prioridad3->save();

        $prioridad4 = new ris_prioridades();
        $prioridad4->nombre = "";
        $prioridad4->color = "";
        $prioridad4->idestado = "0";
        $prioridad4->created_at = "2022-08-16 09:12";
        $prioridad4->save();

        $prioridad5 = new ris_prioridades();
        $prioridad5->nombre = "";
        $prioridad5->color = "";
        $prioridad5->idestado = "0";
        $prioridad5->created_at = "2022-08-16 09:12";
        $prioridad5->save();
    }
}
