@extends('layout.client')

@section('style')
	{!!Html::style('css/seats.css')!!}
    <style type="text/css">
        .btn-info{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-info:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .form-control{
          width: 360px;
          display: inline-block;
        }
        label{
          width: 180px;
        }
    </style>
@stop

@section('title')
	{{$event->name}}
@stop

@section('content')
    <form action="{{action('BookingController@store')}}" enctype="multipart/form-data">		
       <!-- Content -->
      <div>
          <h5>Selecciona función</h5>
          {!! Form::select('presentation_id', $presentations->toArray(), null, ['class' => 'form-control'])!!}
          <h5>Selecciona Zona y Promoción</h5>
          {!! Form::select('zone_id',$zones->toArray(), null, ['class' => 'form-control']) !!}
          {!! Form::select('promotion', ['Ninguna', 'Visa Platinium'], null, ['class' => 'form-control']) !!}
      </div>
      <br>
      <!--<legend>Selección de Ubicación</legend>
      <h5>Zona:</h5>
      {!! Form::text('selectedZone', 'VIP', ['class' => 'form-control', 'disabled']) !!}-->
      <br>
      @if($event->place->rows != null)
            
        
        <legend>Selección de Ubicación</legend>
        <div class="seats">
            <div class="demo">
                <div id="parent-map">
                    <div id="seat-map"></div>
                </div>
                <br>
                <div class="booking-details">
                    <h4 style="text-decoration:underline;text-align: center;">Resumen</h4>
                    <p>Evento: <span> {{$event->name}}</span></p>
                    <p>Asiento(s): </p>
                    <ul id="selected-seats"></ul>
                    <p>Tickets: <span id="counter">0</span></p>
                    <p>Total: <b>S/.<span id="total">0</span></b></p>
                    <div id="legend"></div>
                </div>
                <div style="clear:both"></div>
           </div>
        </div>
        {!!Form::hidden('seats',null,['id'=>'seats'])!!}
        <div class="col-md-3">
            Cantidad: {!!Form::number('quantity',0,['id'=>'quantity','readonly', 'class'=>'form-control'])!!}
        </div>
        @else
        
        <div class="col-md-3">
            Cantidad: {!!Form::number('quantity',0,['id'=>'quantity','class'=>'form-control','min'=>'1'])!!}
        </div>
        @endif
      <br>
      <button type="button" id="payModal" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo" >Reservar Entrada</button>
      <a href="{{url('salesman/')}}"><button type="button" class="btn btn-info">Cancelar Reserva</button></a>

      <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Detalle de Reserva:</h4>
            </div>
            <div class="modal-body">
              <label>Costo Total:</label>
              {!! Form::text('total', 'S/. 300.00', ['class' => 'form-control', 'disabled']) !!}
              <hr>  
                <form>
                  <div class="form-group">
                    <div class="form-group">
                      <label>Fecha de expiración</label>
                      {!! Form::text('expiration', '', ['class' => 'form-control', 'placeholder' => 'mm/aa']) !!}
                      <label for="exampleInputEmail2">Persona Autorizada</label>
                      {!! Form::text('autorized', '', ['class' => 'form-control', 'placeholder' => 'Juan Pérez']) !!}
                    </div>
                    <a href="{{url('client/reservaexitosa')}}"><button type="button" class="btn btn-info">Reservar Entrada</button></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
            </div>
          </div>
           
        </div>  

    <!--<div class="seats">
      <div class="demo">
          <div id="seat-map">
          <div class="front">Escenario</div>          
      </div>
        <div class="booking-details">
          
          <p>Día: {!! Form::text('selectedDate', 'Octubre 13, 21:00', ['class' => 'form-control', 'disabled']) !!}</p>
          <p>Asiento(s): </p>
          <ul id="selected-seats"></ul>
          <p>Tickets: <span id="counter">0</span></p>
          <p>Total: <b>S/.<span id="total">0</span></b></p>
          <div id="legend"></div>
              
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Reservar Entrada</button>
          <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">Detalle de Reserva:</h4>
                  </div>
                  <div class="modal-body">
                    <label>Costo Total:</label>
                    {!! Form::text('total', 'S/. 300.00', ['class' => 'form-control', 'disabled']) !!}
                    <hr>  
                      <form>
                        <div class="form-group">
                          <div class="form-group">
                            <label>Fecha de expiración</label>
                            {!! Form::text('expiration', '', ['class' => 'form-control', 'placeholder' => 'mm/aa']) !!}
                            <label for="exampleInputEmail2">Persona Autorizada</label>
                            {!! Form::text('autorized', '', ['class' => 'form-control', 'placeholder' => 'Juan Pérez']) !!}
                          </div>
                          <a href="{{url('client/reservaexitosa')}}"><button type="button" class="btn btn-info">Reservar Entrada</button></a>
                          <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                  </div>
                </div>
             
          </div>  
        </div>
        <div style="clear:both"></div>

    </div>-->

			
@stop

@section('javascript')
		
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
  {!!Html::script('js/main.js')!!}
  <script type="text/javascript">
        var config = {
        routes: [
            { zone: "{{ URL::route('ajax.getClient') }}" },
            { price_ajax: "{{ URL::route('ajax.getPrice') }}" },
            { event_available: "{{URL::route('ajax.getAvailable')}}"},
            { slots: "{{URL::route('ajax.getSlots')}}"},
            { makeArray: "{{URL::route('ajax.getZone')}}"},
            { takenSlots: "{{URL::route('ajax.getTakenSlots')}}"}
        ]
    };
    </script>

@stop