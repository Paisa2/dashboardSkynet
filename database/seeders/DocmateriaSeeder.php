<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocmateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('docmaterias')->insert([
            'inscritos' => '10',
            'gestion' => 'I-2024',
            'estado' => 'Titular',
            'grupo' => '1',
            'materia' => '5',
            'docente' => "2"
        ]);
        DB::table('docmaterias')->insert([
            'inscritos' => '20',
            'gestion' => 'II-2024',
            'estado' => 'Titular',
            'grupo' => '2',
            'materia' => '1',
            'docente' => "2"
        ]);
        DB::table('docmaterias')->insert([
            'inscritos' => '30',
            'gestion' => 'I-2024',
            'estado' => 'Invitado',
            'grupo' => '1',
            'materia' => '2',
            'docente' => "2"
        ]);

        DB::table('docmaterias')->insert([
            'inscritos' => '40',
            'gestion' => 'II-2024',
            'estado' => 'Invitado',
            'grupo' => '1',
            'materia' => '3',
            'docente' => "3"
        ]);

        DB::table('docmaterias')->insert([
            'inscritos' => '50',
            'gestion' => 'I-2024',
            'estado' => 'Titular',
            'grupo' => '2',
            'materia' => '4',
            'docente' => "3"
        ]);
    }
}
