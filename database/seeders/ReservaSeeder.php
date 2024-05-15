<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambientes = ["692A", "692B", "692C", "692D"];
        for ($i=0; $i < 10; $i++) {
            DB::table('reservas')->insert([
                'ambiente' => $ambientes[rand(0, 3)],
                'hora_ini' => date("H:i", strtotime("10:52PM")),
                'hora_fin' => date("H:i", strtotime("10:53PM")),
                'dia' => "2022-04-16",
                'solicitud' => rand(1, 10),
            ]);
        }
    }
}
