@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Entrega de entrada
@stop

@section('content')
    {!!Form::open(array('route' => 'ticket.giveaway','id'=>'form'))!!}
    <div class="col-md-6">
    	<h5>Ingrese Código de Comprobante</h5>
        <div class="input-group" style="width:290px">
            {!! Form::number('sale_id', null, array('class' => 'form-control', 'placeholder'=>'Código de comprobante','required','min'=>1)) !!} 
        </div><!-- /input-group -->
    </div>
    <div class="col-md-6">
        <h5>Ingrese DNI de designado</h5>
        <div class="input-group" style="width:290px">
            {!! Form::number('designee', null, array('class' => 'form-control', 'placeholder'=>'Código de designado','required','maxlength'=>8,'min'=>10000000)) !!} 
            <span class="input-group-btn">
                {!!Form::submit('Buscar',array('id'=>'yes','class'=>'btn btn-info'))!!}
            </span>
        </div><!-- /input-group -->
    </div>
    {!!Form::close()!!}

        
@stop

@section('javascript')

@stop