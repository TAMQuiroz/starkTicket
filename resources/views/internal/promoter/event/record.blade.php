@extends('layout.promoter')

@section('style')
  {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Historial de eventos
@stop

@section('content')
    <table class="table table-bordered table-striped" id="events">
      <thead>
        <tr>
          <!-- <th>Código de Evento</th> -->
          <th>Nombre de Evento</th>
          <th>Fecha Publicación eventos</th>
          <th>Fecha Inicio ventas</th>
          <th>Estado</th>
          <th>Entradas Vendidas</th>
          <th>Monto Acumulado</th>
          <th>Ver</th>
          <th>Pagar</th>
          <th>Editar</th>
          <th>Cancelar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($events as $event)
        <tr>

          <td>{{$event->name}}</td>
          <td>{{date("d/m/Y",$event->publication_date)}}</td>
          <td>{{date("d/m/Y",$event->selling_date)}}</td>
          <td>@if($event->cancelled)Cancelado @else Vigente @endif</td> <!--falta la logica de vigente -->
          <td>{{$event->numberTickets()}}</td>
          <td>{{$event->ticket_sum}}</td> <!--no hay -->
          <td><a href="{{ url ('promoter/event/'.$event->id) }}" class="btn btn-info">+</a></td>
          @if($event->cancelled)
          <td><a class="btn btn-default" title="Deshabilitado" disabled>$</a></td>
          <td><a class="btn btn-default" title="Deshabilitado" disabled><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><a class="btn btn-default" title="Deshabilitado" disabled><i class="glyphicon glyphicon-remove"></i></a></td>
          <td><a class="btn btn-default" title="Deshabilitado" disabled><i class="glyphicon glyphicon-remove"></i></a></td>
          @else
          <td><a href="{{ url ('promoter/transfer_payments/'.$event->id.'/create') }}" class="btn btn-info">$</a></td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/'.$event->id.'/edit')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancelEvent{{$event->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
            <!-- MODAL Cancel-->
            <div class="modal fade" id="cancelEvent{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">Cancelación de Evento: {{$event->name}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <h4>Elegir función:</h4>
                          <ul>
                            @foreach ($event->presentations as $present)
                              <li>
                                  Funcion: {{date("d/m/Y",$present->starts_at)}} {{date('h:i:s',$present->starts_at)}} <a href="{{ url ('promoter/presentation/'.$present->id.'/cancel') }}">Cancelar</a>
                              </li>
                            @endforeach
                          </ul>
                          <p><a href="{{ url ('promoter/event/'.$event->id.'/cancel') }}">Cancelar todos</a></p>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" >Salir</button>
                    </div>
                  </div>
                </div>
              </div>

          <td>
            <a class="btn btn-info" href=""  title="Eliminar"    data-toggle="modal" data-target="#deleteModal{{$event->id}}"><i class="glyphicon glyphicon-remove"></i></a>
          </td>
            <!-- MODAL Delete-->
            <div class="modal fade"  id="deleteModal{{$event->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Estas seguro que desea eliminar este evento?</h4>
                  </div>
                  <div class="modal-body">
                    <h5 class="modal-title">Los cambios serán permanentes</h5>
                  </div>
                  <div class="modal-footer">
                      {!!Form::open(array('route' =>array ('events.delete',$event->id)))!!}
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-info">Si</button>
                      </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            @endif
        </tr>
        @endforeach
        </tbody>
      </table>
{!!$events->render()!!}
@stop
