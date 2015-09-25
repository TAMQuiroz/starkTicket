@extends('layout.admin')

@section('style')

@stop

@section('title')
  Inf. Sistema
@stop

@section('content')
  <div class="row">
  <div class="col-sm-8">
    <form class="form-horizontal" method="post" id="form">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Razon Social</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">RUC:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder=""  required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre Comercial</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Dirección</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" id="inputEmail3" placeholder="" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Favicon</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" id="inputEmail3" placeholder="" required>
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

@stop