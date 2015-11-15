@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Cobrar Reserva
@stop

@section('content')
<ul class="alert alert-danger" id="erroresp" hidden> </ul>
<fieldset>
    <div class="col-md-6">
        <h5>Ingrese DNI de designado</h5>
        <div class="input-group" style="width:290px">
            {!! Form::number('designee', null, array('class' => 'form-control', 'placeholder'=>'Código de designado','required','maxlength'=>8,'size'=>8, 'id'=>'dni_recojo')) !!} 
            <span class="input-group-btn" type="button">
                {!!Form::button('Buscar',array('id'=>'buscareserva','class'=>'btn btn-info', 'onclick' => 'getReserves()'))!!}
            </span>
        </div><!-- /input-group -->
        {!!Form::open(array('route' => 'booking.show','id'=>'form','class'=>'form-horizontal'))!!}
        <div id="detail" >
            <br>
            <h5>Reservas:</h5>
            <div class="table-responsive">
              <table class="table table-bordered" style="widht:1px">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Evento</th>
                        <th>Función</th>
                        <th>Zona</th>
                        <th>Cantidad</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody id="tbody_reserve">
                </tbody>
              </table>
            </div>
            <input type="submit" class="btn btn-info">
            <a href="{{url('salesman')}}"><button class="btn btn-info">Cancelar</button></a>
        </div>
    </div>


</fieldset>
  
@stop

@section('javascript')
 {!!Html::script('js/main.js')!!}
 <script type="text/javascript">
    var config = {
        routes: [
            { reserve: "{{ URL::route('ajax.getReserves') }}" },
        ]
    };
    </script>
@stop