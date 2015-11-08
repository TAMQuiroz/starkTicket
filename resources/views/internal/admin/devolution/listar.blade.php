@extends('layout.admin')

@section('style')

@stop

@section('title')
	Devoluciones
@stop

@section('content')
        <!-- Contenido-->
          <table class="table table-bordered table-striped">
            <tr>
              <th>Cliente</th>
              <th>Código Ticket</th>
              <th>Administrador</th>
              <th>Fecha</th>
              <th>Precio Individual</th>
              <th>Monto Devuelto</th>

            </tr>
            @foreach($devolutions as $devolution)
            <tr>
              <td>{{$devolution->client["name"]}}</td>
              <td>{{$devolution->ticket_id}}</td>
              <td>{{$devolution->administrator["name"]}}</td>
              <td>{{$devolution->created_at}}</td>
              <td>s/ {{$devolution->price}}</td>
              <td>s/ {{$devolution->repayment}}</td>
            </tr>
            @endforeach
          </table>
@stop

@section('javascript')

@stop