<?php

namespace App\Http\Controllers;

use App\Models\Docmateria;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $solicitudes = Solicitud:: all();

        abort_if(Gate::denies('solicitud_index'), 403);
        $solicitudes = DB::table('solicitudes')
        ->join('docmaterias', 'solicitudes.docmateria_id', '=', 'docmaterias.id')
        ->join('users', 'docmaterias.docente', '=', 'users.id')
        ->join('ambientes', 'solicitudes.ambiente', '=', 'ambientes.id')
        ->where('solicitudes.estado', '=', 'pendiente')
        ->select('name', 'num_ambiente','solicitudes.*')
        ->get();
        //  dd($solicitudes->all());
        // $solicitudes = solicitud::all();

        return view('admin.solicitudes.index', compact('solicitudes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('crear_reserva'), 403);

        $ambientes = DB::table('ambientes')
        ->where('estado','=','Habilitado')
        ->get();
        $grupos = Grupo::all();
        $materias = Materia::all();
        $ubicaciones = Ubicacion::all();
        $docmaterias = Docmateria::all();
        $materiaUnidas = DB::table('docmaterias')

        ->join('materias', 'docmaterias.materia', '=', 'materias.id')
        ->join('grupos', 'docmaterias.grupo', '=', 'grupos.id')
        ->where('docmaterias.estado', '=', 'Habilitado')
        ->where('docmaterias.docente', '=', Auth::id())
        ->select('docmaterias.*', 'materias.nombre', 'grupos.numero')
        ->get();

        $grupoUnidas = DB::table( 'grupos')
        ->join('docmaterias', 'grupos.id', '=', 'docmaterias.grupo')
        ->select('grupos.*')
        ->where('docmaterias.docente', '=', Auth::id())
        ->get();
        //dd($materiaUnidas);
        return view('admin.solicitudes.create',compact('ambientes','grupos', 'materias', 'materiaUnidas', 'grupoUnidas','ubicaciones'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docmaterias = Docmateria::all();
        $solicitud = new Solicitud($request->all());
        $solicitud -> estado = "pendiente";
        $id = $request->ambiente;
        $cantidad = DB::table('ambientes')
        ->where('id', $id)
        ->first();

            if(($request->cantidad)>($cantidad->capacidad)){
                return back()->withInput($request->all())->withErrors([
                'message' => 'La cantidad excede la capacidad del ambiente'
            ]);
            }else{
                if(strtotime($request->hora_ini)>=strtotime($request->hora_fin)){
                    return back()->withInput()->withErrors([
                    'message' => 'La hora final es igual o mayor al horario de inicio'
                ]);
                }else{
                $solicitud->save();
                }
            }
  //   dd($request->all());
        return Redirect()->route('solicitudes.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $solicitud->fill($request->all());
        $solicitud->save();

        // alert()->success('Producto actualizado correctamente');

        return redirect()->route('admin.solicitudes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {

    }
    public function getCantidades(Request $request)
    {
        if($request->ajax()){
            $cantidades = Docmateria::where('id', $request->docmateria_id)->first();


            return response()->json($cantidades);
        }
    }

    public function getAmbientes (Request $request){

        if($request->ajax()){

            $ambientes = DB::table('ambientes')
            ->where('ubicacion', $request->ubicacion_id)
            ->where('estado','=','Habilitado')
            ->get();
            $datos = DB::table('ambientes')
            ->where('ubicacion', $request->ubicacion_id)
            ->where('estado','=','Habilitado')
            ->count();

            if($datos == 0)  {
                $ambientesArray =  [
                0=> "1",

            ];
            return response()->json($ambientesArray);

            }else{
                foreach($ambientes as $ambiente){
                    $ambientesArray[$ambiente->id] = $ambiente->num_ambiente;
                }
                return response()->json($ambientesArray);
            }

        }

    }
}
