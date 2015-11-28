@extends('layout.promoter')

@section('style')
  <!--{!!Html::style('css/modern-business.css')!!} -->
  <!-- {!!Html::style('css/estilos.css')!!} -->
  {!!Html::style('css/jquery.seat-charts.css')!!}
  {!!Html::style('css/seats.css')!!}
  <style>
      div.seatCharts-seat.selected {
        background-color: red;
      }
  </style>
@stop

@section('title')
    Editar Evento
@stop

@section('content')
<script type="text/javascript">

  window.onload = function(){
    var today = new Date();
    var month = today.getMonth() +1;
    var todayDate = ''+today.getFullYear()+'-'+month+'-'+today.getDate();
    // document.getElementsByName('selling_date')[0].min = todayDate;
    // document.getElementById('input-function-date').min = todayDate;
    // var e = document.getElementsByName('local_id')[0];
    // var index= e.options[e.selectedIndex].value;
    // document.getElementById('capacity-display').value = document.getElementsByName('capacity_'+index)[0].value;
    document.getElementById("input-capacity").max=document.getElementById("capacity-display").value;
  }

  function changeCapacity(){
    var e = document.getElementsByName('local_id')[0];
    var index= e.options[e.selectedIndex].value;
    document.getElementById('capacity-display').value = document.getElementsByName('capacity_'+index)[0].value;
    document.getElementById("input-capacity").max=document.getElementById("capacity-display").value;
  }

  function incrementSellingDate(){
    var publication_date = document.getElementsByName('publication_date')[0].value;
    document.getElementsByName('publication_date')[0].stepUp();
    var publication_date_1 = document.getElementsByName('publication_date')[0].value;
    document.getElementsByName('publication_date')[0].stepDown();
    var today = new Date();
    var publicDate = new Date(document.getElementsByName('publication_date')[0].value);
    var timeToday = today.getTime();
    var timePublic = publicDate.getTime();
    var month = today.getMonth() +1;
    // if(timeToday > timePublic)
    //   document.getElementsByName('selling_date')[0].min = ''+today.getFullYear()+'-'+month+'-'+today.getDate();
    // else
    //   document.getElementsByName('selling_date')[0].min = publication_date_1;
  }

  function incrementPresentationDate(){
    //document.getElementById('input-function-date').min = document.getElementsByName('selling_date')[0].value;
  }
