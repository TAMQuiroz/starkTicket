<!-- resources/views/auth/register.blade.php -->

@extends('layoutExternal')

@section('style')
    {!!Html::style('css/estiloRegister.css')!!}
    <style type="text/css">
        .btn-info{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-info:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
    </style>
@stop

@section('title')
    Registro de cliente
@stop

@section('content')
{!! Form::open(['url'=>'auth/register','method'=>'POST']) !!}

    {!! csrf_field() !!}

    <div class="row">
        <div class="col-sm-12">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="inputEmail3" value="{{ old('name') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Apellido</label>
                <div class="col-sm-10">
                  <input type="text" name="lastname" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Documento Identidad</label>
                <div class="col-sm-10">
                  <select class="form-control">
                    <option>DNI</option>
                    <option>Carnet de Extranjería</option>
                    <option>Pasaporte</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Número Documento</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Direccion</label>
                <div class="col-sm-10">
                  <input type="text" name="address" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Cumpleaños</label>
                <div class="col-sm-10">
                  <input type="date" name="birthday" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                  <input type="number" name="phone" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail3" value="{{ old('email') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputEmail3">
                </div>
              </div>
                <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Confirmar contraseña</label>
                <div class="col-sm-10">
                  <input type="password" name="passowrd_confirmation" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Aceptar</button>
                  <button type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>
              <br>
            </form>
        </div>
    </div>

{!!Form::close()!!}

@include('errors.list')

@stop

@section('javascript')

@stop