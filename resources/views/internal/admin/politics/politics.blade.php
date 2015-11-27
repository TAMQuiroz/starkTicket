@extends('layout.admin')

@section('style')

@stop

@section('title')
	Politicas
@stop

@section('content')
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
            @foreach($politics as $politic)
            <tr>
                <td>{{$politic->name}}</td>
                <td>{{$politic->description}}</td>
                <td>{{$politic->state}}</td>
                <td><a class="btn btn-info" href="{{url('admin/politics/'.$politic->id.'/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a></td>
            </tr>
            @endforeach
        </table>
@stop

@section('javascript')

@stop