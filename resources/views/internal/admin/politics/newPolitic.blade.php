@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva Politica
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
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-10">
                  <input type="textarea" class="form-control" id="inputEmail3" placeholder="">
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