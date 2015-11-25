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
    <th>Fecha de devolución</th>
    <th>Duración</th>
    <th>Detalles</th>
    <th>Editar</th>
  </tr>
    @foreach($presentationCancelled as $cancelled)
  <tr>
    <td>{{date('Y-m-d',$cancelled->presentation["starts_at"])}}</td>
    <td><a href="{{ url ('event/'.$cancelled->presentation['event']->id) }}">{{$cancelled->presentation["event"]->name}}</a></td>
    <td>{{$cancelled->user["name"] ." ".$cancelled->user["lastname"]}}</td>
    <td>{{$cancelled->date_refund}}</td>
    <td>{{$cancelled->duration}} Diás</td>
    <td>
        <a class="btn btn-info" title="Mas Detalles"  data-toggle="modal" data-target="#detallesModal{{$cancelled->id}}">+</a>
       <!-- MODAL -->
        <div class="modal fade"  id="detallesModal{{$cancelled->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalles de la presentación cancelado</h4>
              </div>
              <div class="modal-body">
                <p><b>Fecha de devolución</b>: {{$cancelled->date_refund}}</p>
                <p><b>Duración de devolución</b>: {{$cancelled->duration}} Diás </p>
                <p><b>Autorizado para ser devuelto?</b> @if ($cancelled->authorized) Autorizado @else No autorizado @endif</p>
                {{$cancelled->reason}}
                <hr>
                <p><b>Name</b>: {{$cancelled->presentation["event"]->name}}</p>
                <p>{{$cancelled->presentation["event"]->description}}</p>
                <hr>
                <p > <b>Puntos de devolución autorizados</b></p>
                <table class="table">
                    <tr>
                        <th>Punto de venta</th>
                        <th>Dirección</th>
                    </tr>
                @foreach( $cancelled->modules as $obj )
                    <tr>
                        <td>{{$obj->name }}</td>
                        <td>{{$obj->address }}</td>
                    </tr>
                @endforeach
                </table>
                <p><a href="{{ url ('promoter/presentation/cancelled/'.$cancelled->id.'/modules')}}">Agregar puntos de devolución</a></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </td>
    <td><a type="button" class="btn btn-info" href="{{url('promoter/presentation/'.$cancelled->presentation_id.'/cancel')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
  </tr>
  @endforeach

  </table>
@stop

@section('javascript')

@stop