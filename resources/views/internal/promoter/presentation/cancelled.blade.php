@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Presentaciones canceladas
@stop

@section('content')
<table class="table table-bordered table-striped">
  <tr>
    <th>User</th>
    <th>Presentacion</th>
    <th>reason</th>
    <th>Duración</th>
    <th>Authorizado</th>
    <th>Creado</th>
  </tr>
    @foreach($presentationCancelled as $cancelled)
  <tr>
    <td>{{$cancelled->user}}</td>
    <td>{{$cancelled->presentation}}</td>
    <td>{{$cancelled->reason}}</td>
    <td>{{$cancelled->duration}}</td>
    <td>{{$cancelled->authorized}}</td>
    <td>{{$cancelled->created_at}}</td>
  </tr>
  @endforeach

  </table>
@stop

@section('javascript')

@stop