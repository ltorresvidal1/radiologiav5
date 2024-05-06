<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\perfiles\Perfiles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfil1 = new Perfiles();
        $perfil1->nombre = "SUPER_ADMINISTRADOR";
        $perfil1->sa_administrador = "1";
        $perfil1->idestado = "1";
        $perfil1->created_at = "2022-08-16 09:12";
        $perfil1->save();

        $perfil2 = new Perfiles();
        $perfil2->nombre = "ADMINISTRADOR ENTIDAD";
        $perfil2->sa_administrador = "0";
        $perfil2->idestado = "1";
        $perfil2->created_at = "2022-08-16 09:12";
        $perfil2->save();

        $perfil3 = new Perfiles();
        $perfil3->nombre = "RADIOLOGO";
        $perfil3->sa_administrador = "0";
        $perfil3->idestado = "1";
        $perfil3->created_at = "2022-08-16 09:12";
        $perfil3->save();

        $perfil4 = new Perfiles();
        $perfil4->nombre = "DIGITADOR";
        $perfil4->sa_administrador = "0";
        $perfil4->idestado = "1";
        $perfil4->created_at = "2022-08-16 09:12";
        $perfil4->save();
    }
}
