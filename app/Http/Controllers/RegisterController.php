<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');

    }

    public function store(){

        $this->validate(request(), [
            'name' => 'required',
            'ci' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required',
            'departamento' => 'required',
            'materias_grupos' =>'required',

        ]);

        $user = User::create(request(['name','ci','email','password', 'role', 'departamento', 'materias_grupos']));

        auth()->login($user);
        return redirect()->to('/docente');
    }
}
