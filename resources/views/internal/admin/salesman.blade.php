@extends('layout.admin')

@section('style')
  <style type="text/css">
    .form-control{  
    }
  </style>
@stop

@section('title')
  Lista de vendedores
@stop

@section('content')
        <!-- Contenido-->
<!--Inicio de comentario
        <br>
        <div style="display: block;">
            <div style="display: inline-block;">
                <h5>Selecciona un departamento</h5>
                <div class="dropdown" style="display: inline-block;">
                    <button class="btn btn-info dropdown-toggle" style="display: inline-block;background-color:#5bc0de; border-color:#46b8da; color:white;" type="button" data-toggle="dropdown"> Lima
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Arequipa</a></li>
                        <li><a href="#">Ica</a></li>
                        <li><a href="#">Moquegua</a></li>
                        <li><a href="#">Tacna</a></li>
                    </ul>
                </div>
            </div>            
            
            <div style="display: inline-block; margin-left:50px;">
                <h5>Selecciona un distrito</h5>            
                <div  class="dropdown" style="display: inline-block;">
                    <button class="btn btn-info dropdown-toggle" style="background-color:#5bc0de; border-color:#46b8da; color:white;" type="button" data-toggle="dropdown"> Chorrillos
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Pueblo Libre</a></li>
                        <li><a href="#">Santa Rosa</a></li>
                        <li><a href="#">Ventanilla</a></li>
                        <li><a href="#">Breña</a></li>
                        <li><a href="#">San Miguel</a></li>
                        <li><a href="#">Jesús María</a></li>
                        <li><a href="#">Magdalena del Mar</a></li>
                        <li><a href="#">Lince</a></li>
                        <li><a href="#">San Isidro</a></li>
                    </ul>
                </div>
            </div>
           
        </div>
        <br>
        <br>

         <fieldset>
            <legend>Vendedores: </legend>
            <div style="-webkit-columns: 80px 2; display:inline-block;float:left">
              Código:  <input type="text" class="form-control" name="firstname" value="">  
              Nombre/Apellidos: <input type="text" class="form-control" name="lastname" value="">  
            </div>
             <br>   
            <a href="#" class="btn btn-info" >Buscar</a>
            <br><br><br> 
        </fieldset>

Fin de comentario--> 
        


        <!-- barra de busqueda -->
        {!! Form::text('eventPlace','', array('id' => 'search', 'class' => 'form-control', 'style' => 'width:50%;')) !!} 
        <br>
        <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
        <br><br>

        <table class="table table-bordered table-striped" id="example">
         <thead>
            <tr>
                <th>Apellidos y Nombres</th>
                <th>Documento Identidad</th>
                <th>Número de Documento</th>
                <th>Telefonos</th>
                <th>Editar</th>
                <th>Detalle</th>
                <th>Eliminar</th>
                <th>Asistencia</th>
            </tr>
         </thead>
         <tbody id="fbody">
            @foreach ($vendedores as $vendedor)
            <tr>
            
            
                <td>{{$vendedor->lastname}} {{$vendedor->name}}</td>
                <td>{{$vendedor->di}}</td>
                <td>
                   
                @if($vendedor->di_type == config('constants.national'))
                    DNI
                @else
                   Carne de Extranjeria
                @endif
          
                </td>

                <td>{{$vendedor->phone}}</td>
                
                <td>
                    <a class="btn btn-info" href="{{url('admin/salesman/'.$vendedor->id.'/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                    <a class="btn btn-info" href="detalles" title="Detalle" data-toggle="modal" data-target="#edit{{$vendedor->id}}"><i class="glyphicon glyphicon-plus"></i></a>                  
                    <div class="modal fade" id="edit{{$vendedor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del vendedor</h4>
                          </div>
                          
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            {{$vendedor->name.' '.$vendedor->lastname}}
                            <!-- <h4>Sexo</h4> -->
                            <h4>Documento Identidad</h4>
                            @if($vendedor->di_type == config('constants.national'))
                            DNI
                            @else
                            Carnet de Extranjeria
                            @endif
                            <h4>Número de Documento</h4>
                            {{$vendedor->di}}
                            <h4>Teléfono</h4>
                            {{$vendedor->phone}}
                            <h4>Direccion</h4>
                            {{$vendedor->address}}
                          </div>
                      
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </td> 
                <td>
                    <!--
                     <a class="btn btn-info" href="{{url('admin/salesman/'.$vendedor->id.'/delete')}}"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                    -->
                    <a class="btn btn-info" href=""  data-toggle="modal" data-target="#deleteModal{{$vendedor->id}}" title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                 </td>
                 <td>    
                 <a  class="btn btn-info" href="{{url('admin/'.$vendedor->id.'/attendance'  ) }}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a>
                </td>






                <!-- MODAL -->
                <div class="modal fade"  id="deleteModal{{$vendedor->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">¿Estas seguro que desea eliminar a un vendedor?</h4>
                      </div>
                      <div class="modal-body">
                        <h5 class="modal-title">Los cambios serán permanentes</h5>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <a class="btn btn-info" href="{{url('admin/salesman/'.$vendedor->id.'/delete')}}" title="Delete" >Sí</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </tr>
          @endforeach

          </tbody>



        </table>

{!!$vendedores->render()!!}



{!!Html::script('js/canvasjs.min.js')!!}
@stop

@section('javascript')
    <script>
        $('#btnBuscar').click(function(){

          var rows = $("#fbody").find("tr").hide();
          var name = document.getElementById("search");    
          var data = name.value;
          var search = data.toString().toLowerCase();

          if (search!=null || search != '') {
              //rows.show();
              $rows = rows;
              $rows.each(function(){
                  var $this = $(this);
                  $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show(); 
              });
          } else rows.show();

        });
    </script>
@stop