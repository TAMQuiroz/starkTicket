@extends('layout.promoter')

@section('style')
  <!--{!!Html::style('css/modern-business.css')!!} -->
  <!-- {!!Html::style('css/estilos.css')!!} -->
@stop

@section('title')
    Nuevo Evento
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label  class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!! Form::text('eventName','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Lugar</label>
                <div class="col-sm-10">
                  {!! Form::text('eventPlace','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-10">
                    {!! Form::select('category', ['Concierto','Teatro','Ferias y Circo','Otros'],null,['class' => 'form-control','required']) !!}
                </div>            
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sub categoría</label>
                <div class="col-sm-10">
                    {!! Form::select('subcategory', ['Rock','Cumbia','Tropical','Otros'],null,['class' => 'form-control','required']) !!}
                </div>            
              </div>  
              <div class="form-group">
                <label class="col-sm-2 control-label">Organizador</label>
                <div class="col-sm-10">
                    {!! Form::select('organizer', ['Pepitos Producciones','Rayo en la botella','Hermanos yaipen'],null,['class' => 'form-control','required']) !!}
                </div>            
              </div>  
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha inicio</label>
                <div class="col-sm-10">
                    {!! Form::date('dateIni','', array('class' => 'form-control','required')) !!}
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha fin</label>
                <div class="col-sm-10">
                    {!! Form::date('dateEnd','', array('class' => 'form-control','required')) !!}
                </div>   
              </div>                                                  
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen local</label>
                <div class="col-sm-10">
                  {!! Form::file('imagePlace', array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen evento</label>
                <div class="col-sm-10">
                  {!! Form::file('imageEvent', array('class' => 'form-control')) !!}
                </div>
              </div>         
              <br>

              <!-- ZONA -->
              <legend>Agregar zona:</legend>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                      {!! Form::text('zoneName','', array('class' => 'form-control','id' => 'input-zone')) !!}
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Capacidad</label>
                  <div class="col-sm-10">
                      {!! Form::text('zoneCapacity','', array('class' => 'form-control','id' => 'input-capacity')) !!}
                  </div>
              </div> 

              <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info" onclick="addZone()">Agregar</a>
                        <!--
                        <button  type="reset" class="btn btn-info">Cancelar</button>
                        -->
                    </div>
              </div>       

                <script>

                    function addZone(){
      
                        var zone = document.getElementById('input-zone').value;
                        var capacity = document.getElementById('input-capacity').value;

                        var tableRef = document.getElementById('table-zone').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                        var newCell4 = newRow.insertCell(3);

                        // Append values to cells
                        var newText  = document.createTextNode(zone);
                        var newText2 = document.createTextNode(""+capacity);
                        // buttons
                        var newEdit = document.createElement('button');
                        var newDelete = document.createElement('button');
                        newEdit.className = "btn"; 
                        newEdit.className += " btn-info glyphicon glyphicon-pencil"; 
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";

                        newCell.appendChild(newText);
                        newCell2.appendChild(newText2);                        
                        newCell3.appendChild(newEdit);
                        newCell4.appendChild(newDelete);
                
                    }

                </script>

                <table id="table-zone" class="table table-bordered table-striped ">
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>Zona vip</td>
                        <td>350</td>
                        <td>
                            <a class="btn btn-info"  title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"   title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>
                    <tr>
                        <td>Zona platea</td>
                        <td>300</td>
                        <td>
                            <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>            

                </table>
                <br>  

                <!-- CLIENTE -->

                <legend>Agregar tipo de cliente:</legend>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        {!! Form::text('typeClient','', array('class' => 'form-control','id' => 'input-client')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info" onclick="addClient()">Agregar</a>
                        <!--
                        <button  type="reset" class="btn btn-info">Cancelar</button>
                        -->
                    </div>
                </div>       

                <script>

                    function addClient(){
      
                        var cl = document.getElementById('input-client').value;

                        var tableRef = document.getElementById('table-client').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);

                        // Append values to cells
                        var newText  = document.createTextNode(cl);
                        
                        // buttons
                        var newEdit = document.createElement('button');
                        var newDelete = document.createElement('button');
                        newEdit.className = "btn"; 
                        newEdit.className += " btn-info glyphicon glyphicon-pencil"; 
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";

                        newCell.appendChild(newText);                        
                        newCell2.appendChild(newEdit);
                        newCell3.appendChild(newDelete);
                
                    }

                </script>

                <table id="table-client" class="table table-bordered table-striped ">
                    <tr>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>Niño</td>
                        <td>
                            <a class="btn btn-info"  title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"   title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>
                    <tr>
                        <td>Adulto</td>
                        <td>
                            <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>            

                </table>
                <br><br><br>


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a  class="btn btn-info" href="{{url('promoter/event/addFunction')}}"  >Siguiente</a>
                  <button  type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>
            </form>
          </div>

        </div>


@stop

@section('javascript')

  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/rangepicker.js')!!}
@stop