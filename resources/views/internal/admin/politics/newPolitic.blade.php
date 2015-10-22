@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva Politica
@stop

@section('content')
        <div class="row">
          <div class="col-sm-8">
           {!!Form::open(array('url' => 'admin/politics/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
  
       
              <div class="form-group">

                <label for="string1" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <!--
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" required>

                  -->




                    <!--
                  estos son los datos que voy a redireccionar 
                  
                  -->
                
                  {!!Form::input('text','name', null ,['class'=>'form-control','id'=>'string1','required'])!!}

                </div>
              </div>
       


     <div class="form-group">
                <label for="text" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-10">
                  <!--
                  <textarea class="form-control" rows="10" id="description">
                  -->
                  

                  {!!Form::input('text','description', null ,['class'=>'form-control','id'=>'text','required'])!!}

              
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