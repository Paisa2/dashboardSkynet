<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivos = ["1er parcial", "2do parcial", "final", "2da instancia"];
        $estados = ["pendiente", "aceptado", "rechazado", "sugerido"];
        for ($i=0; $i < 10; $i++) {
            DB::table('solicitudes')->insert([
                'cantidad' => rand(100,200),
                'motivo' => $motivos[rand(0,3)],
                'estado' => $estados[rand(0,3)],
                'hora_ini' => date("H:i", strtotime("10:52PM")),
                'hora_fin'=> date("H:i", strtotime("10:53PM")),
                'dia' => "2022-04-16",
                'grupo' => rand(1,10),
                'ambiente' => rand(1,10),
                'materia' => rand(1,10),
                'docente'=> 2,
            ]);
        }
    }
}
