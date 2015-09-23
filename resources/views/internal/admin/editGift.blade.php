@extends('layout.admin')

@section('style')

@stop

@section('title')
	Editar Regalo
@stop

@section('content')
	<div class="container">
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Sable laser">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Stock</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="stock" placeholder="" value="10">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Numero de puntos</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="stock" placeholder="" value="200">
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
                  <textarea class="form-control" rows="5">Un hombre va al médico. Le cuenta que está deprimido. Le dice que la vida le parece dura y cruel. Dice que se siente muy solo en este mundo lleno de amenazas donde lo que nos espera es vago e incierto. El doctor le responde; “El tratamiento es sencillo, el gran payaso Pagliacci se encuentra esta noche en la ciudad, vaya a verlo, eso lo animará”. El hombre se echa a llorar y dice “Pero, doctor… yo soy Pagliacci”.
                  </textarea>
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