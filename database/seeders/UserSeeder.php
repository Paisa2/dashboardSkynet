<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'estadoCuenta' => 'Habilitado',
            'password' => 'admin',
            'ci' => '1234567',
            'Departamento' => 'Informatica',
        ]);

        $user->assignRole('Admin');

        $user2 = User::create([
            'name' => 'Leticia Blanco',
            'email' => 'docente@doc.umss.edu',
            'estadoCuenta' => 'Deshabilitado',
            'estadoDocente' => 'Invitado',
            'password' => 'docente',
            'ci' => '5432101',
            'Departamento' => 'Informatica',
        ]);

        $user2->assignRole('User');

        $user3 = User::create([
            'name' => 'Paco Fernandez',
            'email' => 'docente2@gmail.com',
            'estadoCuenta' => 'Habilitado',
            'estadoDocente' => 'Titular',
            'password' => 'docente',
            'ci' => '4232332',
            'Departamento' => 'Sistemas',
        ]);

        $user3->assignRole('User');

        $user4 = User::create([
            'name' => 'Carmen Rosa',
            'email' => 'docente2@gdoc.umss.edu',
            'estadoCuenta' => 'Deshabilitado',
            'estadoDocente' => 'Titular',
            'password' => 'docente',
            'ci' => '4236798',
            'Departamento' => 'Industrial',
        ]);

        $user3->assignRole('User');
    }
}
