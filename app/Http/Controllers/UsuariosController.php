<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
     //
    public function index()
    {
        abort_if(Gate::denies('user_index'), 403);
        $users = User::all();
        return view('admin.usuarios.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.usuarios.create', compact('roles'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('admin.usuarios.edit', compact('user', 'roles'));
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->only('name', 'ci', 'email', 'password', )
        + [
            'estadoCuente' => 'Habilitado',
        ]);

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('admin.usuarios.index', $user->id)->with('success', 'Usuario creado correctamente');
    }

    public function delete(Request $request, $usuarioId)
    {
        $usuario = User::find($usuarioId);
        $usuario->delete();
        return redirect()->back();
    }

    public function update(UserEditRequest $request, User $user)
    {
        $data = $request->only('name', 'email', 'departamento', 'estadoCuenta');
        $password=$request->input('password');
        if($password)

            $data['password'] = $password;
            $user->update($data);
            $roles = $request->input('roles', []);
            $user->syncRoles($roles);
            return redirect()->route('admin.usuarios.index', $user->id)->with('success', 'Usuario actualizado correctamente');
    }
    public function destroy(User $user)
    {
        abort_if(Gate::denies('destroy_user'), 403);

        if(auth()->user()->id == $user->id) {
            return redirect()->route('admin.usuarios.index');
        }

        $user->delete();
        return back()->with('success', 'Usuario eliminado exitosamente');

    }
}