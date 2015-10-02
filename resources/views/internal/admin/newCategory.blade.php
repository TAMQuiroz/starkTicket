@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva Categoria
@stop

@section('content')
  <!-- Contenido-->
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
          <label class="col-sm-2" for="isSub">Subcategoria?</label>
          <div class="col-sm-10">
            <input id="isSub" type="checkbox" data-toggle="collapse" data-target="#subcategoryForm">  
          </div>
        </div>
        <div id="subcategoryForm" class="collapse form-group">
          <label class="col-sm-2" for="subcategory">Eliga Categoria</label>
          <div class="col-sm-10">
            <select id="subcategory" type="select" class="form-control">
              <option>Conciertos</option>
              <option>Teatro</option>
              <option>Niños</option>
            </select> 
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-info">Guardar</button>
            <button type="reset" class="btn btn-info">Cancelar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop

@section('javascript')

@stop