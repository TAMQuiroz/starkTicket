@extends('layout.client')

@section('style')

@stop

@section('title')

Cambia información
@stop

@section('content')
<div class="row">


{!!Form::open(array('url' => 'client/password','id'=>'form','class'=>'form-horizontal'))!!}

    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('password', 'Contraseña:', ['class' => 'control-label']) !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Nueva Contraseña:', ['class' => 'control-label']) !!}
            {!! Form::text('new_password', null, ['class' => 'form-control']) !!}
            <span class="help-block small">Ingrese mínimo 8 caracteres.</span>
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Confirmar:', ['class' => 'control-label']) !!}
            {!! Form::text('new_password_confirmation', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Actualizar', ['class' => 'btn btn-info']) !!}
    </div>

{!! Form::close() !!}
</div>
<br>
@include('errors.list')
@stop

@section('javascript')

@stop