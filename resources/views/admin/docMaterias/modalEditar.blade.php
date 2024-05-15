<?php

use Illuminate\Support\Arr;

    $estado = ["Titular","Invitado"];
    $estado = array_diff($estado, array("{$docentesmateria->estado}"));
    $estado = Arr::prepend($estado, "{$docentesmateria->estado}");
?>

    <div class="modal fade" id="modalEditar-{{$docentesmateria->id}}">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 text-center">Editar Asignación</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('admin.docentesmaterias.update', $docentesmateria->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Materia</label>
                                <select name="materia" id="materia" class="form-control" required>
                                    <option value="">-- Selecciona la materia--</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}">{{ $materia->nombre }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Grupo</label>
                                <select  name="grupo" class="form-control" id="grupo">
                                    <option value="">-- Selecciona el grupo--</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}">{{ $grupo->codigo }}-{{ $grupo->numero }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    @foreach($estado as $status)
                                        <option value="{{$status}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Inscritos</label>
                                <input type="text" name="inscritos" class="form-control" id="inscritos" value="{{$docentesmateria->inscritos}}" required minlength="2" maxlength="3"
                                onkeypress="return blockNoNumber(event)">
                            </div>
                            <div class="form-group">
                                <label for="name">Gestión</label>
                                <input type="text" name="gestion" class="form-control" id="gestion" value="{{$docentesmateria->gestion}}" required minlength="5" maxlength="15"
                                >
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="refresh">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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

