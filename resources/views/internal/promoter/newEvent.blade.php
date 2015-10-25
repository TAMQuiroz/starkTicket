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
            {!!Form::open(array('route' => 'events.store','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label  class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!! Form::text('name','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Lugar</label>
                <div class="col-sm-10">
                  {!! Form::select('local_id', $locals_list->toArray(), null, ['class' => 'form-control','required']) !!}
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
                    {!! Form::select('category_id', $categories_list->toArray(),null,['class' => 'form-control','required']) !!}
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
                    {!! Form::select('organizer_id', $organizers_list->toArray(),null,['class' => 'form-control','required']) !!}
                </div>            
              </div> 
              <div class="form-group">
                <label  class="col-sm-2 control-label">Duración Aproximada</label>
                <div class="col-sm-10">
                  {!! Form::text('time_length','', array('class' => 'form-control','required')) !!}
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de publicación del evento</label>
                <div class="col-sm-10">
                    {!! Form::date('publication_date',\Carbon\Carbon::now(), array('class' => 'form-control','required')) !!}
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de inicio de ventas</label>
                <div class="col-sm-10">
                    {!! Form::date('selling_date',\Carbon\Carbon::now(), array('class' => 'form-control','required')) !!}
                </div>   
              </div>                                                  
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen evento</label>
                <div class="col-sm-10">
                  {!! Form::file('image', array('class' => 'form-control')) !!}
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
                  <label  class="col-sm-2 control-label">Precio</label>
                  <div class="col-sm-10">
                      {!! Form::text('zonePrice','', array('class' => 'form-control','id' => 'input-price')) !!}
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
                        var price = document.getElementById('input-price').value;

                        var tableRef = document.getElementById('table-zone').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                        var newCell5 = newRow.insertCell(3);

                        // Append values to cells
                        var newText  = document.createTextNode(zone);
                        var x = document.createElement("INPUT");
                        x.setAttribute("type", "text");
                        x.setAttribute("value", zone);
                        x.setAttribute("name", "zone_names[]");
                        x.style.border = 'none';
                        x.style.background = 'transparent';
                        x.required = true;
                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "text");
                        newText2.setAttribute("value", capacity);
                        newText2.setAttribute("name", "zone_capacity[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.required = true;
                        var textPrice = document.createElement("INPUT");
                        textPrice.setAttribute("type", "text");
                        textPrice.setAttribute("value", price);
                        textPrice.setAttribute("name", "price[]");
                        textPrice.style.border = 'none';
                        textPrice.style.background = 'transparent';
                        textPrice.required = true;
                        // buttons
                        
                        var newDelete = document.createElement('button'); 
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";

                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);                        
                        newCell3.appendChild(textPrice);                        
                        newCell5.appendChild(newDelete);

                        document.getElementById('input-zone').value = '';
                        document.getElementById('input-capacity').value = '';
                        document.getElementById('input-price').value = '';
                
                    }

                </script>

                <table id="table-zone" class="table table-bordered table-striped ">
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </tr>  
                </table>
                <br>  

              <!--
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha inicio</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha fin</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hora inicio</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control">
                    </div>
                </div>      
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hora fin</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control">
                    </div> 
                </div> 
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Repetición</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sel1">
                            <option>Única vez</option>
                            <option>Diario(Lun-Vier)</option>
                            <option>Diario(Lun-Dom)</option>
                            <option>Semanal</option>
                            <option>Mensual</option>
                        </select>
                    </div>            
                </div>  
                -->


                <!--
                <legend>Agregar zona:</legend>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-zone" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Capacidad</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-capacity" placeholder="">
                    </div>
                </div>  
                -->
                
                
                              <!-- agregar funciones -->
              <legend>Agregar función:</legend>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-10">
                      {!! Form::date('input_start_date',\Carbon\Carbon::now(), array('class' => 'form-control', 'id' =>'input-function-date')) !!}
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Hora de inicio</label>
                  <div class="col-sm-10">
                      {!! Form::time('input_start_time',null, array('class' => 'form-control', 'id' => 'input-function-time')) !!}
                  </div>
              </div> 

              <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info" onclick="addFunction()">Agregar</a>
                        <!--
                        <button  type="reset" class="btn btn-info">Cancelar</button>
                        -->
                    </div>
              </div>       

                <script>

                    function addFunction(){
      
                        var start_date = document.getElementById('input-function-date').value;
                        var start_time = document.getElementById('input-function-time').value;

                        var tableRef = document.getElementById('functions-table').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell4 = newRow.insertCell(2);

                        // Append values to cells
                        var x = document.createElement("INPUT");
                        x.setAttribute("type", "date");
                        x.setAttribute("value", start_date);
                        x.setAttribute("name", "start_date[]");
                        x.style.border = 'none';
                        x.style.background = 'transparent';
                        x.required = true;
                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "time");
                        newText2.setAttribute("value", start_time);
                        newText2.setAttribute("name", "start_time[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.required = true;
                        // buttons
                        var newDelete = document.createElement('button');
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";

                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);                                             
                        newCell4.appendChild(newDelete);

                        
                        document.getElementById('input-function-date')[0].value = '';
                
                    }

                </script>

                <table id="functions-table" class="table table-bordered table-striped ">
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Eliminar</th>
                    </tr>  
                </table>
                <br>
                {!! Form::hidden ('yesterday', ''.\Carbon\Carbon::now()->subDay()) !!}
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Guardar Evento</button>
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