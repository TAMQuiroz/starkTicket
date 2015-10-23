@extends('layout.admin')

@section('style')

@stop

@section('title')
	Editar local
@stop

@section('content')
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('url' => 'admin/local/'.$local->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
         <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                {!!Form::input('text','name', $local->name ,['class'=>'form-control','id'=>'name','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Capacidad</label>
              <div class="col-sm-10">
                {!!Form::input('number','capacity', $local->capacity ,['class'=>'form-control','id'=>'capacity','required','min'=>0])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress" class="col-sm-2 control-label">Dirección</label>
              <div class="col-sm-10">
                {!!Form::input('text','address', $local->address ,['class'=>'form-control','id'=>'address','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputDistrict" class="col-sm-2 control-label">Distrito</label>
              <div class="col-sm-10">
                {!!Form::input('text','district', $local->district ,['class'=>'form-control','id'=>'district','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputProvince" class="col-sm-2 control-label">Provincia</label>
              <div class="col-sm-10">
                {!!Form::input('text','province', $local->province ,['class'=>'form-control','id'=>'province','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputState" class="col-sm-2 control-label">Departamento</label>
              <div class="col-sm-10">
                {!!Form::input('text','state', $local->state ,['class'=>'form-control','id'=>'state','required'])!!}
              </div>

            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Filas</label>
              <div class="col-sm-10">
                {!!Form::input('number','row', $local->row ,['class'=>'form-control','id'=>'row','required','min'=>0])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Columnas</label>
              <div class="col-sm-10">
                {!!Form::input('number','column', $local->column ,['class'=>'form-control','id'=>'column','required','min'=>0])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
              <div class="col-sm-10">
                {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'image'])!!}
                {{$local->image}}
              </div>
            </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-info">Guardar</button>
            <a href="{{action('LocalController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>
      {!!Form::close()!!}
    </div>
  </div>
@stop

@section('javascript')

@stop