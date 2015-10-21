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
            {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'New Password:', ['class' => 'control-label']) !!}
            {!! Form::text('new_password', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Confirmed:', ['class' => 'control-label']) !!}
            {!! Form::text('new_password_confirmation', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
    </div>

{!! Form::close() !!}
</div>

@stop

@section('javascript')

@stop