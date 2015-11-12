@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Entrega de entrada
@stop

@section('content')
    
    <div class="col-md-12">
        <div id="detail">
            <br>
            <h5>Detalle de compra:</h5>
            <div class="table-responsive">
              <table class="table table-bordered" style="widht:1px">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Fecha y Hora</th>
                        <th>Cantidad</th>
                        <th>Zona</th>
                        <th>Ubicación</th>
                        <th>Promocion</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$ticket->event->name}}</td>
                        <td>{{date("Y-m-d h:i", $ticket->presentation->starts_at)}}</td>
                        <td>{{$ticket->quantity}}</td>
                        <td>{{$ticket->zone->name}}</td>  
                        <td>
                            @if($ticket->event->place->rows != null)
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#place{{$ticket->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button>
                            @else
                                No numerado
                            @endif              
                        </td>

                        <!-- MODAL view-->
                        <div class="modal fade" id="place{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="exampleModalLabel">Asientos comprados: {{$ticket->event->name}}</h4>
                                </div>
                                <div class="modal-body">
                                  <form>
                                    <div class="form-group">
                                      <h4>Asientos:</h4>
                                      <ul>
                                        @foreach($seats as $seat)
                                          <li>
                                              F{{$seat->row}}C{{$seat->column}}

                                          </li>
                                        @endforeach
                                      </ul>
                                    </div>

                                  </form>
                              
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-info" data-dismiss="modal" >Aceptar</button>


                                </div>
                              </div>
                            </div>
                          </div>
                          
                        @if($ticket->promo)
                        <td>{{$ticket->promo->name}}</td>
                        @else
                        <td>No tiene</td>
                        @endif
                        <td>S/. {{$ticket->price}}</td>
                        @if($ticket->promo && $ticket->promo->carry != null)
                        <td>S/. {{$ticket->price * $ticket->quantity - ($ticket->price*floor($ticket->quantity/$ticket->promo->carry))}}</td>
                        @else
                        <td>S/. {{$ticket->price * $ticket->quantity - ($ticket->price * $ticket->quantity * $ticket->discount/100)}}</td>
                        @endif
                    </tr>
                </tbody>
              </table>
              {!!Form::open(['route'=>'ticket.giveaway.confirm'])!!}
              {!!Form::hidden('sale_id',$ticket->id)!!}
              {!!Form::submit('Confirmar', ['class'=>'btn btn-info'])!!}
              {!!Form::close()!!}
              
            </div>
        </div>
    </div>
        
@stop

@section('javascript')

@stop