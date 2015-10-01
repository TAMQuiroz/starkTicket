@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nuevo local
@stop

@section('content')
<div class="row">
	<div class="col-sm-8">
    {!!Form::open(array('url' => '','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          {!!Form::input('text','name', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Capacidad</label>
        <div class="col-sm-10">
          {!!Form::input('number','capacity', null ,['class'=>'form-control','id'=>'stock','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Direccion</label>
        <div class="col-sm-10">
          {!!Form::input('text','address', null ,['class'=>'form-control','id'=>'stock','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
        <div class="col-sm-10">
          {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
        </div>
      </div>
      {!!Form::close()!!}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="{{url('admin/local')}}"><button type="submit" class="btn btn-info">Guardar</button></a>
          <button type="reset" class="btn btn-info">Cancelar</button>
        </div>
      </div>
    
  	</div>
</div>
@stop

@section('javascript')

@stop