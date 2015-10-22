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
                <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                   {!!Form::input('text','name', null ,['class'=>'form-control','id'=>'inputName','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputLast" class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  {!!Form::input('text','lastname', null ,['class'=>'form-control','id'=>'inputLast','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputPass" class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-10">
                    {!!Form::input('password','password', null ,['class'=>'form-control','id'=>'inputPass','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputType" class="col-sm-2 control-label">Tipo de documento</label>
                <div class="col-sm-10">
                  {!! Form::select('di_type', [
                     '1' => 'DNI',
                     '2' => 'Carnet de Extranjeria'], null, ['class'=>'form-control']
                  ) !!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputDi" class="col-sm-2 control-label">Documento de Identidad</label>
                <div class="col-sm-10">
                  {!!Form::input('number','di', null ,['class'=>'form-control','id'=>'inputDi','required','min'=>0,"onKeyDown" => "justNumbers()"])!!} 
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress" class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  {!!Form::input('text','address', null ,['class'=>'form-control','id'=>'inputAddress','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputPhone" class="col-sm-2 control-label">Teléfono(s)</label>
                <div class="col-sm-10">
                  {!!Form::input('number','phone', null ,['class'=>'form-control','id'=>'inputPhone','required','min'=>0,"onKeyDown" => "justNumbers()"])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">E-mail(s)</label>
                <div class="col-sm-10">
                    {!!Form::input('text','email', null ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputBirth" class="col-sm-2 control-label">Nacimiento</label>
                <div class="col-sm-10">
                    {!!Form::input('date','birthday', null ,['class'=>'form-control','id'=>'inputBirth','required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label for="inputRole" class="col-sm-2 control-label">Cargo</label>
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
              </div>x
           {!!Form::close()!!}
          </div>
        </div>
@stop

@section('javascript')

  <script>
    function justNumbers(){
      var e = event || window.event;  
      var key = e.keyCode || e.which; 

      if (key < 48 || key > 57) { 
        if(key == 8 || key == 9 || key == 46){} //allow backspace and delete                                   
        else{
           if (e.preventDefault) e.preventDefault(); 
           e.returnValue = false; 
        }
      }
    }
  </script>

@stop