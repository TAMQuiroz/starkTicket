@extends('layout.client')

@section('style')
@stop

@section('title')
Cambia información
@stop

@section('content')
<div class="row">
{!! Form::model($obj, [ 'method' => 'POST', 'url' => 'client/update']) !!}

    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('name', 'Nombre:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lastname', 'Apellidos:', ['class' => 'control-label']) !!}
            {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
    </div>

{!! Form::close() !!}
</div>

@stop

@section('javascript')

@stop