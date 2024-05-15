<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('materia_index'), 403);
        $materias = Materia::orderBy('id', 'asc')->get();

        return view('admin.materia.index', compact('materias'))->with('tipo', 'all');

    }

    public function UpdateStatusNoti(Request $request){
        abort_if(Gate::denies('materia_estado'), 403);
        $NotiUpdate = Materia::find($request->id);
        $NotiUpdate ->estado=$request->estatus;

        $NotiUpdate->save();
        if($NotiUpdate){
            $NotiUpdate=Materia::find($request->id);
            if($NotiUpdate->estado == 'Deshabilitado')  {
                        $newStatus = '<span class="badge badge-danger">'.@$NotiUpdate->estado.'</span>';
                    }else{
                        $newStatus ='<span class="badge badge-success">'.@$NotiUpdate->estado.'</span>';
                    }
                    return response()->json(['var'=>''.$newStatus.'']);
        }

        return response()->json([],401);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('materia_create'), 403);
        $validator = Validator::make($request->all(),[
            'codigo' => 'required|unique:materias,codigo',
            'nombre' => 'required|string|max:255|unique:materias,nombre',
            'carrera' => 'required|string|min:1|max:255',
            'tipo' => 'required',
            'nivel' => 'required'
        ]);

        $newMateria = new Materia();

        $newMateria ->codigo = $request->codigo;
        $newMateria->nombre = $request->nombre;
        $newMateria->carrera = $request->carrera;
        $newMateria->tipo = $request->tipo;
        $newMateria->nivel = $request->nivel;
        $newMateria->estado = $request->estado;
        // $newMateria->save();

        $materias = Materia::where('codigo', $request->codigo)->first();
        $materias2 = Materia::where('nombre', $request->nombre)->first();
        //    dd($request->all());
        //    dd($materias2);
        if(empty($materias) && empty($materias2) ){
            $newMateria->save();
            return redirect()->back();
        }else{

            return back()->withInput()->withErrors([
                'message' => 'Error, El codigo o nombre de la materia ya esta registrado en la lista'
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $materiaId)
    {
        abort_if(Gate::denies('materia_edit'), 403);

        $materia = Materia::find($materiaId);

        $materia->nombre = $request->nombre;
        $materia->carrera = $request->carrera;
        $materia->tipo = $request->tipo;
        $materia->nivel = $request->nivel;
        $materia->save();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
