<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicaciones')->insert([
            'nombre' => 'Edificio nuevo',

        ]);
        DB::table('ubicaciones')->insert([
            'nombre' => 'bloque antiguo',

        ]);
        DB::table('ubicaciones')->insert([
            'nombre' => 'laboratorios',

        ]);
        DB::table('ubicaciones')->insert([
            'nombre' => 'edificio memi',
        ]);
    }
}
