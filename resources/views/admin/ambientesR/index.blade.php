@extends('layouts.app')

@section('title1')
    <h2>Informacion de Ambientes Reservadas</h2>
@endsection

@section('content')

@if ($tipo === 'admin')

<div class="form-group">
    @can('ambienteR_buscar')
    <span class="input-group" style="width: 60%; margin-right:auto; margin-left:auto">
        <img src="{{asset('images/search.svg')}}" alt="" style="border-radius: 10px; position: relative; width:100%; max-width:30px; right:8px;">
        <input id="searchTerm" type="text" onkeyup="doSearch()" class="form-control pull-right"  placeholder="Escribe para buscar en la tabla..." />
    </span>
    @endcan
</div>
        <table class="table table-secondary table-striped mt-4" id="ambientesR">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero Aula</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Dia de reserva</th>
                    <th scope="col">Horario de reserva</th>
                    <th scope="col">Horario fin reserva</th>
                    <th scope="col">Opciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($ambientes as $ambiente)
                <tr scope="row">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ @$ambiente->num_ambiente }}</td>
                    <td>{{ @$ambiente->nombre }}</td>
                    <td>{{ @$ambiente->dia }}</td>
                    <td>{{ @$ambiente->hora_ini }}</td>
                    <td>{{ @$ambiente->hora_fin }}</td>
                    <td>
                        @can('ambienteR_destroy')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminarReservas-{{$aula->id}}">
                            Eliminar
                        </button>
                        @endcan
                    </td>

                </tr>
                @include('admin.aulasR.modalEliminarReservas')

                @endforeach
            </tbody>
        </table>
@endif

@endsection


@section('footer')


@endsection
