@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Editar Conductor</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">

        </div>
        <div class="box-body">
            <form method="post" action="{{ route('conductores.update',['id'=> $conductor->id]) }}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="num_conductor">Número Conductor</label>
                        <input type="number" class="form-control" name="num_conductor"
                               placeholder="Introduce Nº Conductor" value="{{$conductor->num_conductor}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Introduce nombre" value="{{$conductor->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono"
                               placeholder="Introduce teléfono" value="{{$conductor->telefono}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email"
                               placeholder="Enter email" value="{{$conductor->email}}">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    {!! method_field('put') !!}
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

        </div>
    </div>
@stop
