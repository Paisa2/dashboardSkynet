<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carreras = ["Sistemas", "Informatica", "Ing Alimentos", "Electromecanica", "Mecanica", "Ing Civil"];
        $materias = [
            "Sistemas de Informacion I",
            "Sistemas de Informacion II",
            "Ingenieria de Software",
            "Taller de Ingenieria de Software",
            "Calculo I",
            "Calculo II",
            "Calculo III",
            "Calculo IV",
            "Algebra I",
            "Algebra Lineal",
        ];
        $estado = ["Habilitado", "Deshabilitado"];
        $niveles = ['A','B','C','D','E','F','G', 'H', 'I', 'J', ''];
        $tipos = ["Regular", "Electiva"];

        for ($i = 0; $i < 10; $i++) {
            DB::table('materias')->insert([
                'codigo' => Str::random(3) . rand(1, 5)*100,
                'nombre' => $materias[$i],
                'carrera' => $carreras[rand(0, 5)],
                'estado' => $estado[rand(0,1)],
                'nivel' => $niveles[rand(0, 10)],
                'tipo' => $tipos[rand(0, 1)]
            ]);
        }
    }
}
