@extends('layout.promoter')

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
    </tr>
        @foreach($politics as $politic)
    <tr>
        <td>{{$politic->name}}</td>
        <td>{{$politic->description}}</td>
        <td>{{$politic->state}}</td>
    </tr>
       @endforeach
</table>
@stop

@section('javascript')

@stop