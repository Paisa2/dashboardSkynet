<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){


        if(auth()->attempt(request(['email','password'])) == false){
            return back()->withErrors([
                'message' => 'El correo o la contraseña es incorrecta'
            ]);
        }else{
            $usuarios = DB::table('users')->where('users.id', '=', Auth::id())->get();
           // dd($usuarios);
            if($usuarios[0]->estadoCuenta  === "Habilitado"){

                return redirect()->route('auth.user');

            }else{
              //  dd('hola');
                auth()->logout();
                return redirect()->to('/login')->withErrors([
                    'message' => 'Cuenta deshabilitada'
                ]);

            }
        }
    }

    public function destroy(){
        auth()->logout();
        // return "quieres cerrar sesion";
        return redirect()->to('/');
    }
}
