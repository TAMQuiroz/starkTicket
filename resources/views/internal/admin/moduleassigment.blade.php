@extends('layout.admin')

@section('style')
  {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Asignación de Puntos de Venta
@stop

@section('content')
  <!-- Contenido-->
  <!--
            <div class="row">
                <div class="col-sm-8">
                  {!!Form::open(array('url' => 'admin/modules/assigment','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
                   <div class="form-group"> 
                      
                         <label for="inputEmail3" class="col-sm-4 control-label">Nuevo tipo de Cambio: Compra</label>
                         
                          <div class="col-sm-6">
                             {!!Form::input('text','buyingRate', null ,['class'=>'form-control','id'=>'buyingRate','required','min' >0])!!}
                          </div>
                           <div class="col-sm-2"> </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nuevo tipo de Cambio: Venta</label>

                    <div class="col-sm-6">
                        {!!Form::input('text','sellingRate', null ,['class'=>'form-control','id'=>'sellingRate','required','min' >0])!!}      
                    </div>
                    <div class="col-sm-2"> </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-2"><br>
                      <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Modificar Tipo Cambio</a>
                        
                    </div>
                  </div>
                  <div class="modal fade"  id="submitModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">¿Estas seguro que Modificar el Tipo de Cambio </h4>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <button id="yes" type="submit" class="btn btn-info">Si</button>
                      </div>
                    </div>
                  </div>
                </div>
                  {!!Form::close()!!}
                </div>
      
            </div>
            <hr>
        -->    


        <div class="row">
          <div class="col-sm-8">
            {!!Form::open(array('url' => 'admin/modules/assigment','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label class="col-sm-2 control-label">Punto de Venta</label>
                <div class="col-sm-10">
                  {!! Form::select('module_id', $modules_list->toArray(),null,['class' => 'form-control','required','id'=>'module_id'])  !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Vendedor</label>
                <div class="col-sm-6">
                  {!! Form::select('salesman_id', $salesmans_list->toArray(),null,['class' => 'form-control','required','id'=>'salesman_id']) !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
              
                  <a class="btn btn-info" type="button" href=""  title="Create"  data-toggle="modal" data-target="#saveModalUser">Guardar</a>
                  
                 
                </div>
              </div>


              <!-- MODAL -->
              <div class="modal fade"  id="saveModalUser">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">¿Estas seguro que desea agregar esta asignación?</h4>
                    </div>
                    <div class="modal-body">
                      <h5 class="modal-title">Los cambios serán permanentes</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>                        
                        <button id = "botonModal" type="submit" class="btn btn-info">Sí</button>
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


        <h3>Modulos ya relacionados</h3>
          <table class="table table-bordered table-striped">
                          
              <tr>
                  <th>Código del módulo</th>
                  <th>Nombre del módulo</th>
                  <th>Código del vendedor</th>
                  <th>Nombre del vendedor</th>
                  <th>Fecha de Asignación</th>
                  <th>Desasociar</th>
              </tr>
                 
              @foreach($assigmentmodules as $assigmentmodule)
                <tr>
                    <td>{{$assigmentmodule->idModule}}</td>
                    <td>{{$assigmentmodule->nameModule}}</td>
                        
                    <td>{{$assigmentmodule->idSalesman}}</td>
                    <td>{{$assigmentmodule->nameSalesman}}</td>
                    <td>{{$assigmentmodule->dateAssigment}}</td>
                    <td>
                      <a class="btn btn-info" href=""  title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$assigmentmodule->idAssigment}}" ><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
                <div class="modal fade"  id="deleteModal{{$assigmentmodule->idAssigment}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">¿Estas seguro que desea desasociar el modulo de venta con el vendedor?</h4>
                      </div>
                      <div class="modal-body">
                        <h5 class="modal-title">Los cambios serán permanentes</h5>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <a class="btn btn-info" href="{{url('admin/modules/assigment/'.$assigmentmodule->idAssigment.'/delete')}}" title="Delete" >Sí</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              @endforeach 
          </table>
              

@stop

@section('javascript')
  <script type="text/javascript">
    var config = {
        routes: [
            { client: "{{ URL::route('ajax.getClient') }}" },
        ]
    };
    $('#yes').click(function(){
        $('#submitModal').modal('hide');  
    });
    </script>

@stop