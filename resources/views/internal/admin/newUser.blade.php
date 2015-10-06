@extends('layout.admin')

@section('style')

@stop

@section('title')
	Agregar trabajador
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
             {!!Form::open(array('url' => 'admin/user/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                   {!!Form::input('text','name', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  {!!Form::input('text','lastname', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}

                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">DNI</label>
                <div class="col-sm-10">
                  {!!Form::input('text','dni', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!} 
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  {!!Form::input('text','address', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Teléfono(s)</label>
                <div class="col-sm-10">
                  {!!Form::input('text','phone', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">E-mail(s)</label>
                <div class="col-sm-10">
                    {!!Form::input('text','email', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}

                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Cargo</label>
                <div class="col-sm-10">
                {!!Form::select('role_id', ['2' => 'Vendedor', '3' => 'Promotor de Ventas',  '4'=>'Administrador'], null, ['class'=>'form-control','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                
                    {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'inputEmai3'])!!}

                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <!-- <a class="btn btn-info"  data-toggle="modal" data-target="#agregado">Guardar</a> -->
                  <button type="submit" class="btn btn-info">Guardar</button>
                  <button type="reset" class="btn btn-info">Cancelar</button
                </div>
              </div>
           {!!Form::close()!!}
          </div>
        </div>
@stop

@section('javascript')

@stop