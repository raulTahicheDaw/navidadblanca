@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <label> Conductor: </label>
            <select id="conductor" class="js-example-basic-single" name="conductor">
                <option selected>Elija conductor</option>
                @foreach($conductores as $conductor)
                    <option value="{{$conductor->id}}">
                        {{$conductor->num_conductor}} {{$conductor->nombre}}
                    </option>
                @endforeach
            </select>

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
            $('#conductor').on('change', (e) => {
                e.preventDefault();
                window.location.href = "{{URL::to('servicios-conductor')}}" + "/" + $('#conductor').val();
            });

            $(document).ready(function () {
                $('.js-example-basic-single').select2();
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
