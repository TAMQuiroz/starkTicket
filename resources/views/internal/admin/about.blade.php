@extends('layout.admin')

@section('style')

@stop

@section('title')
	Acerca de nosotros
@stop

@section('content')
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post" id="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  <textarea rows="6" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Misión</label>
                <div class="col-sm-10">
                  <textarea rows="6" class="form-control" id="mision"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Visión</label>
                <div class="col-sm-10">
                  <textarea rows="6" class="form-control" id="vision"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Historia</label>
                <div class="col-sm-10">
                  <textarea rows="6" class="form-control"  id="historia"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">URL YOUTUBE</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" required>
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
    CKEDITOR.replace( 'vision',
    {
        toolbar : 'Basic',
    });
    CKEDITOR.replace( 'historia',
    {
        toolbar : 'Basic',
    });
    CKEDITOR.replace( 'mision',
    {
        toolbar : 'Basic',
    });
  </script>
@stop