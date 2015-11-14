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
    <th>reason</th>
    <th>Duración</th>
    <th>Authorizado</th>
    <th>Creado</th>
    <th>Puntos de devolución autorizados</th>
  </tr>
    @foreach($presentationCancelled as $cancelled)
  <tr>
    <td>{{date('Y-m-d',$cancelled->presentation["starts_at"])}}</td>
    <td>{{$cancelled->presentation["event"]->name}}</td>
    <td>{{$cancelled->user_id}}</td>
    <td>{{$cancelled->reason}}</td>
    <td>{{$cancelled->duration}}</td>
    <td>{{$cancelled->authorized}}</td>
    <td>{{$cancelled->created_at}}</td>
    <td>
      <ul>
      @foreach( $cancelled->modules as $obj )
      <li>{{$obj->name }} <span class="label label-success">{{$obj->address }}</span> </li>
      @endforeach
      <li><a href="{{ url ('promoter/presentation/cancelled/'.$cancelled->id.'/modules')}}">Agregar</a></li>
      </ul>
    </td>
  </tr>
  @endforeach

  </table>
@stop

@section('javascript')

@stop