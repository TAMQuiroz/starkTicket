@extends('layout.client')

@section('style')
@stop

@section('title')
Cambia información
@stop

@section('content')
<div class="row">
{!! Form::model($obj, [ 'method' => 'POST', 'url' => 'client/update','id'=>'form']) !!}

    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('name', 'Nombre:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lastname', 'Apellidos:', ['class' => 'control-label']) !!}
            {!! Form::text('lastname', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', 'Dirección', ['class' => 'control-label']) !!}
            {!! Form::text('address', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'Telefono', ['class' => 'control-label']) !!}
            {!! Form::text('phone', null, ['class' => 'form-control','required']) !!}
        </div>


    </div>

    <h1>Seleccione su preferencia de eventos</h1>

    <br>
    <div class="row preferences-div">


    @foreach($categories as $category)
    <!--
      <label  class="control-label">{{$category->name}}</label>
          <div class="preferences-chbox">
              {!! Form::checkbox($category->name, $category->id, null, ['class' => 'checkbox']) !!}
          </div>
      </div>

    -->

        <div class="opt-div">
          <label class="control-label">{{$category->name}}</label>
          <div class="preferences-chbox">
              {!! Form::checkbox($category->name, $category->id, null, ['class' => 'checkbox']) !!}
          </div>
        </div>
        
     

    @endforeach
          
    </div>

    <br>
    {!! Form::submit('Actualizar', ['class' => 'btn btn-info']) !!}


    <style type="text/css">
      .preferences-div label{
          width: 125px;
      }
      /*
      .preferences-div label:first-child{
          margin-left: 0px;
      }
      */      
      .preferences-chbox{
          width: 10px;
          display: inline-block;
      }
      .opt-div{
        width: 250px;
        margin-bottom: 30px;
      }

    </style>

{!! Form::close() !!}
</div>

@stop

@section('javascript')

@stop