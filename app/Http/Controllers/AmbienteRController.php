<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbienteRController extends Controller
{
    public function index()
    {
        // $ambientesR = Ambiente::all();

        $ambiente = DB::table('solicitudes')
        ->join('materias', 'solicitudes.materias', '=', 'materias.id')
        ->join('ambientes', 'solicitudes.ambientes', '=', 'ambientes.id')
        ->where('solicitudes.docente')->select('solicitudes.estado', 'ambientes.num_ambiente', 'materias.nombre',
        'solicitudes.dia', 'solicitudes.hora_ini', 'solicitudes.hora_fin')
        ->get();

        return view('admin.ambientesR.index', compact('ambientesR'));

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
        $newAmbiente = new Ambiente();
        $newAmbiente -> codigo = $request -> codigo;
        $newAmbiente -> num_ambiente = $request -> num_ambiente;
        $newAmbiente -> capacidad = $request -> capacidad;
        $newAmbiente -> ubicacion = $request -> ubicacion;
        $newAmbiente -> estado = $request -> estado;
        $newAmbiente -> save();

        return redirect()->back();

    }

    public function delete(Request $request, $ambienteId)
    {

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function show(Ambiente $ambiente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambiente $ambiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ambienteId)
    {
        $ambiente = Ambiente::find($ambienteId);
        $ambiente-> num_ambierte = $request -> num_ambiente;
        $ambiente -> capacidad = $request -> capacidad;
        $ambiente -> estado = $request -> estado;

        $ambiente->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambiente $ambiente)
    {
        //
    }
}
