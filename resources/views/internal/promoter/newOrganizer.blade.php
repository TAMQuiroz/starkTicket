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
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!! Form::text('organizerName','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  {!! Form::text('organizerLastName','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Razón social</label>
                <div class="col-sm-10">
                  {!! Form::text('businessName','', array('class' => 'form-control','required')) !!}
                </div>
              </div>                
              <div class="form-group">
                <label class="col-sm-2 control-label">Ruc</label>
                <div class="col-sm-10">
                  {!! Form::text('ruc','', array('class' => 'form-control','required')) !!}
                </div>
              </div>      
              <div class="form-group">
                <label class="col-sm-2 control-label">Número de cuenta</label>
                <div class="col-sm-10">
                  {!! Form::text('countNumber','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Teléfono</label>
                <div class="col-sm-10">
                  {!! Form::text('telephone','', array('class' => 'form-control')) !!}
                </div>
              </div>                                                          
              <div class="form-group">
                <label class="col-sm-2 control-label">DNI</label>
                <div class="col-sm-10">
                  {!! Form::text('dni','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                  {!! Form::text('email','', array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  {!! Form::text('address','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                  {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a class="btn btn-info">Guardar</a>
                  <button type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
@stop

@section('javascript')

@stop