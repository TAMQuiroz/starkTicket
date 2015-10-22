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
                  {!!Form::input('text','organizerName', null ,['class'=>'form-control','maxlength' => 50,'required'])!!}
                </div>

              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  {!!Form::input('text','organizerLastName', null ,['class'=>'form-control','maxlength' => 50,'required'])!!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Razón social</label>
                <div class="col-sm-10">
                  {!!Form::input('text','businessName', null ,['class'=>'form-control','maxlength' => 50,'required'])!!}

                </div>
              </div>                
              <div class="form-group">
                <label class="col-sm-2 control-label">Ruc</label>
                <div class="col-sm-10">
                  {!!Form::input('number','ruc', null ,['class'=>'form-control','maxlength' => 11,'required', "onKeyDown" => "justNumbers()" ])!!}
                </div>
              </div>      
              <div class="form-group">
                <label class="col-sm-2 control-label">Número de cuenta</label>
                <div class="col-sm-10">
                  {!!Form::input('number','countNumber', null ,['class'=>'form-control','maxlength' => 20,'required',"onKeyDown" => "justNumbers()"])!!}
                 </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Teléfono</label>
                <div class="col-sm-10">
                  {!!Form::input('number','telephone', null ,['class'=>'form-control','maxlength' => 10,'required',"onKeyDown" => "justNumbers()"])!!}
 
                 </div>
              </div>                                                          
              <div class="form-group">
                <label class="col-sm-2 control-label">DNI</label>
                <div class="col-sm-10">
                  {!!Form::input('number','dni', null ,['class'=>'form-control','maxlength' => 8,'required',"onKeyDown" => "justNumbers()"])!!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                  {!!Form::input('text','email', null ,['class'=>'form-control','maxlength' => 50,'required'])!!}                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                  {!!Form::input('text','address', null ,['class'=>'form-control','maxlength' => 50,'required'])!!}                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                  {!! Form::file('image', ['class' => 'form-control', 'id' => 'inputImage','accept'=>'image/*']) !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <!--
                  <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#saveModal">Guardar</button>
                  -->
                  <a class="btn btn-info" type="button" href=""  title="Create"  data-toggle="modal" data-target="#saveModal">Guardar</a>
                  <button type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>

             <!-- MODAL -->
              <div class="modal fade"  id="saveModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">¿Estas seguro que desea agregar un organizador?</h4>
                    </div>
                    <div class="modal-body">
                      <h5 class="modal-title">Los cambios serán permanentes</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-info">Sí</button>
                        <!--
                        <a class="btn btn-info" href="" title="Create" >Sí</a>
                        -->
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
        
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