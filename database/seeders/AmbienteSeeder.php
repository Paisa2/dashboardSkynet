<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ubicaciones = ["1", "2", "3", "4"];
        $facultades = ["Fcyt", "Derecho", "Economia", "Arquitectura" ];
        $letras = ['A','B','C','D','E','F','G', ''];
        $estado = ["Habilitado", "Deshabilitado", "Mantenimiento"];
        for ($i = 0; $i < 10; $i++) {
            DB::table('ambientes')->insert([
                'codigo' => rand(1,100)*1000,
                'num_ambiente' => rand(1, 30)*10 . $letras[rand(0,7)],
                'capacidad' => rand(10, 40)*10,
                'facultad' => $facultades[rand(0, 3)],
                'ubicacion' => $ubicaciones[rand(0, 3)],
                'estado' => $estado[rand(0,2)],
            ]);
        }
    }
}
