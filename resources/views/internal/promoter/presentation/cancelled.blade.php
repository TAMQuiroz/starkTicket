@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Presentaciones canceladas
@stop

@section('content')
<table class="table table-bordered table-striped">
  <tr>
    <th>Presentacion</th>
    <th>Evento</th>
    <th>User</th>
    <th>Duración</th>
    <th>Authorizado</th>
    <th>Puntos de devolución autorizados</th>
    <th>Reason</th>
  </tr>
    @foreach($presentationCancelled as $cancelled)
  <tr>
    <td>{{date('Y-m-d',$cancelled->presentation["starts_at"])}}</td>
    <td>{{$cancelled->presentation["event"]->name}}</td>
    <td>{{$cancelled->user["name"] ." ".$cancelled->user["lastname"]}}</td>
    <td>{{$cancelled->duration}} Diás</td>
    <td>@if ($cancelled->authorized) <span class="label label-success">Autorizado</span> @else <span class="label label-danger">No autorizado</span> @endif</td>
    <td>
      <ul>
      @foreach( $cancelled->modules as $obj )
      <li>{{$obj->name }} <span class="label label-success">{{$obj->address }}</span> </li>
      @endforeach
      <li><a href="{{ url ('promoter/presentation/cancelled/'.$cancelled->id.'/modules')}}">Agregar</a></li>
      </ul>
    </td>
    <td>{{$cancelled->reason}}</td>
  </tr>
  @endforeach

  </table>
@stop

@section('javascript')

@stop