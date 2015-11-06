@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nuevo local
@stop

@section('content')
<div class="row">
	<div class="col-sm-8">
    {!!Form::open(array('url' => 'admin/local/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          {!!Form::input('text','name', null ,['class'=>'form-control','id'=>'name','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputAddress" class="col-sm-2 control-label">Dirección</label>
        <div class="col-sm-10">
          {!!Form::input('text','address', null ,['class'=>'form-control','id'=>'address','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputDistrict" class="col-sm-2 control-label">Distrito</label>
        <div class="col-sm-10">
          {!!Form::input('text','district', null ,['class'=>'form-control','id'=>'district','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputProvince" class="col-sm-2 control-label">Provincia</label>
        <div class="col-sm-10">
          {!!Form::input('text','province', null ,['class'=>'form-control','id'=>'province','required'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputState" class="col-sm-2 control-label">Departamento</label>
        <div class="col-sm-10">
          {!!Form::input('text','state', null ,['class'=>'form-control','id'=>'state','required'])!!}
        </div>
      </div>



      <div class="form-group">
        <label for="local_type" class="col-sm-2 control-label">Numerado</label>
        <div class="col-sm-10">
          {!!Form::radio('local_type', config('constants.numbered'),true,['onChange'=>'changeNumbered(this)'])!!} 
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Filas</label>
        <div class="col-sm-10">
         {!!Form::input('number','row', null ,['class'=>'form-control','id'=>'row','required','min'=>0])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Columnas</label>
        <div class="col-sm-10">
          {!!Form::input('number','column', null ,['class'=>'form-control','id'=>'column','required','min'=>0])!!}
        </div>
      </div>

      <div class="form-group">
        <label for="local_type" class="col-sm-2 control-label">No Numerado</label>
        <div class="col-sm-10">
          {!!Form::radio('local_type', config('constants.notNumbered'),null,['onChange'=>'changeNumbered(this)'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Capacidad</label>
        <div class="col-sm-10">
          {!!Form::input('number','capacity', null ,['class'=>'form-control','id'=>'capacity','required','min'=>0,'disabled'])!!}
        </div>
      </div>
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
        <div class="col-sm-10">
          {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'image', 'required'])!!}
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{action('LocalController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea crear el local?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      {!!Form::close()!!}
  	</div>
</div>
@stop

@section('javascript')
{!!Html::script('js/local.js')!!}
<script type="text/javascript">
  $('#yes').click(function(){
    $('#submitModal').modal('hide');  
  });
  
</script>
@stop