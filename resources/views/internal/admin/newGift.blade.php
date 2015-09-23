@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nuevo Regalo
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    <form class="form-horizontal" method="post">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Stock</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="stock" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Numero de puntos</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="stock" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
        <div class="col-sm-10">
          <textarea class="form-control" rows="5"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a class="btn btn-primary"  data-toggle="modal" data-target="#agregado">Guardar</a>
          <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@stop

@section('javascript')

@stop