<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = ["test1@gmail.com", "test2@gmail.com", "test3@gmail.com", "test4@gmail.com"];
        for ($i=0; $i < 10; $i++) {
            DB::table('notificaciones')->insert([
                'email' => $emails[rand(0, 3)],
                'mensaje' => Str::random(30),
                'dia' => "2022-04-16",
                'solicitud' => rand(1, 10),
            ]);
        }
    }
}
