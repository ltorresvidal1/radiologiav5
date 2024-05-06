<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->id =  "63b9aa06-9f58-4718-b9fb-eab6b5e903f0"; //\Ramsey\Uuid\Uuid::uuid4()->toString();
        $usuario->documento = "1068658609";
        $usuario->nombre = "LUIS GABRIEL";
        $usuario->usuario = "LTORRES";
        $usuario->password = Hash::make("1234567");
        $usuario->perfile_id = "1";
        $usuario->idestado = "1";
        $usuario->created_at = "2022-08-16 09:12";
        $usuario->save();
    }
}
