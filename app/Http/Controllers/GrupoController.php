<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = DB::table('grupos')->get();

        return view('admin.grupos.index', compact('grupos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $newGrupo= new Grupo();

        $newGrupo->codigo = $request->codigo;
        $newGrupo->numero = $request->numero;

        $grupoCod = Grupo::where('codigo', $request->codigo)->first();
        $grupoNum = Grupo::where('numero', $request->numero)->first();

        if($grupoCod != $grupoNum){
        }
        $newGrupo->save();
        return redirect()->back();
    }

    public function show(Grupo $grupo)
    {
        //
    }

    public function edit(Grupo $grupo)
    {
        //
    }

    public function update(Request $request, $grupoId)
    {
        $grupo = Grupo::find($grupoId);

        $grupo->codigo = $request->codigo;
        $grupo->numero = $request->numero;
        $grupo->save();

        return redirect()->back();
    }

    public function delete(Request $request, $grupoId)
    {
        $grupo = Grupo::find($grupoId);
        $grupo->delete();
        return redirect()->back();
    }
}
