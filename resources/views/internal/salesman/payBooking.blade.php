@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Cobrar Reserva
@stop

@section('content')
<fieldset>
    <div class="col-md-6">
        <h5>Ingrese DNI de designado</h5>
        <div class="input-group" style="width:290px">
            {!! Form::number('designee', null, array('class' => 'form-control', 'placeholder'=>'Código de designado','required','maxlength'=>8,'min'=>10000000)) !!} 
            <span class="input-group-btn" type="button" data-toggle="collapse" data-target="#detail">
                {!!Form::submit('Buscar',array('id'=>'yes','class'=>'btn btn-info'))!!}
            </span>
        </div><!-- /input-group -->
        <div id="detail" class="collapse">
            <br>
            <h5>Reservas:</h5>
            <div class="table-responsive">
              <table class="table table-bordered" style="widht:1px">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Función</th>
                        <th>Zona</th>
                        <th>Cantidad</th>
                        <th>Total (S/.)</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Piaf</td>
                        <td>13 Octubre 2015</td>
                        <td>VIP</td> 
                        <td>2</td>
                        <td>S/150.00</td>
                        <td>{!! Form::radio('pay_event', '', array('id'=>'true', 'class'=>'radio  pay','required'))!!}</td>
                    </tr>
                    <tr>
                        <td>Piaf</td>
                        <td>13 Octubre 2015</td>
                        <td>VIP</td>  
                        <td>5</td>
                        <td>S/150.00</td>
                        <td>{!! Form::radio('pay_event', '', array('id'=>'true', 'class'=>'radio  pay','required'))!!}</td>
                    </tr>
                </tbody>
              </table>
            </div>
            <a href=""><button class="btn btn-info">Aceptar</button></a>
            <a href="{{url('salesman')}}"><button class="btn btn-info">Cancelar</button></a>
        </div>
    </div>


</fieldset>
  
@stop

@section('javascript')

@stop