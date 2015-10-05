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
	Piaf de Pam Gems
@stop

@section('content')
    <form action="{{action('BookingController@store')}}" enctype="multipart/form-data">		
       <!-- Content -->
      <div>
          <h5>Selecciona fecha y horario</h5>
          {!! Form::select('date', ['13 de Octubre', '14 de Octubre', '15 de Octubre'], null, ['class' => 'form-control']) !!}
          {!! Form::select('hour', ['18:00', '21:00'], null, ['class' => 'form-control']) !!}
          <h5>Selecciona Zona y Promoción</h5>
          {!! Form::select('zone', ['VIP', 'Platea'], null, ['class' => 'form-control']) !!}
          {!! Form::select('promotion', ['Ninguna', 'Visa Platinium'], null, ['class' => 'form-control']) !!}
      </div>
      <br>
      <legend>Selección de Ubicación</legend>
      <h5>Zona:</h5>
      {!! Form::text('selectedZone', 'VIP', ['class' => 'form-control', 'disabled']) !!}
      <br>
    <div class="seats">
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
        </div>
        <div style="clear:both"></div>
    </div>

			
@stop

@section('javascript')
		
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}

@stop