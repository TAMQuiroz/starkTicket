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
    <th>Puntos de devolución</th>
  </tr>
    @foreach($presentationCancelled as $cancelled)
  <tr>
    <td>{{$cancelled->user_id}}</td>
    <td>{{$cancelled->presentation_id}}</td>
    <td>{{$cancelled->reason}}</td>
    <td>{{$cancelled->duration}}</td>
    <td>{{$cancelled->authorized}}</td>
    <td>{{$cancelled->created_at}}</td>
    <th><a href="{{ url ('promoter/presentation/cancelled/'.$cancelled->id.'/modules')}}" class="btn btn-info">+</a></th>
  </tr>
  @endforeach

  </table>
@stop

@section('javascript')

@stop