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
                        <th>Fecha y hora</th>
                        <th>Zona</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->event->name}}</td>
                        <td>{{date("Y-m-d h:i", $ticket->presentation->starts_at)}}</td>
                        <td>{{$ticket->zone->name}}</td>  
                        <td>
                            @if($ticket->seat_id != null)
                                F{{$ticket->seat->row}}C{{$ticket->seat->column}}
                            @else
                                No numerado
                            @endif
                        </td>
                        <td>S/. {{$ticket->price}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {!!Form::open(['route'=>'ticket.giveaway.confirm'])!!}
              {!!Form::hidden('sale_id',$tickets[0]->sale_id)!!}
              {!!Form::submit('Confirmar', ['class'=>'btn btn-info'])!!}
              {!!Form::close()!!}
              
            </div>
        </div>
    </div>
        
@stop

@section('javascript')

@stop