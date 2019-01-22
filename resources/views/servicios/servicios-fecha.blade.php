@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class='col-sm-3'>
                    <div class="form-group">
                        <div id="filterDate2">
                            <!-- Datepicker as text field -->
                            <label>Fecha: </label>

                            <div class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="date" type="text" class="form-control" placeholder="yyyy-mm-dd"
                                       value="{{$fecha}}">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table id="servicios" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Num. Orden</th>
                    <th>Fecha</th>
                    <th>Hora Inic.</th>
                    <th>Hora Fin</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Cliente</th>
                    <th>Observaciones</th>
                    <th>Matr.</th>
                    <th>Paxs</th>
                    <th>Cond.</th>
                    <th>Tipo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($servicios as $servicio)
                    <tr>
                        <td>{{$servicio['id']}}</td>
                        <td>{{$servicio['num_orden']}}</td>
                        <td>{{$servicio['fecha']}}</td>
                        <td>{{$servicio['hora_comienzo']}}</td>
                        <td>{{$servicio['hora_fin']}}</td>
                        <td>{{$servicio['descripcion']}}</td>
                        <td>{{$servicio['estado']}}</td>
                        <td>{{$servicio['cliente']}}</td>
                        <td>{{$servicio['observaciones']}}</td>
                        <td>{{$servicio['matricula']}}</td>
                        <td>{{$servicio['pax']}}</td>
                        <td>{{$servicio['conductor_id']}}</td>
                        <td>{{$servicio['tipo_servicio_id']}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>id</th>
                    <th>Num. Orden</th>
                    <th>Fecha</th>
                    <th>Hora Inic.</th>
                    <th>Hora Fin</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Cliente</th>
                    <th>Observaciones</th>
                    <th>Matr.</th>
                    <th>Paxs</th>
                    <th>Cond.</th>
                    <th>Tipo</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('.input-group.date').datepicker({format: "yyyy-mm-dd"});

            $('#date').on('change', (e) => {
                e.preventDefault();
                console.log($('#date').val());
                window.location.href = "{{URL::to('servicios-dia')}}" + "/" + $('#date').val();
            });


            var colOrder = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

            var table = $('#servicios').DataTable({
                language: language,
                colReorder: true,
                searching: false,
                "columns": [
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                    {"orderable": true, "visible": true},
                ]
            });

        });

    </script>
@stop
