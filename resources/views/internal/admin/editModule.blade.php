@extends('layout.admin')

@section('style')

@stop

@section('title')
	Editar punto de venta
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <!--
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Nombre punto de venta">
                  -->
                  {!!Form::text('name', 'Nombre punto de venta' ,['class'=>'form-control','id'=>'inputEmail3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Direción</label>
                <div class="col-sm-10">
                  <!--
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Direccion punto de venta">
                  -->
                  {!!Form::text('address', 'Direccion punto de venta' ,['class'=>'form-control','id'=>'inputEmail3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Departamento</label>
                <div class="col-sm-10">
                  <!--
                  <select class="form-control">
                    <option>Departamento 1</option>
                    <option>Departamento 2</option>
                    <option>Departamento 3</option>
                    <option>Departamento 4</option>
                  </select>
                  -->
                  {!!Form::select('select1', [
                     'op0' => 'Departamento 1',
                     'op1' => 'Departamento 2',
                     'op2' => 'Departamento 3',
                     'op3' => 'Departamento 4'],
                     null,
                     ['class' => 'form-control']
                  )!!}

                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Provincia</label>
                <div class="col-sm-10">
                  <!--
                  <select class="form-control">
                    <option>Provincia 1</option>
                    <option>Provincia 2</option>
                    <option>Provincia 3</option>
                    <option>Provincia 4</option>
                  </select>
                  -->
                  {!!Form::select('select2', [
                     'op0' => 'Provincia 1',
                     'op1' => 'Provincia 2',
                     'op2' => 'Provincia 3',
                     'op3' => 'Provincia 4'],
                     null,
                     ['class' => 'form-control']
                  )!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a class="btn btn-info"  data-toggle="modal" data-target="#agregado">Guardar</a>
                  <button type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
@stop

@section('javascript')

@stop