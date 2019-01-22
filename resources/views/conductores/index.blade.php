@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('css')
    <style>
        .ver, .qrcode {
            cursor: pointer;
        }
    </style>
@stop
@section('content_header')
    <h1>Conductores</h1>

@stop

@section('content')
    <div class="box">
        <div class="box-header">

            <span title="Campos a mostrar" data-toggle="tooltip">
            <button class="btn-sm btn-primary" data-toggle="collapse" href="#collapseCampos">
                <i class="eye icon big"></i>
            </button>
            </span>

            <span title="Crear nuevo conductor" data-toggle="tooltip">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-usuario">
                <i class="icons big">
                    <i class="user icon "></i>
                    <i class="corner add icon black"></i>
                </i>
            </button>
            </span>
            <span title="Listado PDF conductores" data-toggle="tooltip">
            <a href="{{url('/conductores/pdf')}}" class="btn btn-success">PDF</a>
            </span>
            <span title="Exportar a Excel" data-toggle="tooltip">
            <a href="{{url('/conductores/excel')}}" class="btn btn-reddit">EXCEL</a>
            </span>
            <span title="Exportar a CSV" data-toggle="tooltip">
            <a href="{{url('/conductores/csv')}}" class="btn btn-warning">CSV</a>
            </span>

            <div class="collapse" id="collapseCampos">
                <table>
                    <tr>
                        <td><input class="camposToggle" type="checkbox" data-column='1' checked>&nbsp; Nombre &nbsp;
                        </td>
                        <td><input class="camposToggle" type="checkbox" data-column='3' checked>&nbsp; Teléfono &nbsp;
                        </td>
                        <td><input class="camposToggle" type="checkbox" data-column='2' checked>&nbsp; Email &nbsp;</td>
                    </tr>

                    <tr>
                        <td><input class="camposToggle" type="checkbox" data-column='0' checked>&nbsp; Numero Conductor
                            &nbsp;
                        </td>
                        <td><input class="camposToggle" type="checkbox" data-column='4'>&nbsp; FireBase uid &nbsp;</td>
                    </tr>
                </table>
            </div>


        </div>
        <div class="box-body">
            <table id="conductores" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                    <th>Núm. Conductor</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>FireBase uid</th>
                    <th>QR</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_conductores as $conductor)
                    <tr>
                        <td>
                            {{$conductor->num_conductor}}
                        </td>
                        <td>
                            {{$conductor->nombre}}
                        </td>
                        <td>
                            {{$conductor->email}}
                        </td>
                        <td>
                            {{$conductor->telefono}}
                        </td>
                        <td>
                            {{$conductor->uid_firebase}}
                        </td>
                        <td class="qr">
                            <span class="ver">Ver</span>
                            <span class="qrcode" style="display: none">
                                @php
                                    echo DNS2D::getBarcodeHTML($conductor->nombre . ' ' . $conductor->telefono, "QRCODE");
                                @endphp
                            </span>
                        </td>
                        <td data-id="{{$conductor->id}}">
                            <a href="#" class="btn-borrar">Borrar</a>
                            <a href="{{route('conductores.edit',['id'=>$conductor->id])}}" class="btn-editar">Editar</a>
                            <a href="{{url('documentos-conductor/' . $conductor->id)}}" class="btn-documentos">Documentos</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Núm. Conductor</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>FireBase uid</th>
                    <th>QR</th>
                    <th>Opciones</th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-usuario" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Crear nuevo usuario</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="num_conductor">Número Conductor</label>
                                <input type="number" class="form-control" name="num_conductor"
                                       placeholder="Introduce Nº Conductor" value="{{$conductor->num__conductor}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Introduce nombre">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" name="telefono"
                                       placeholder="Introduce teléfono">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"
                                       placeholder="Password">
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

            $('.ver').on('click', function () {
                $(this).hide();
                $(this).next('span').show();
            })

            $('.qrcode').on('click', function () {
                $(this).hide();
                $(this).prev().show();
            })

            var colOrder = [0, 1, 2, 3, 4, 5, 6];

            var table = $('#conductores').DataTable({
                language: language,
                colReorder: true,
                "columns": [
                    {"orderable": false, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": false, "visible": true},
                    {"orderable": false, "visible": false},
                    {"orderable": false, "visible": true},
                    {"orderable": false, "visible": true},
                ]
            });

            $('input.camposToggle').on('change', function (e) {
                e.preventDefault();
                // Get the column API object
                var column = table.column($(this).attr('data-column'));
                // Toggle the visibility
                column.visible(!column.visible());
            });

            $('.btn-borrar').on('click', function (e) {
                let tr = $(this).closest("tr");
                let id = $(this).closest("td").data("id");
                $.ajax({
                    url: "{{url('/conductores')}}/" + id,
                    method: "POST",
                    data: {
                        _method: "DELETE"
                    }
                    , success: function () {
                        tr.fadeOut(500, function () {
                            $(this).remove();
                        })
                    }
                });

            })

        });

    </script>
@stop
