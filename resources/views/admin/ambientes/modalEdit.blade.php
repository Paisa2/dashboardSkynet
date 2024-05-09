<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

    $ubicaciones = DB::table('ubicaciones')->select('nombre')->get();
    $ubicaciones = DB::table('ubicaciones')->select('nombre')->where('id','=', "{$ambiente->id}")->get();
    $ambientes = DB::table('ambientes')->select('facultad')->get();
    $ambientes = DB::table('ambientes')->select('facultad')->where('id', '=', "{$ambiente->id}")->get();

    $estado = ["Habilitado","Deshabilitado", "Mantenimiento"];
    $estado = array_diff($estado, array("{$ambiente->estado}"));
    $estado = Arr::prepend($estado, "{$ambiente->estado}");
?>
    <div class="modal fade" id="modalEdit-{{$ambiente->id}}">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center">Editar Ambiente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.ambientes.update', $ambiente->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="num_ambiente">Numero ambiente</label>
                        <input type="text" name="num_ambiente" class="form-control" id="num_ambiente" value="{{$ambiente->num_ambiente}}" value="{{old('num_ambiente')}}" required minlength="1" maxlength="6"
                                onkeypress="return blockSpecialChar(event)">
                            @if ($errors->has('num_ambiente'))
                                <span class="error text-danger" for="input-num_ambiente" style="font-size: 15px">{{ $errors->first('num_ambiente') }}</span>
                            @endif
                        </div>

                    <div class="form-group">
                        <label for="capacidad">Capacidad ambiente</label>
                        <input type="text" name="capacidad" class="form-control" id="capacidad" value="{{$ambiente->capacidad}}" value="{{old('capacidad')}}" required minlength="1" maxlength="3"
                                onkeypress="return blockNoNumber(event)">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control" value="{{old('estado')}}"  required>
                            @foreach($estado as $es)
                             <option value="{{$es}}" @if(old('estado') ==$es) selected @endif>{{$es}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="refresh">Cancelar</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
