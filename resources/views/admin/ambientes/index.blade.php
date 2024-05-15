@extends('layouts.app')

@section('title1')
    <button type="button" class="btn btn-dark" style="background-color: #1D3354" data-toggle="modal"
            data-target="#modalCrear">
        Registro de Ambiente
    </button>
    <div style="margin-top: 1%; display: flex; justify-content: center;">
        <h2>
            Ambientes
        </h2>
    </div>
@endsection

@section('content')
<div class="card-body">
        @if(session('success'))
        <div class="alert alert-success" role="success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <div class="form-group" >
        @can('ambiente_buscar')
            <span class="input-group" style="width: 60%; margin-right:auto; margin-left:auto">
                <img src="{{asset('images/search.svg')}}" alt="" style="border-radius: 10px; position: relative; width:100%; max-width:30px; right:8px;">
                <input id="searchTerm" type="text" onkeyup="doSearch()" class="form-control pull-right"  placeholder="Escribe para buscar en la tabla..." />
            </span>
        @endcan
    </div>

            <!--Tabla de AMBIENTES-->
        <div style="margin-top: 1%" class="table-responsive" >
                <table class="table" id="aulas" >
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre Ambiente</th>
                            <th scope="col">Capacidad Ambiente</th>
                            <th scope="col">Ubicacion Ambiente</th>
                            <th scope="col">Facultad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ambientes as $ambiente)
                            <tr scope="row">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ @$ambiente->num_ambiente }}</td>
                                <td>{{ @$ambiente->capacidad }}</td>
                                <td>{{ @$ambiente->nombre }}</td>
                                <td>{{ @$ambiente->facultad }}</td>
                                <td>
                                    <!-- esto es la logica del estado de aulas que aparece en la tabla -->
                                        @if(@$ambiente->estado == 'Habilitado' )
                                            <span class="badge badge-success">{{ @$ambiente->estado }}</span>

                                        @elseif(@$ambiente->estado == 'Deshabilitado' )
                                            <span class="badge badge-danger">{{ @$ambiente->estado }}</span>

                                        @elseif(@$ambiente->estado == 'Mantenimiento' )
                                            <span class="badge badge-warning">{{ @$ambiente->estado }}</span>
                                        @endif
                                </td>

                                    <!-- la logica de boton de editar Eliminar -->
                                <td>
                                    @can('ambiente_edit')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar-{{$ambiente->id}}">
                                        Editar
                                    </button>
                                    @endcan
                                    @can('ambiente_destroy')
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar-{{$ambiente->id}}">
                                        Eliminar
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            <!-- Estos son los madales que aparecen en los botones de editar eliminar de la tabla -->
                                @include('admin.ambientes.modalEditar')
                                @include('admin.ambientes.modalEliminar')
                        @endforeach
                    </tbody>
                </table>
            </div>

<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <div class="modal fade bs-example-modal-lg" id="modalCrear">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center">Registro de Ambiente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.ambientes.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                            <label for="codigo">Codigo de ambiente</label>
                            <input type="text" name="codigo" class="form-control" id="codigo" value="{{old('codigo')}}" required minlength="5" maxlength="15"
                            onkeypress="return blockNoNumber(event)">
                            @if ($errors->has('codigo'))
                            <span class="error text-danger" for="input-codigo" style="font-size: 15px">{{ $errors->first('codigo') }}</span>
                            @endif
                            <label for="num_ambiente">Numero ambiente</label>
                            <input type="text" name="num_ambiente" class="form-control" id="num_ambiente" value="{{old('num_ambiente')}}" required minlength="1" maxlength="6"
                            onkeypress="return blockSpecialChar(event)">
                            @if ($errors->has('num_ambiente'))
                            <span class="error text-danger" for="input-num_ambiente" style="font-size: 15px">{{ $errors->first('num_ambiente') }}</span>
                            @endif
                            <label for="capacidad">Capacidad de ambiente</label>
                            <input type="text" name="capacidad" class="form-control" id="capacidad" value="{{old('capacidad')}}" required minlength="1" maxlength="3"
                                onkeypress="return blockNoNumber(event)">

                            <label for="facultad">Facultad</label>
                            <input type="text" name="facultad" class="form-control" id="facultad" value="{{old('facultad')}}" required minlength="5" maxlength="25"
                            onkeypress="return blockSpecialChar(event)">

                            <label for="ubicaciones">Ubicacion de ambiente</label>
                            <select name="ubicacion" id="ubicacion" class="form-control" value="{{old('ubicacion')}}" required>
                                <option value="">-- Selecciona la ubicacion--</option>

                            @foreach ($ubicacion as $item)
                                <option value="{{ $item->id }}" @if(old('ubicacion') == $item->id) selected @endif>{{ $item->nombre}}</option>
                            @endforeach
                            </select>

                                <label for="estado">Estado de ambiente</label>
                                <select name="estado" id="estado" class="form-control" value="{{old('sector')}}" required>
                                    <option value="">-- Selecciona el estado--</option>

                                    <option value="Habilitado" @if(old('estado') == 'Habilitado') selected @endif>Habilitado</option>
                                    <option value="Deshabilitado" @if(old('estado') == 'Deshabilitado') selected @endif>Deshabilitado</option>
                                    <option value="Mantenimiento" @if(old('estado') == 'Mantenimiento') selected @endif>Mantenimiento</option>
                                </select>
                        </div>
                        </div>
                                    <!-- son clases que acomodan los botones en el modal -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="refresh">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Evento del modal para registrar -->
            <script type="text/javascript">
                function blockSpecialChar(e){
                    var k;
                    document.all ? k = e.keyCode : k = e.which;
                    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
                    }
                function blockNoNumber(e){
                    var k;
                    document.all ? k = e.keyCode : k = e.which;
                    return ( (k >= 48 && k <= 57));
                    }
                let refresh = document.getElementById('refresh');
                refresh.addEventListener('click', _ => {
                        location.reload();
                })
            </script>

<script language="javascript">
    function doSearch() {
        var tableReg = document.getElementById('ambientes');
        var searchText = document.getElementById('searchTerm').value.toLowerCase();
        for (var i = 1; i < tableReg.rows.length; i++) {
            var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
            var found = false;
            for (var j = 0; j < cellsOfRow.length && !found; j++) {
                var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                    found = true;
                }
            }
            if (found) {
                tableReg.rows[i].style.display = '';
            } else {
                tableReg.rows[i].style.display = 'none';
            }
        }
    }
</script>
<!-- Evento para el buscador -->

<!-- Este script es para el buscador de la tabla -->

@endsection

@section('footer')

@endsection
