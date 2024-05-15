<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Solicitud;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $ambientes = Ambiente:: all();

        if ($request->tipo === "reservadas") {
            $ambientes = DB::table('solicitudes')
            ->join('docmaterias', 'solicitudes.docmateria_id', '=', 'docmaterias.id')
            ->join('materias', 'docmaterias.materia', '=', 'materias.id')
            ->join('ambientes', 'solicitudes.ambiente', '=', 'ambientes.id')

           // ->where('docmaterias.docente', Auth::id())

            ->where('solicitudes.estado','=','aceptado')
            ->select('solicitudes.estado','solicitudes.hora_fin','ambientes.num_ambiente','materias.nombre','solicitudes.dia',
            'solicitudes.hora_ini')
            ->get();
            return view('admin.ambientes.index', compact('ambientes'))->with('tipo', "reservadas");

        }elseif($request->tipo === "admin"){
            abort_if(Gate::denies('ambienteR_index'), 403);
            $ambientes = DB::table('solicitudes')
            ->join('docmaterias', 'solicitudes.docmateria_id', '=', 'docmaterias.id')
            ->join('materias', 'docmaterias.materia', '=', 'materias.id')
            ->join('ambientes', 'solicitudes.ambiente', '=', 'ambientes.id')
            ->where('solicitudes.estado','=','aceptado')
            ->select('solicitudes.estado','solicitudes.hora_fin','ambientes.num_ambiente','materias.nombre','solicitudes.dia',
            'solicitudes.hora_ini','solicitudes.id')
            ->get();
            return view('admin.ambientesR.index', compact('ambientes'))->with('tipo', "admin");

        }
        //esta es la consulta de la tabla ubicaciones con ambientes
        abort_if(Gate::denies('ambiente_index'), 403);
        $ambientes =  DB::table('ambientes')
        ->join('ubicaciones', 'ambientes.ubicacion', '=', 'ubicaciones.id')
        ->select('ambientes.*','ubicaciones.nombre')
        ->orderBy('id','asc')
        ->get();
       // dd($ambientes);
        $ubicacion = DB::table('ubicaciones')->get();
        return view('admin.ambientes.index', compact('ambientes', 'ubicacion'))->with('tipo', "all");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('ambiente_create'), 403);
        $ubicaciones = Ubicacion::all()->pluck('nombre', 'id');
        return view('admin.ambientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        abort_if(Gate::denies('ambiente_create'), 403);

            $newAmbiente= new Ambiente();
            $newAmbiente->codigo = $request->codigo;
            $newAmbiente->num_ambiente = $request->num_ambiente;
            $newAmbiente->capacidad = $request->capacidad;
            $newAmbiente->facultad = $request->facultad;
            $newAmbiente->ubicacion = $request->ubicacion;
            $newAmbiente->estado = $request->estado;

            $ambiente = Ambiente::where('codigo', $request->codigo)->first();
            $ambiente2 = Ambiente::where('num_ambiente', $request->num_ambiente)->first();
            if(empty($ambiente) && empty($ambiente2)){
                $newAmbiente->save();
                return redirect()->back();
            }else{

                return back()->withInput()->withErrors([
                    'message' => 'Error, el codigo o numero de ambiente ingresado ya existe'
                ]);
            }

            return redirect()->back();
    }

    public function delete(Request $request, $ambienteId)
    {
        abort_if(Gate::denies('ambiente_destroy'), 403);
        function debug_to_console($data) {
            $output = $data;
            if (is_array($output))
                $output = implode(',', $output);

            echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        }

        $solicitudes = Solicitud::where('ambiente', $ambienteId)->first();

        $ambiente = Ambiente::find($ambienteId);
        debug_to_console($ambiente);
        debug_to_console($solicitudes);

        if(empty($solicitudes)){

            $ambiente->delete();
            return redirect()->back();
        }else{

            return back()->withErrors([
                'message' => 'No se puede eliminar el ambiente '.$ambiente["num_ambiente"].' debido a que esta siendo usada en una solicitud de reserva'
            ]);
        }
    }

    public function deleteReservadas(Request $request, $reservaId)
    {
        abort_if(Gate::denies('ambiente_destroy'), 403);
        $reserva = Solicitud::find($reservaId);
        $reserva->delete();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ambiente  $mbiente
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
        abort_if(Gate::denies('ambiente_edit'), 403);
        $ambiente = Ambiente::find($ambienteId);
        $ambiente->num_ambiente = $request->num_ambiente;
        $ambiente->capacidad = $request->capacidad;
        $ambiente->estado = $request->estado;


        //esto sirve para que no se repitan los datos
        $ambiente2 = Ambiente::where('num_ambiente', $request->num_ambiente)->first();
            if(empty($ambiente2)){
                $ambiente->save();
                return redirect()->back();
            }else{

                return back()->withInput()->withErrors([
                    'message' => 'Error, El numero de ambiente ingresado ya existe'
                ]);
            }
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

    }

}
