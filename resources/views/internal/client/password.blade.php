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
          <div class="col-sm-6"
                {!! Form::label('password', 'Contraseña:', ['class' => 'control-label']) !!}
          </div>
           <div class="col-sm-6">
                {!! Form::password('password', null, ['class' => 'form-control']) !!}
          </div>

        </div>
        <div class="form-group">
        <br>

          <div class="col-sm-6">
              {!! Form::label('password', 'Nueva Contraseña:', ['class' => 'control-label']) !!}
          </div>
          <div class="col-sm-6">
              {!! Form::password('new_password', null, ['class' => 'form-control']) !!}
              <span class="help-block small">Ingrese mínimo 8 caracteres.</span>

          </div>
 
        </div>
        <div class="form-group">
          <div class="col-sm-6">
            {!! Form::label('password', 'Confirmar:', ['class' => 'control-label']) !!}
          </div>
           
          <div class="col-sm-6">
            {!! Form::password('new_password_confirmation', null, ['class' => 'form-control']) !!}
          </div>
        </div>
        <div class="form-group">
        <br><br>
        <div class="col-sm-2">
            {!! Form::submit('Actualizar', ['class' => 'btn btn-info']) !!}
         </div>
           
        </div>
    </div>

{!! Form::close() !!}
</div>
<br>
@include('errors.list')

@stop

@section('javascript')

@stop