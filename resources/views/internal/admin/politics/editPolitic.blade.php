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
                  <!--
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Politica 1">
                  -->
                  {!!Form::text('name', 'Politica 1' ,['class'=>'form-control','id'=>'inputEmail3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  <!--
                  <textarea class="form-control" rows="5">Lorem ipsum dolor sit amet.</textarea>
                  -->
                  {!!Form::textarea('description', '' ,['class'=>'form-control','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
                <div class="col-sm-10">
                  <!--
                  <label class="radio-inline"><input type="radio" name="optradio">Activo</label>
                  -->
                  <label class="radio-inline">{!!Form::radio('optradio','active','true')!!}Activo</label>
                  <!--
                  <label class="radio-inline"><input type="radio" name="optradio">Inactivo</label> 
                  -->
                  <label class="radio-inline">{!!Form::radio('optradio','inactive')!!}Inactivo</label> 
                </div>
              </div> 
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a class="btn btn-info"  data-toggle="modal" data-target="#save" data-whatever="@mdo">Guardar</a>
                  <a class="btn btn-info" href="{{url('admin/politics')}}">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Final Contenido -->
     </div>

    <div class="modal fade" id="save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Politica</h4>
            </div>
            <div class="modal-body">
                <form>
                  <div class="form-group">
                      <div class="form-group">
                        <label for="exampleInputEmail2">La política fue editada!</label>
                  </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@stop

@section('javascript')

@stop