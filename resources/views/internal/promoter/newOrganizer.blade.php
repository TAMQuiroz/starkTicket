@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Nuevo Organizador
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            {!!Form::open(array('url' => 'promoter/organizer/create','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}

              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!!Form::input('text','organizerName', null ,['class'=>'form-control','required'])!!}
                </div>

              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  {!!Form::input('text','organizerLastName', null ,['class'=>'form-control','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Razón social</label>
                <div class="col-sm-10">
                  {!!Form::input('text','businessName', null ,['class'=>'form-control','required'])!!}

                </div>
              </div>                
              <div class="form-group">
                <label class="col-sm-2 control-label">Ruc</label>
                <div class="col-sm-10">
                  {!!Form::input('text','ruc', null ,['class'=>'form-control','required'])!!}
                </div>
              </div>      
              <div class="form-group">
                <label class="col-sm-2 control-label">Número de cuenta</label>
                <div class="col-sm-10">
                  {!!Form::input('text','countNumber', null ,['class'=>'form-control','required'])!!}
                 </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Teléfono</label>
                <div class="col-sm-10">
                  {!!Form::input('text','telephone', null ,['class'=>'form-control','required'])!!}
 
                 </div>
              </div>                                                          
              <div class="form-group">
                <label class="col-sm-2 control-label">DNI</label>
                <div class="col-sm-10">
                  {!!Form::input('text','dni', null ,['class'=>'form-control','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                  {!!Form::input('text','email', null ,['class'=>'form-control','required'])!!}                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  {!!Form::input('text','address', null ,['class'=>'form-control','required'])!!}                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                  {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Guardar</button>
                  <button type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>
           {!!Form::close()!!}
          </div>
        </div>
@stop

@section('javascript')

@stop