</script>

        <!-- Contenido-->
        @foreach ($capacity_list as $capacity)
          {!! Form::hidden ('capacity_'.$capacity->id, $capacity->capacity) !!}
          {!! Form::hidden ('row_'.$capacity->id, $capacity->rows,  array('id' =>'row_'.$capacity->id)) !!}
          {!! Form::hidden ('column_'.$capacity->id, $capacity->columns, array('id' =>'column_'.$capacity->id)) !!}
          {!! Form::hidden('invisible', 'secret', array('id' => 'invisible_id')) !!}
        @endforeach



        <div class="row">
          <div class="col-sm-8">
            {!!Form::open(array('url' => 'promoter/event/'.$event->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label  class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!! Form::text('name',$event->name, array('class' => 'form-control','required','maxlength' => 30)) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Lugar</label>
                <div class="col-sm-10">
                  {!! Form::select('local_id', $locals_list->toArray(), $event->local_id, ['class' => 'form-control','required', 'onclick' => 'changeCapacity()']) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  {!! Form::textarea('description', $event->description, ['class' => 'form-control','style' => 'resize:none','rows' => '3','maxlength' => 100]) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-10">

                    {!! Form::select('parent_category_id', $categories_list->toArray(),null,['class' => 'form-control','required','id'=>'category_id']) !!}
                </div> 

              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sub categoría</label>
                <div class="col-sm-10">
                    {!! Form::select('category_id',$categories_list->toArray(),$event->category_id,['class' => 'form-control','required','id'=>'subcategory_id','onLoad'=>'getSubs()']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Organizador</label>
                <div class="col-sm-10">
                    {!! Form::select('organizer_id', $organizers_list->toArray(),$event->organizer_id,['class' => 'form-control','required']) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Comisión(%)</label>
                <div class="col-sm-10">
                  {!! Form::number('percentage_comission',$event->percentage_comission, array('class' => 'form-control','min' => '0','required','max' => '100')) !!}
                </div>
              </div>              
              <div class="form-group">
                <label  class="col-sm-2 control-label">Duración Aproximada</label>
                <div class="col-sm-10">
                  {!! Form::number('time_length',$event->time_length, array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de publicación del evento</label>
                <div class="col-sm-10">
                    {!! Form::date('publication_date',date('Y-m-d',$event->publication_date), array('class' => 'form-control','required', 'oninput' => 'incrementSellingDate()')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de inicio de ventas</label>
                <div class="col-sm-10">
                    {!! Form::date('selling_date',date('Y-m-d',$event->selling_date), array('class' => 'form-control','required', 'oninput' => 'incrementPresentationDate()')) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen evento</label>
                <div class="col-sm-10">
                  {!! Form::file('image', array('class' => 'form-control')) !!}{{$event->image}}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen distribucion evento</label>
                <div class="col-sm-10">
                  {!! Form::file('image', array('class' => 'form-control')) !!}{{$event->distribution_image}}
                </div>
              </div>              
              <br>

              <!-- ZONA -->
              <legend>Agregar zona:</legend>

              <div class="col-md-6">
                  <div class="form-group">
                      <label  class="col-md-4 control-label">Nombre</label>
                      <div class="col-md-8">
                          {!! Form::text('zoneName1','', array('class' => 'form-control','id' => 'input-zone','maxlength' => 20)) !!}
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-md-4 control-label" id="label_capacity">Capacidad</label>
                      <div class="col-md-8">
                          {!! Form::number('zoneCapacity1','', array('class' => 'form-control','id' => 'input-capacity','min' => '1')) !!}
                      </div>
                  </div>
                  <div class="form-group" id="label_col">
                      <label  class="col-md-4 control-label" >Columnas</label>
                      <div class="col-md-8">
                          {!! Form::number('zone_columns1','', array('class' => 'form-control','id' => 'input-column','min' => '1','disabled')) !!}
                      </div>
                  </div>
                  <div class="form-group" id="label_fil">
                      <label  class="col-md-4 control-label" >Filas</label>
                      <div class="col-md-8">
                          {!! Form::number('zone_rows1','', array('class' => 'form-control','id' => 'input-row','min' => '1','disabled')) !!}
                      </div>
                  </div>
                  <div class="form-group" id="label_fini">
                      <label  class="col-md-4 control-label" >Columna inicial</label>
                      <div class="col-md-8">
                          {!! Form::number('start_column1','', array('class' => 'form-control','id' => 'input-colIni','min' => '1','disabled')) !!}
                      </div>
                  </div>     
                  <div class="form-group" id="label_cini">
                      <label  class="col-md-4 control-label" >Fila inicial</label>
                      <div class="col-md-8">
                          {!! Form::number('start_row1','', array('class' => 'form-control','id' => 'input-rowIni','min' => '1','disabled')) !!}
                      </div>
                  </div>                                                     
                  <div class="form-group">
                      <label  class="col-md-4 control-label">Precio</label>
                      <div class="col-md-8">
                          {!! Form::number('zonePrice1','', array('class' => 'form-control','id' => 'input-price','maxlength' => 50,'min' => '0')) !!}
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-md-4 control-label">Capacidad disponible</label>
                      <div class="col-md-8">
                          <input type="text" id="capacity-display" class="form-control" disabled>
                      </div>
                  </div>        
                  <div class="form-group">
                        <div class="col-sm-offset-10 col-sm-6">
                            <a class="btn btn-info" onclick="addZone()">Agregar</a>
                        </div>
                  </div>   
                </div>   
                  <div  id="dist" class="col-md-6">
                    <label  id="labelDist">Distribución evento</label>
                  </div>
                  
                <script>

                    function addZone(){


                        var new_capacity = document.getElementById('capacity-display').value;

                        var zone = document.getElementById('input-zone').value;
                        
                        var price = document.getElementById('input-price').value;

                        var capacity = document.getElementById('input-capacity').value;

                        if(price<0) return;
                        if(capacity<0) return;
                        if( new_capacity-capacity<0) return;
                        if(zone.length==0 || price.length==0) return;
                        if( document.getElementById('input-capacity').disabled==true){
                          var column= "";
                          var row= "";
                          var rowini= "";
                          var colini= "";
                          column= document.getElementById('input-column').value;
                          row= document.getElementById('input-row').value ;
                          rowini= document.getElementById('input-rowIni').value;
                          colini= document.getElementById('input-colIni').value;
                          if(new_capacity-row*column<0) return;
                          if(column.length==0 || row.length==0 || rowini.length==0 || colini.length==0) return;

                        }
                        else if(capacity.length==0) return;

                        var tableRef = document.getElementById('table-zone').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                       
                        var newCell6 = newRow.insertCell(3);
                        var newCell7 = newRow.insertCell(4);
                        var newCell8 = newRow.insertCell(5);
                        var newCell9 = newRow.insertCell(6);
                        
                        var newCell5 = newRow.insertCell(7);



                        var y1 = document.createElement("INPUT");
                        //y1.setAttribute("type", "hidden");
                        y1.setAttribute("value", column);
                        y1.setAttribute("name", "zone_columns[]");
                        y1.style.border = 'none';
                        y1.style.background = 'transparent';
                        y1.style.width='40px';
                        y1.required = false;
                        y1.setAttribute("readonly","readonly");

                        var y2 = document.createElement("INPUT");
                        //y2.setAttribute("type", "hidden");
                        y2.setAttribute("value", row);
                        y2.setAttribute("name", "zone_rows[]");
                        y2.style.border = 'none';
                        y2.style.background = 'transparent';
                        y2.style.width='40px';
                        y2.required = false;
                        y2.setAttribute("readonly","readonly");

                        var y3 = document.createElement("INPUT");
                        //y3.setAttribute("type", "hidden");
                        y3.setAttribute("value", colini);
                        y3.setAttribute("name", "start_column[]");
                        y3.style.border = 'none';
                        y3.style.background = 'transparent';
                        y3.style.width='40px';
                        y3.required = false;
                        y3.setAttribute("readonly","readonly");

                        var y4 = document.createElement("INPUT");
                        //y4.setAttribute("type", "hidden");
                        y4.setAttribute("value", rowini);
                        y4.setAttribute("name", "start_row[]");
                        y4.style.border = 'none';
                        y4.style.background = 'transparent';
                        y4.style.width='40px';
                        y4.required = false;   
                        y4.setAttribute("readonly","readonly");


                        if( document.getElementById('input-capacity').disabled==true){ 
                        //  Add values when is a numerated local but dont show it
                            y1.required=true;
                            y2.required=true;
                            y3.required=true;
                            y4.required=true;
                            capacity=row*column;        
                           newCell6.appendChild(y1);
                          newCell7.appendChild(y2);
                          newCell8.appendChild(y3);
                          newCell9.appendChild(y4);       
                        }





                        // Append values to cells
                        var newText  = document.createTextNode(zone);
                        var x = document.createElement("INPUT");
                        x.setAttribute("type", "text");
                        x.setAttribute("value", zone);
                        x.setAttribute("name", "zone_names[]");
                        x.style.border = 'none';
                        x.style.background = 'transparent';
                        x.required = true;
                        x.setAttribute("readonly","readonly");

                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "text");
                        newText2.setAttribute("value", capacity);
                        newText2.setAttribute("name", "zone_capacity[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.style.width='40px';
                        newText2.required = true;
                        newText2.setAttribute("readonly","readonly");

                        var textPrice = document.createElement("INPUT");
                        textPrice.setAttribute("type", "text");
                        textPrice.setAttribute("value", price);
                        textPrice.setAttribute("name", "price[]");
                        textPrice.style.border = 'none';
                        textPrice.style.background = 'transparent';
                        textPrice.style.width='80px';
                        textPrice.required = true;
                        textPrice.setAttribute("readonly","readonly");
                        // buttons

                        var newDelete = document.createElement('button');
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";
                        if (newDelete.addEventListener) {  // all browsers except IE before version 9
                          newDelete.addEventListener("click", function(){deleteZone(newDelete);}, false);
                        } else {
                          if (newDelete.attachEvent) {   // IE before version 9
                            newDelete.attachEvent("click", function(){deleteZone(newDelete);});
                          }
                        }

                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(textPrice);
                        newCell5.appendChild(newDelete);
                        


                        document.getElementById('input-zone').value = '';
                        document.getElementById('input-capacity').value = '';
                        document.getElementById('input-price').value = '';
                        // document.getElementById('input-column').value = '';
                        // document.getElementById('input-row').value = '';
                        // document.getElementById('input-colIni').value = '';
                        // document.getElementById('input-rowIni').value = '';

                        if( document.getElementById('input-capacity').disabled==true){
                          $('.reserved').removeClass('reserved').addClass('unavailable');
                          $('.selected').removeClass('selected').addClass('unavailable');
                          document.getElementById('input-column').value = '';
                          document.getElementById('input-row').value = '';
                          document.getElementById('input-colIni').value = '';
                          document.getElementById('input-rowIni').value = '';
                        }

                        new_capacity = new_capacity - capacity;
                        document.getElementById('capacity-display').value = new_capacity;
                        document.getElementById("input-capacity").max=new_capacity;

                    }

                    function deleteZone(btn){
                        var row=btn.parentNode.parentNode.rowIndex;
                        var row2 = row-1;
                        if( document.getElementById('input-capacity').disabled==true){
                              var col_ini = parseInt($('[name="start_column[]"]')[row2].value);
                              var fil_ini = parseInt($('[name="start_row[]"]')[row2].value);
                              var cant_fil = parseInt($('[name="zone_rows[]"]')[row2].value);
                              var cant_col = parseInt($('[name="zone_columns[]"]')[row2].value);
                              for(i = col_ini; i<col_ini+cant_col;i++){
                                for(j=fil_ini; j<fil_ini + cant_fil; j++){
                                  var id = ''+j+'_'+i;
                                  $('#'+id).removeClass("unavailable");
                                  $('#'+id).addClass('available');
                                }
                              }
                        }
                        var act_val = parseInt(document.getElementById('capacity-display').value);
                        act_val += parseInt(document.getElementsByName('zone_capacity[]')[row2].value);
                        document.getElementById('capacity-display').value = act_val;
                        document.getElementById("input-capacity").max=act_val;
                        document.getElementById('table-zone') .deleteRow(row);
                
                    }    
                </script>

                <table id="table-zone" class="table table-bordered table-striped ">
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Columnas</th>
                        <th>Filas</th>
                        <th>Columna inicial</th>
                        <th>Fila inicial</th>
                        <th>Eliminar</th>
                    </tr>

                    @foreach($event->zones as $zone)
                    <tr>
                        <td><input type="text" style = "border:none" name="zone_names[]" value="{{$zone->name}}" readonly></td>
                        <td><input type="number" style = "width:40px;border:none" name="zone_capacity[]" value="{{$zone->capacity}}" readonly></td>
                        <td><input type="number" name="price[]" style = "width:80px;border:none" value="{{$zone->price}}" readonly></td>
                        <td><input type="number" class="hating" name="zone_columns[]" style = "width:40px;border:none" value="{{$zone->columns}}" readonly></td>
                        <td><input type="number" class="hating" name="zone_rows[]" style = "width:40px;border:none" value="{{$zone->rows}}" readonly></td>
                        <td><input type="number" class="hating" name="start_column[]" style = "width:40px;border:none" value="{{$zone->start_column}}" readonly></td>
                        <td><input type="number" class="hating" name="start_row[]" style = "width:40px;border:none" value="{{$zone->start_row}}" readonly></td>
                        <td>
                          <a class="btn btn-info"  title="Eliminar"   onclick="deleteZone(this)" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>     

                    @endforeach                    

                </table>
                <br>

                              <!-- agregar funciones -->
              <legend>Agregar función:</legend>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-10">
                      {!! Form::date('input_start_date',\Carbon\Carbon::now()->addDay(2), array('class' => 'form-control', 'id' =>'input-function-date')) !!}
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

                        if(start_time.length==0 || start_time.length==0) return;
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
                        if (newDelete.addEventListener) {  // all browsers except IE before version 9
                          newDelete.addEventListener("click", function(){deleteFunction(newDelete);}, false);
                        } else {
                          if (newDelete.attachEvent) {   // IE before version 9
                            newDelete.attachEvent("click", function(){deleteFunction(newDelete);});
                          }
                        }
                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell4.appendChild(newDelete);


                        //document.getElementById('input-function-date')[0].value = '';

                    }
                    function deleteFunction(btn){
                        var row=btn.parentNode.parentNode.rowIndex;
                        document.getElementById('functions-table') .deleteRow(row);
                
                    }  
                </script>

                <table id="functions-table" class="table table-bordered table-striped " disabled>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Eliminar</th>
                    </tr>
                    @foreach($event->presentations as $function)
                    <tr>
                        <td><input name="start_date[]" type="date" value="{{date('Y-m-d',$function->starts_at)}}" style = "border:none"></td>
                        <td><input type="time" name="start_time[]" value='{{date("H:i",$function->starts_at)}}' style = "border:none"></td>
                        <td>
                          <a class="btn btn-info"   title="Eliminar"    onclick="deleteFunction(this)"><i class="glyphicon glyphicon-remove"></i></a>
                          <!-- <a class="btn btn-info" href=""  title="Eliminar"    data-toggle="modal" data-target="#deleteModal{{$function->id}}"><i class="glyphicon glyphicon-remove"></i></a> -->
                        </td>
                    </tr>     

                     <!-- MODAL -->
                      <div class="modal fade"  id="deleteModal{{$function->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">¿Estas seguro que desea eliminar esta función ?</h4>
                            </div>
                            <div class="modal-body">
                              <h5 class="modal-title">Los cambios serán permanentes</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                <a class="btn btn-info"  title="Delete" >Sí</a>
                            </div>
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->

                    @endforeach
                    
                </table>
                <br>
                {!! Form::hidden ('yesterday', ''.\Carbon\Carbon::now()->subDay()) !!}
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar Cambios</a>
                  <a href="{{url('promoter/event/record')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
                </div>
              </div>

              <!-- MODAL -->
              <div class="modal fade"  id="submitModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">¿Estas seguro que desea actualizar el evento?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                        <button id="yes" type="submit" class="btn btn-info">Si</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </form>
          </div>

        </div>



@stop

@section('javascript')
  {!!Html::script('js/jquery.seat-charts.js')!!}
  <script>
    $(document).ready(function() {

       holi();

       function holi(){
        var e = document.getElementsByName('local_id')[0];
        var index= e.options[e.selectedIndex].value;
        document.getElementById('capacity-display').value = document.getElementsByName('capacity_'+index)[0].value;        
        var zones=document.getElementsByName("zone_names[]");
        var numZones=zones.length;
        console.log("numero de zonas " + numZones);
        var capacity=document.getElementsByName("zone_capacity[]");

      
       for(var i=0;i<numZones;i++){
         document.getElementById('capacity-display').value=document.getElementById('capacity-display').value-capacity[i].value;
       }  

       var tam= $('[id=invisible_id]').size();
       console.log("tamano "+tam);
       for(var i=1;i<=tam;i++)
       $('#dist').append("<div id=seat-map-"+i+" class=seatCharts-container  tabindex =0> </div>");

        var e = $('[name=local_id]')[0];

        var index= e.options[e.selectedIndex].value;
        console.log(index);
        var algo = $('#row_' + index).val();
        //console.log("algo "+algo);
        var table = document.getElementById("table-zone");


        if(algo !== undefined && algo >=1){

          //si el local tiene asientos y filas numeradas Do this 
          //console.log("index "+index);
          var rows = $('#row_'+index).val();
          var columns = $('#column_'+index).val();

          // setear maximo filas maxima col
          document.getElementById("input-column").max=columns;
          document.getElementById("input-row").max=rows;
          document.getElementById("input-colIni").max=columns;
          document.getElementById("input-rowIni").max=rows;

          console.log("columnas "+columns);

          console.log("filas "+rows);

          var arreglo = new Array();

          for(i=0; i<rows;i++){
            var texto = 'a';
            for(j=1; j<columns; j++){
              texto += 'a';
            }
            //console.log(texto);
            arreglo.push(texto);
          }
          console.log(arreglo);
          //console.log(arreglo);
          var seatid="seat-map-"+index;
          console.log(seatid);

          var tam= $('[id=invisible_id]').size();
          for(i=1;i<=tam;i++){
            $('#seat-map-'+i).hide();
          }          
          
          var sc = $('#seat-map-'+index).seatCharts({
            map: arreglo,
          naming : {
            top : false,
            getLabel : function (character, row, column) {
              return column;
            }
          },
          click : function(){
                  if(this.status()=='available' && this.status()!='selected'){
                      var num_cant = $('.seatCharts-cell.selected').length;
                      var unavailable = false;
                      if(num_cant<2){
                        if(num_cant == 1){
                          var id_selec1 = $('.seatCharts-cell.selected').first().attr('id');
                          var id_selec2 = this.node().attr('id');
                          var res = id_selec1.split("_");
                          var fil_ini = parseInt(res[0]);
                          var col_ini = parseInt(res[1]);
                          var res = id_selec2.split("_");
                          var fil_ini2 = parseInt(res[0]);
                          var col_ini2 = parseInt(res[1]);
                          if(col_ini > col_ini2)
                            $('#input-colIni').val(''+col_ini2);
                          else $('#input-colIni').val(''+col_ini);
                          if(fil_ini > fil_ini2)
                            $('#input-rowIni').val(''+fil_ini2);
                          else $('#input-rowIni').val(''+fil_ini);
                          $('#input-column').val(''+(Math.abs(col_ini - col_ini2)+1));
                          $('#input-row').val(''+(Math.abs(fil_ini - fil_ini2)+1));
                          var col_ini = parseInt($('#input-colIni').val());
                          var fil_ini = parseInt($('#input-rowIni').val());
                          var cant_fil = parseInt($('#input-row').val());
                          var cant_col = parseInt($('#input-column').val());
                          unavailable = false;
                          for(i = col_ini; i<col_ini+cant_col;i++){
                            for(j=fil_ini; j<fil_ini + cant_fil; j++){
                              var id = ''+j+'_'+i;
                              if(id!= id_selec2 && id!= id_selec1){
                                  if($('#'+id).hasClass('unavailable')){
                                    $('#input-colIni').val('');
                                    $('#input-rowIni').val('');
                                    $('#input-column').val('');
                                    $('#input-row').val('');
                                    $('.reserved').removeClass('reserved').addClass('available');
                                    $('.selected').removeClass('selected').addClass('available');
                                    alert('No se puede seleccionar estos asientos porque ya están ocupados por otra zona');
                                    unavailable = true;
                                    break;
                                  }
                                  $('#'+id).removeClass("available");
                                  $('#'+id).addClass('reserved');
                              }
                            }
                            if(unavailable) break;
                          }
                        }
                        if(!unavailable){
                          this.status('selected');
                          return 'selected';
                        } else {
                          this.status('available');
                          return 'available';
                        }
                      } else{
                        alert('Ya hay dos asientos seleccionados');
                        this.status('available');
                        return 'available';
                      }
                    }
                    if(this.status()=='selected'){
                      $('#input-colIni').val('');
                      $('#input-rowIni').val('');
                      $('#input-column').val('');
                      $('#input-row').val('');
                      $('.seatCharts-cell.reserved').removeClass("reserved").addClass("available");
                      this.status('available');
                      return 'available';
                    }
          },
          legend : { //Definition legend
            node : $('#legend'),
            items : [
              [ 'a', 'available',   'Libre' ],
              [ 'a', 'unavailable', 'Ocupado'],
              [ 'a', 'reserved', 'Reservado']
            ]
          } });
          $('#seat-map-'+index).show();

          
          $('#input-column').show();
          $('#input-row').show();
          $('#input-colIni').show();
          $('#input-rowIni').show();
          $('#label_col').show();
          $('#label_fil').show();
          $('#label_fini').show();
          $('#label_cini').show();
          $('#dist').show();
          $('#label_capacity').hide();
          $('#input-capacity').hide();

          document.getElementById('input-capacity').disabled=true;


          var columnsSeat=document.getElementsByName("zone_columns[]");
          var rowsSeat=document.getElementsByName("zone_rows[]");
          var startRowSeat=document.getElementsByName("start_row[]");
          var startColumnSeat=document.getElementsByName("start_column[]");
          for(var n=0;n<numZones;n++){
                var col_ini = parseInt(startColumnSeat[n].value);
                var fil_ini = parseInt(startRowSeat[n].value);
                var cant_fil = parseInt(rowsSeat[n].value);
                var cant_col = parseInt(columnsSeat[n].value);

                console.log("col Ini: " + col_ini);
                console.log("fil ini : " + fil_ini);
                console.log("cant fil: " + cant_fil);
                console.log("cant col: " + cant_col);
                for(i = col_ini; i<col_ini+cant_col;i++){
                  for(j=fil_ini; j<fil_ini + cant_fil; j++){
                    var id = ''+j+'_'+i;
                    $('#'+id).addClass('unavailable');
                  }
                }
                console.log("iteracion "+n);
          }


        }else{


          var ocultos=document.getElementsByClassName("hating");
          console.log("ocultos: " + ocultos.length);
          for(var i=0;i<ocultos.length;i++){
            ocultos[i].name="none"+i;
          }  

          //si el local no tiene asientos numerados Do this 
          //$('#seat-map').empty();

          document.getElementById('input-capacity').disabled=false;
          var tam= $('[id=invisible_id]').size();
          for(i=1;i<=tam;i++){
            $('#seat-map-'+i).hide();
          }
          //$('#seat-map').hide();
          
          $('#input-column').hide();
          $('#input-row').hide();
          $('#input-colIni').hide();
          $('#input-rowIni').hide();
          $('#label_col').hide();
          $('#label_fil').hide();
          $('#label_fini').hide();
          $('#label_cini').hide();
          $('#dist').hide();
          $('#label_capacity').show();
          $('#input-capacity').show();
        }
      }

      $('[name=local_id]').click(function(){
        var e = $('[name=local_id]')[0];

        var index= e.options[e.selectedIndex].value;
        console.log(index);
        var algo = $('#row_' + index).val();
        //console.log("algo "+algo);
        var table = document.getElementById("table-zone");

        for(var i = table.rows.length - 1; i > 0; i--)
        {
            table.deleteRow(i);
        }

        if(algo !== undefined && algo >=1){
          //si el local tiene asientos y filas numeradas Do this 
          //console.log("index "+index);
          var rows = $('#row_'+index).val();
          var columns = $('#column_'+index).val();

          // setear maximo filas maxima col
          document.getElementById("input-column").max=columns;
          document.getElementById("input-row").max=rows;
          document.getElementById("input-colIni").max=columns;
          document.getElementById("input-rowIni").max=rows;

          console.log("columnas "+columns);

          console.log("filas "+rows);

          var arreglo = new Array();

          for(i=0; i<rows;i++){
            var texto = 'a';
            for(j=1; j<columns; j++){
              texto += 'a';
            }
            //console.log(texto);
            arreglo.push(texto);
          }
          console.log(arreglo);
          //console.log(arreglo);
          var seatid="seat-map-"+index;
          console.log(seatid);

          var tam= $('[id=invisible_id]').size();
          for(i=1;i<=tam;i++){
            $('#seat-map-'+i).hide();
          }          
          
          var sc = $('#seat-map-'+index).seatCharts({
            map: arreglo,
          naming : {
            top : false,
            getLabel : function (character, row, column) {
              return column;
            }
          },
                    click : function(){
                  if(this.status()=='available' && this.status()!='selected'){
                      var num_cant = $('.seatCharts-cell.selected').length;
                      var unavailable = false;
                      if(num_cant<2){
                        if(num_cant == 1){
                          var id_selec1 = $('.seatCharts-cell.selected').first().attr('id');
                          var id_selec2 = this.node().attr('id');
                          var res = id_selec1.split("_");
                          var fil_ini = parseInt(res[0]);
                          var col_ini = parseInt(res[1]);
                          var res = id_selec2.split("_");
                          var fil_ini2 = parseInt(res[0]);
                          var col_ini2 = parseInt(res[1]);
                          if(col_ini > col_ini2)
                            $('#input-colIni').val(''+col_ini2);
                          else $('#input-colIni').val(''+col_ini);
                          if(fil_ini > fil_ini2)
                            $('#input-rowIni').val(''+fil_ini2);
                          else $('#input-rowIni').val(''+fil_ini);
                          $('#input-column').val(''+(Math.abs(col_ini - col_ini2)+1));
                          $('#input-row').val(''+(Math.abs(fil_ini - fil_ini2)+1));
                          var col_ini = parseInt($('#input-colIni').val());
                          var fil_ini = parseInt($('#input-rowIni').val());
                          var cant_fil = parseInt($('#input-row').val());
                          var cant_col = parseInt($('#input-column').val());
                          unavailable = false;
                          for(i = col_ini; i<col_ini+cant_col;i++){
                            for(j=fil_ini; j<fil_ini + cant_fil; j++){
                              var id = ''+j+'_'+i;
                              if(id!= id_selec2 && id!= id_selec1){
                                  if($('#'+id).hasClass('unavailable')){
                                    $('#input-colIni').val('');
                                    $('#input-rowIni').val('');
                                    $('#input-column').val('');
                                    $('#input-row').val('');
                                    $('.reserved').removeClass('reserved').addClass('available');
                                    $('.selected').removeClass('selected').addClass('available');
                                    alert('No se puede seleccionar estos asientos porque ya están ocupados por otra zona');
                                    unavailable = true;
                                    break;
                                  }
                                  $('#'+id).removeClass("available");
                                  $('#'+id).addClass('reserved');
                              }
                            }
                            if(unavailable) break;
                          }
                        }
                        if(!unavailable){
                          this.status('selected');
                          return 'selected';
                        } else {
                          this.status('available');
                          return 'available';
                        }
                      } else{
                        alert('Ya hay dos asientos seleccionados');
                        this.status('available');
                        return 'available';
                      }
                    }
                    if(this.status()=='selected'){
                      $('#input-colIni').val('');
                      $('#input-rowIni').val('');
                      $('#input-column').val('');
                      $('#input-row').val('');
                      $('.seatCharts-cell.reserved').removeClass("reserved").addClass("available");
                      this.status('available');
                      return 'available';
                    }

          },
          legend : { //Definition legend
            node : $('#legend'),
            items : [
              [ 'a', 'available',   'Libre' ],
              [ 'a', 'unavailable', 'Ocupado'],
              [ 'a', 'reserved', 'Reservado']
            ]
          } });
          $('#seat-map-'+index).show();

          
          $('#input-column').show();
          $('#input-row').show();
          $('#input-colIni').show();
          $('#input-rowIni').show();
          $('#label_col').show();
          $('#label_fil').show();
          $('#label_fini').show();
          $('#label_cini').show();
          $('#dist').show();
          $('#label_capacity').hide();
          $('#input-capacity').hide();

          document.getElementById('input-capacity').disabled=true;
        }else{
          //si el local no tiene asientos numerados Do this 
          //$('#seat-map').empty();

          document.getElementById('input-capacity').disabled=false;
          var tam= $('[id=invisible_id]').size();
          for(i=1;i<=tam;i++){
            $('#seat-map-'+i).hide();
          }
          //$('#seat-map').hide();
          
          $('#input-column').hide();
          $('#input-row').hide();
          $('#input-colIni').hide();
          $('#input-rowIni').hide();
          $('#label_col').hide();
          $('#label_fil').hide();
          $('#label_fini').hide();
          $('#label_cini').hide();
          $('#dist').hide();
          $('#label_capacity').show();
          $('#input-capacity').show();
        }
      });
    });
  </script>
   <script>


$('document').ready(function () {
  getSubs();
})

  function getSubs(){
      category_id = $("#category_id").val();
      
      url_base = "{{ url('/') }}";
      // Peticion ajax
      $.getJSON(url_base+"/promoter/"+category_id+"/subcategories", function(data)
      {
        $("#subcategory_id").empty();
        $.each( data, function( id, name ) {
            $('#subcategory_id').append("<option value=\""+id+"\">"+name+"</option>");
      });

    });
  }

  $(document).ready(function(){
    // Poblar sub category
    $("#category_id").change(function(){

      category_id = $("#category_id").val();
      url_base = "{{ url('/') }}";
      // Peticion ajax
      $.getJSON(url_base+"/promoter/"+category_id+"/subcategories", function(data)
      {
        $("#subcategory_id").empty();
        $.each( data, function( id, name ) {
            $('#subcategory_id').append("<option value=\""+id+"\">"+name+"</option>");
      });

      })
    });
  });
   </script>



  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/rangepicker.js')!!}



  <script type="text/javascript">
    $('#yes').click(function(){
      $('#submitModal').modal('hide');  
    });
    
  </script>

@stop