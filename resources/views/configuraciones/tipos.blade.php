@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Tipos de servicios</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">

            <span title="Nuevo tipo" data-toggle="tooltip">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tipos">
                <i class="icons big">
                    <i class="file icon"></i>
                    <i class="corner add icon black"></i>
                </i>
            </button>
            </span>
        </div>
        <div class="box-body">
            <table id="tiposServicios" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tipos as $tipo)
                    <tr>
                        <td>
                            {{$tipo['id']}}
                        </td>
                        <td>
                            {{$tipo['nombre']}}
                        </td>
                        <td>
                            {{$tipo['descripcion']}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-tipos" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Crear nuevo tipo</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Introduce nombre">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Descripción</label>
                                <input type="text" class="form-control" name="descripcion"
                                       placeholder="Introduce teléfono">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop
@section('js')
    <script>
        $(document).ready(function () {
            var colOrder = [0,1,2];

            var table = $('#tiposServicios').DataTable({
                language: language,
                colReorder: true,
                "columns": [
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": false, "visible": true},
                ]
            });

        });

    </script>
@stop
