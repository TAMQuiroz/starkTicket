@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nuevo Regalo
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'admin/gifts/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          {!!Form::input('text','name', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Stock</label>
        <div class="col-sm-10">
          {!!Form::input('number','stock', null ,['class'=>'form-control','id'=>'stock','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Numero de puntos</label>
        <div class="col-sm-10">
          {!!Form::input('number','points', null ,['class'=>'form-control','id'=>'points','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
        <div class="col-sm-10">
          {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'inputEmail3','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
        <div class="col-sm-10">
          {!!Form::textarea('description', null, ['class'=>'form-control','size' => '30x5','required']) !!}
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-info">Guardar</button>
          <a href="{{action('GiftController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>
    {!!Form::close()!!}
  </div>
</div>
@stop

@section('javascript')

@stop