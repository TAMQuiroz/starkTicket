@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Nuevo Evento
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Organizador</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                  <a href="#">New</a>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
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
                <label for="inputEmail3" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Hora</label>
                <div class="col-sm-10">
                  <input type="time" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Categoria</label>
                <div class="col-sm-10">
                  <select class="form-control">
                    <option>Categoria 1</option>
                    <option>Categoria 2</option>
                    <option>Categoria 3</option>
                    <option>Categoria 4</option>
                    <option>Categoria 5</option>
                    <option>Categoria 6</option>
                    <option>Categoria 7</option>
                  </select>
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