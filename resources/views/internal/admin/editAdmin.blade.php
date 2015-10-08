@extends('layout.admin')

@section('style')

@stop

@section('title')
  Editar Administrador
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
             {!!Form::open(array('url' => 'admin/admin/'.$user->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                   {!!Form::input('text','name', $user->name ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  {!!Form::input('text','lastname', $user->lastname ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-10">
                    {!!Form::input('password','password', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tipo de documento</label>
                <div class="col-sm-10">
                  {!! Form::select('di_type', [
                     '1' => 'DNI',
                     '2' => 'Carnet de Extranjeria'], $user->di_type, ['class'=>'form-control']
                  ) !!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Documento de Identidad</label>
                <div class="col-sm-10">
                  {!!Form::input('text','di', $user->di ,['class'=>'form-control','id'=>'inputEmai3','required'])!!} 
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  {!!Form::input('text','address', $user->address ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Teléfono(s)</label>
                <div class="col-sm-10">
                  {!!Form::input('text','phone', $user->phone ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">E-mail(s)</label>
                <div class="col-sm-10">
                    {!!Form::input('text','email', $user->email ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nacimiento</label>
                <div class="col-sm-10">
                    {!!Form::input('date','birthday', explode(" ",$user->birthday)[0],['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Cargo</label>
                <div class="col-sm-10">
                {!!Form::select('role_id', ['2' => 'Vendedor', '3' => 'Promotor de Ventas',  '4'=>'Administrador'], $user->role_id, ['class'=>'form-control','required'])!!}
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