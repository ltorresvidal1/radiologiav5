<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\desplegable;

class DesplegableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desplegable1 = new desplegable();
        $desplegable1->nombre = "Activo";
        $desplegable1->ventana = "estados";
        $desplegable1->estado = "1";
        $desplegable1->created_at = "2022-08-16 09:12";
        $desplegable1->save();

        $desplegable2 = new desplegable();
        $desplegable2->nombre = "Inactivo";
        $desplegable2->ventana = "estados";
        $desplegable2->estado = "1";
        $desplegable2->created_at = "2022-08-16 09:12";
        $desplegable2->save();

        $desplegable3 = new desplegable();
        $desplegable3->nombre = "RC";
        $desplegable3->ventana = "tipodocumento";
        $desplegable3->estado = "1";
        $desplegable3->created_at = "2022-08-16 09:12";
        $desplegable3->save();

        $desplegable4 = new desplegable();
        $desplegable4->nombre = "TI";
        $desplegable4->ventana = "tipodocumento";
        $desplegable4->estado = "1";
        $desplegable4->created_at = "2022-08-16 09:12";
        $desplegable4->save();

        $desplegable5 = new desplegable();
        $desplegable5->nombre = "CC";
        $desplegable5->ventana = "tipodocumento";
        $desplegable5->estado = "1";
        $desplegable5->created_at = "2022-08-16 09:12";
        $desplegable5->save();

        $desplegable6 = new desplegable();
        $desplegable6->nombre = "CE";
        $desplegable6->ventana = "tipodocumento";
        $desplegable6->estado = "1";
        $desplegable6->created_at = "2022-08-16 09:12";
        $desplegable6->save();

        $desplegable7 = new desplegable();
        $desplegable7->nombre = "PA";
        $desplegable7->ventana = "tipodocumento";
        $desplegable7->estado = "1";
        $desplegable7->created_at = "2022-08-16 09:12";
        $desplegable7->save();

        $desplegable8 = new desplegable();
        $desplegable8->nombre = "PE";
        $desplegable8->ventana = "tipodocumento";
        $desplegable8->estado = "1";
        $desplegable8->created_at = "2022-08-16 09:12";
        $desplegable8->save();

        $desplegable9 = new desplegable();
        $desplegable9->nombre = "";
        $desplegable9->ventana = "tipodocumento";
        $desplegable9->estado = "0";
        $desplegable9->created_at = "2022-08-16 09:12";
        $desplegable9->save();


        $desplegable10 = new desplegable();
        $desplegable10->nombre = "";
        $desplegable10->ventana = "tipodocumento";
        $desplegable10->estado = "0";
        $desplegable10->created_at = "2022-08-16 09:12";
        $desplegable10->save();

        $desplegable11 = new desplegable();
        $desplegable11->nombre = "";
        $desplegable11->ventana = "tipodocumento";
        $desplegable11->estado = "0";
        $desplegable11->created_at = "2022-08-16 09:12";
        $desplegable11->save();


        $desplegable12 = new desplegable();
        $desplegable12->nombre = "FEMENINO";
        $desplegable12->ventana = "genero";
        $desplegable12->estado = "1";
        $desplegable12->created_at = "2022-08-16 09:12";
        $desplegable12->save();

        $desplegable13 = new desplegable();
        $desplegable13->nombre = "MASCULINO";
        $desplegable13->ventana = "genero";
        $desplegable13->estado = "1";
        $desplegable13->created_at = "2022-08-16 09:12";
        $desplegable13->save();


        $desplegable14 = new desplegable();
        $desplegable14->nombre = "";
        $desplegable14->ventana = "genero";
        $desplegable14->estado = "0";
        $desplegable14->created_at = "2022-08-16 09:12";
        $desplegable14->save();
    }
}
