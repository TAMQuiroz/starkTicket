@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nuevo Regalo
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    <form class="form-horizontal" method="post" id="form">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Stock</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="stock" placeholder="" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Numero de puntos</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="stock" placeholder="" required>
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
          <textarea class="form-control" rows="5" id="description"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@stop

@section('javascript')

<script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
  <script type="text/javascript">
    CKEDITOR.replace( 'description',
    {
        toolbar : 'Basic',
    });
  </script>
@stop