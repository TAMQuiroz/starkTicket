@extends('layout.admin')

@section('style')

@stop

@section('title')
    Editar Politica
@stop

@section('content')
	<div class="container">
        <h1 class="page-header">
        <!-- Titulo-->
        
        <!-- Final Titulo -->
        </h1>
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Politica 1">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5">Lorem ipsum dolor sit amet.</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
                <div class="col-sm-10">
                  <label class="radio-inline"><input type="radio" name="optradio">Activo</label>
                  <label class="radio-inline"><input type="radio" name="optradio">Inactivo</label> 
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
        <!-- Final Contenido -->
     </div>
@stop

@section('javascript')

@stop