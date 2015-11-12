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
                                @foreach($seats as $seat)
                                F{{$seat->row}}C{{$seat->column}}
                                @endforeach
                            @else
                                No numerado
                            @endif
                        </td>
                        @if($ticket->promo)
                        <td>{{$ticket->promo->name}}</td>
                        @else
                        <td>No tiene</td>
                        @endif
                        <td>S/. {{$ticket->price}}</td>
                        <td>S/. {{$ticket->total_price}}</td>
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