<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docmateria;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocmateriaController extends Controller
{
    public function index() {

    $docmaterias = DB::table('docmaterias')
    ->join('users', 'docmaterias.docente', '=', 'users.id')
    ->join('materias', 'docmaterias.materia', '=', 'materias.id')
    ->join('grupos', 'docmaterias.grupo', '=', 'grupos.id')
    ->get();

    // $solicitudes = solicitud::all();
            //supuesto error
        return view('admin.docemateria.index', compact('docmaterias'));
    }

    public function index2() {

        abort_if(Gate::denies('asignar_index'), 403);
        $materias = DB:: table('materias')-> where('estado', '=','Habilitado')->get();
        $grupos = DB:: table('grupos')->get();
        $users = DB:: table('users')->where('name', '!=', 'Administrador')
        ->where('name', '!=', 'Admin')->where('name', '!=', 'SuperAdministrador')
        ->where('name', '!=', 'SuperAdmin')->get();
        $docentesmaterias = DB::table('docmaterias')
        ->join('users', 'docmaterias.docente', '=', 'users.id')
        ->join('materias', 'docmaterias.materia', '=', 'materias.id')
        ->join('grupos', 'docmaterias.grupo', '=', 'grupos.id')
        ->select('materias.nombre','grupos.numero','users.name', 'docmaterias.*')->get();

        return view('admin.docMaterias.index', ['docentesmaterias' => $docentesmaterias,
        'materias' => $materias, 'grupos' => $grupos,'users' => $users]);
    }

    public function store(Request $request) {

        abort_if(Gate::denies('asignar_create'), 403);
        $validador = Validator::make($request->all(), [
                'materia' => 'required|unique:materias',
                'grupo' => 'required|unique:grupos',
                'estado' => 'required',
                'docente' => 'required',
                'inscritos' => 'required',
                'gestion' => 'required'
        ]);

        $newAsignacion= new Docmateria();

        $newAsignacion->inscritos = $request->inscritos;
        $newAsignacion->gestion = $request->gestion;
        $newAsignacion->estado = $request->estado;
        $newAsignacion->grupo = $request->grupo;
        $newAsignacion->materia = $request->materia;
        $newAsignacion->docente = $request->docente;

        $materia = Docmateria::where('materia',$request->materia)->where('grupo',$request->grupo)->first();


        if(empty($materia)){
            $newAsignacion->save();
            return redirect()->back()->with('success','¡Exitoso!');
        }else{

            return back()->withInput()->withErrors([
                'No se pudo completar la asignación, materia y grupo'
            ]);
        }
        return redirect()->back();
    }

    public function update(Request $request, $docmateriaId) {

        abort_if(Gate::denies('asignar_edit'), 403);
        $validator = Validator::make($request->all(), [
            'materia' => 'required|unique:materias',
            'grupo' => 'required|unique:grupos',
            'estado' => 'required',
            'docente' => 'required',
            'inscritos' => 'required',
            'gestion' => 'required'
        ]);

        $asignacion = Docmateria::find($docmateriaId);

        $asignacion->inscritos = $request->inscritos;
        $asignacion->gestion = $request->gestion;
        $asignacion->estado = $request->estado;
        $asignacion->grupo = $request->grupo;
        $asignacion->materia = $request->materia;

        $materia = Docmateria::where('materia',$request->materia)
                            ->where('grupo',$request->grupo)->first();
        //dd($materia);
        if($docmateriaId == $asignacion->id){
            $asignacion->save();
            return redirect()->back();
        }else{
            if(empty($materia)){
                $asignacion->save();
                return redirect()->back();
            }else{

                return back()->withErrors([
                    'message' => 'No se pudo completar la asignación, materia y grupo.'
                ]);
            }
        }
        return redirect()->back();
    }

    public function delete(Request $request, $docmateriaId)
    {
        abort_if(Gate::denies('asignar_destroy'), 403);
        $docmateria = Docmateria::find($docmateriaId);
        $docmateria->delete();
        return redirect()->back();
    }
}

