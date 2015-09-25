@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva devolucion de ticket
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    <form class="form-horizontal" method="post">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Ticket</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="">
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