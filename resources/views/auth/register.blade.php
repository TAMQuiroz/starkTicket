<!-- resources/views/auth/register.blade.php -->

@extends('layoutExternal')

@section('style')
<style type="text/css">
  input[type="date"]
{
    display:block;
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    min-height: 1.2em;
}
  
</style>
@stop

@section('title')
    Registro de cliente
@stop

@section('content')
@include('errors.list')
{!! Form::open(['url'=>'auth/register','method'=>'POST','id'=>'form']) !!}

    <div class="row">
        <div class="col-sm-12">
            <form class="form-horizontal" method="post">
                <div class="form-group col-md-6">
                  <label for="input1" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                    {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'input1', 'required')) !!}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="input2" class="col-sm-2 control-label">Apellido</label>
                  <div class="col-sm-10">
                    {!! Form::text('lastname', null, array('class' => 'form-control', 'id' => 'input2', 'required')) !!}
                  </div>
                </div>
                <br>
                <div class="form-group col-md-6">
                  <label for="inputEmail3" class="col-sm-2 control-label">Doc. Id.</label>
                  <div class="col-sm-10">
                    {!! Form::select('di_type', [
                     '1' => 'DNI',
                     '2' => 'Carnet de Extranjeria',
                     '3' => 'Pasaporte'], null, ['class' => 'form-control', 'required']) !!}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="input3" class="col-sm-2 control-label">N° Doc.</label>
                  <div class="col-sm-10">
                    {!! Form::number('di', null, array('class' => 'form-control', 'id' => 'input3', 'required')) !!}
                  </div>
                </div>
                <br>
                <div class="form-group col-md-6">
                  <label for="input4" class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-10">
                    {!! Form::text('address', null, array('class' => 'form-control', 'id' => 'input4', 'required')) !!}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="input5" class="col-sm-2 control-label">Cumpleaños</label>
                  <div class="col-sm-10">
                    {!!Form::input('date','birthday', null ,['class'=>'form-control','id'=>'input5','required'])!!}
                  </div>
                </div>
                <br>
                <div class="form-group col-md-6">
                  <label for="input6" class="col-sm-2 control-label">Teléfono</label>
                  <div class="col-sm-10">
                    {!! Form::number('phone', null, array('class' => 'form-control', 'id' => 'input6', 'required','min'=> 1000000)) !!}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="input7" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    {!! Form::email('email', null, array('class' => 'form-control', 'id' => 'input7', 'required')) !!}
                  </div>
                </div>
                <br>
                <div class="form-group col-md-6">
                  <label for="input8" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    {!! Form::password('password', array('class' => 'form-control', 'id'=> 'input8', 'required')) !!}
                    <span class="help-block small">Ingrese mínimo 8 caracteres.</span>
                  </div>
                </div>
                  <div class="form-group col-md-6">
                  <label for="input9" class="col-sm-2 control-label">Confirmar</label>
                  <div class="col-sm-10">
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'id'=> 'input9', 'required')) !!}
                    <span class="help-block small">Vuelva a introducir su contraseña.</span>
                  </div>
                </div>
              
                 <H3>Seleccione su preferencia de eventos</H2>
                 <br>
                  <div class="row preferences-div">


                    <label  class="control-label">Rock</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('rock', 7, null, ['class' => 'checkbox']) !!}
                    </div>
                      
                    
                    <label  class="control-label">Electrónica</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('electronica', 8, null, ['class' => 'checkbox']) !!}                      
                    </div>

                    <label class="control-label">Reggae</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('reggae', 9, null, ['class' => 'checkbox']) !!}                      
                    </div> 

                    <label  class="control-label">Peña</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('pena', 17, null, ['class' => 'checkbox']) !!}                      
                    </div>          


                    <label  class="control-label">Opera</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('opera', 5, null, ['class' => 'checkbox']) !!}                      
                    </div>                 
                   
                      
                 </div>

                 <div class="row preferences-div">


                    <label  class="control-label">Ballet</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('ballet', 13, null, ['class' => 'checkbox']) !!}
                    </div>
        
                    <label  class="control-label">Comedia</label>
                    <div class="preferences-chbox">
                     {!! Form::checkbox('deporte', 11 , null, ['class' => 'checkbox']) !!}
                    </div>

                    <label  class="control-label">Drama</label>
                    <div class="preferences-chbox">
                       {!! Form::checkbox('drama', 10, null, ['class' => 'checkbox']) !!}
                    </div>

                    <label  class="control-label">Adultos</label>
                    <div class="col-sm-1 preferences-chbox">
                       {!! Form::checkbox('adultos', 14, null, ['class' => 'checkbox']) !!}
                    </div>

         
                  

                 </div>


                 <div class="row preferences-div">


                    <label  class="control-label">Sociales</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('sociales', 15, null, ['class' => 'checkbox']) !!}
                    </div>
        
                    <label  class="control-label">Fiestas</label>
                    <div class="preferences-chbox">
                     {!! Form::checkbox('fiestas', 16 , null, ['class' => 'checkbox']) !!}
                    </div>

                    <label  class="control-label">Tours</label>
                    <div class="preferences-chbox">
                       {!! Form::checkbox('tours', 18, null, ['class' => 'checkbox']) !!}
                    </div>

                    <label  class="control-label">Ferias</label>
                    <div class="col-sm-1 preferences-chbox">
                       {!! Form::checkbox('ferias', 19, null, ['class' => 'checkbox']) !!}
                    </div>


                 </div>


                   <div class="row preferences-div">


                    <label  class="control-label">Futbol</label>
                    <div class="preferences-chbox">
                      {!! Form::checkbox('futbol', 20, null, ['class' => 'checkbox']) !!}
                    </div>
        
                    <label  class="control-label">Automovilismo</label>
                    <div class="preferences-chbox">
                     {!! Form::checkbox('automovilismo', 21 , null, ['class' => 'checkbox']) !!}
                    </div>

                    <label  class="control-label">Maratón</label>
                    <div class="preferences-chbox">
                       {!! Form::checkbox('maraton', 22, null, ['class' => 'checkbox']) !!}
                    </div>

                   <label  class="control-label">Musical</label>
                    <div class="col-sm-1 preferences-chbox">
                       {!! Form::checkbox('musical', 12, null, ['class' => 'checkbox']) !!}
                    </div>

                 </div>


                <br>
                <br>
              <div class="form-group col-md-12">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-info">Aceptar</button>
                  <button type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>
              <br>
              <br>
              <br>
            </form>
        </div>
    </div>
    
    <style type="text/css">
      .preferences-div label{
          width: 125px;
      }
      .preferences-div label:first-child{
          margin-left: 30px;
      }
      .preferences-chbox{
          margin-right: 40px; 
      }

    </style>

{!!Form::close()!!}



@stop

@section('javascript')

@stop