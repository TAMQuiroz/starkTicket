@extends('layout.admin')

@section('style')

@stop

@section('title')
  Inf. Sistema
@stop

@section('content')
	<form action="../home" enctype="multipart/form-data">
	    <div class="top-title">
	        <h3>
	             Editar logotipo y nombre
	        </h3>
	    </div>
	    <div class="bottom-content">
	        <div class="row">
	            <div class="col-sm-4">
	                <div class="text-center">
	                Logo <br>
	                    <img src="#" id="image-input" class="img-circle" width="200" height="200">

	                        {!! Form::file('image',['id' => 'file-input']) !!}
	                </div>
	            </div>
	            <div class="col-sm-8">
	            	Nombre <br>
					<input type="text" name="name" value="teleticke" placeholder="Name" class="entradas full-width-input">
	            </div>
	            <div class="col-sm-12">
		            <button type="submit" class="btn btn-link add_link" >
		                Guardar Cambios
		            </button>
	            </div>
	        </div>
	    </div>
    </form>

    <hr>

     <div class="container">
        <h1 class="page-header">
        <!-- Titulo-->
        Inf. Sistema
        <!-- Final Titulo -->
        </h1>
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Razon Social</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">RUC:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre Comercial</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Favicon</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="inputEmail3" placeholder="">
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