@extends('layouts.app')

@section('title1')

@endsection

@section('title2')
    <h4 class="card-title"> Todos locampos son obligatorios</h4>
@endsection

@section('content')

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10" style="width: 12%;">
                    <form action="{{ route('admin.usuarios.store')}}" method="post" class="form-horizontal">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre de docente</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name" placeholder="Ingrese su nombre" value="{{ old('name') }}" autofocus minlength="3" maxlength="15"
                                    onkeypress="return blockSpecialChar(event)">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger" for="input-name" style="font-size: 15px">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <label for="ci" class="col-sm-2 col-form-label">Codigo Sis</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="ci" placeholder="Ingrese Codigo Sis" value="{{ old('ci') }}" minlength="7" maxlength="10"
                                    onkeypress="return blockNoNumber(event)">
                                    @if ($errors->has('ci'))
                                        <span class="error text-danger" for="input-ci" style="font-size: 15px">{{ $errors->first('ci') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" placeholder="Ingrese su correo" value="{{ old('email') }}" minlength="10" maxlength="35"  >
                                    @if ($errors->has('email'))
                                        <span class="error text-danger" for="input-email" style="font-size: 15px">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" placeholder="Contraseña" minlength="5" maxlength="15" >
                                    @if ($errors->has('password'))
                                        <span class="error text-danger" for="input-password" style="font-size: 15px">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <label for="departamento" class="col-sm-2 col-form-label">Departamento</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" name="departamento" placeholder="Ingrese el departamento al que pertenece" value="{{ old('departamento') }}" autofocus minlength="5" maxlength="15"
                                onkeypress="return blockSpecialChar(event)">
                                @if ($errors->has('departamento'))
                                    <span class="error text-danger" for="input-departamento" style="font-size: 15px">{{ $errors->first('departamento') }}</span>
                                @endif
                                </div>
                            </div>

                                    <!-- <div class="row" >
                                        <label for="estadoDoc"  class="col-sm-2 col-form-label">Tipo Docente</label>
                                        <div class="col-sm-7">
                                            <select name="estadoDoc" id="estadoDoc" class="form-control"  required>
                                                    <section>Titular</section>
                                                    <section>Invitado</section>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                            <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active">
                                                                <table class="table">
                                                                    <tbody>
                                                                        @foreach ($roles as $id => $role)
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-check" >
                                                                                        <label class="form-check-label" style="margin-bottom: 10%">
                                                                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                                                                value="{{ $id }}"
                                                                                            >
                                                                                            <span class="form-check-sign">
                                                                                                <span class="check"></span>
                                                                                            </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $role }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <!-- Boton de formulario -->
                                            <div class="card-footer ml-auto mr-auto">
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('footer')

@endsection


