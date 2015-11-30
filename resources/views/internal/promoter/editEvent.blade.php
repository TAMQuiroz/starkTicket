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
        @foreach ($capacity_list as $key=>$capacity)
          {!! Form::hidden ('capacity_'.$capacity->id, $capacity->capacity) !!}
          {!! Form::hidden ('row_'.$capacity->id, $capacity->rows,  array('id' =>'row_'.$capacity->id)) !!}
          {!! Form::hidden ('column_'.$capacity->id, $capacity->columns, array('id' =>'column_'.$capacity->id)) !!}
          {!! Form::hidden('invisible', 'secret', array('id' => 'invisible_id')) !!}
          
        @endforeach

        @foreach($event->zones as $key=>$value)
          {!! Form::hidden('zones_ids', $event->zones[$key]->id, array('id' => 'zones_ids_'.$key)) !!}
          {!! Form::hidden('zones_prices2', $event->zones[$key]->price, array('id' => 'zones_prices2_'.$key)) !!}
          {!! Form::hidden('zones_names2', $event->zones[$key]->name, array('id' => 'zones_names2_'.$key)) !!}
        @endforeach
        <div class="row">
          <div class="col-sm-12">
            {!!Form::open(array('url' => 'promoter/event/'.$event->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label  class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!! Form::text('name',$event->name, array('class' => 'form-control','required','maxlength' => 100)) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Lugar</label>
                <div class="col-sm-10">
                  {!! Form::select('local_id', $locals_list->toArray(), $event->local_id, ['class' => 'form-control','required', 'onclick' => 'changeCapacity()', 'onchange'=>'makeArray1()']) !!}
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

              <div class="col-md-3">
                  <div class="form-group">
                    multiple
                    {!! Form::radio('selection_mode', 'dos',true,['id'=>'multiple-mode-on'])!!} 
                    single
                    {!! Form::radio('selection_mode', 'uno',false,['id'=>'single-mode-on'])!!} 
                  </div>
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
                      <label  class="col-md-4 control-label" id="capacity-display-label">Capacidad disponible</label>
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
              <div class="col-md-9"> 
                  <div class="demo">
                      <div id="parent-map" >
                          <div id="seat-map"></div>
                      </div>
                 </div> 
                 </div> 
                  
                <script>

                    function deleteZone(btn){
                        var row=btn.parentNode.parentNode.rowIndex;
                        var row2 = row-1;
                        var cant_filas_total = $('#table-zone').find('tr').length-2;
                        if( document.getElementById('input-capacity').disabled==true){
                              console.log($("[name='seats_ids[0][]']").length);
                              $("[name='seats_ids["+row2+"][]']").each(function(index,element){
                                $(this).remove();
                                //element.remove();
                              });
                              for(i = row2+1 ; i<= cant_filas_total; i++){
                                $("[name='seats_ids["+i+"][]']").each(function(index,element){
                                $(this).attr('name', 'seats_ids['+(i-1)+'][]');
                                //element.remove();
                              });
                              }
                              var col_ini = parseInt($('[name="start_column[]"]')[row2].value);
                              var fil_ini = parseInt($('[name="start_row[]"]')[row2].value);
                              var cant_fil = parseInt($('[name="zone_rows[]"]')[row2].value);
                              var cant_col = parseInt($('[name="zone_columns[]"]')[row2].value);
                              for(i = col_ini; i<col_ini+cant_col;i++){
                                for(j=fil_ini; j<fil_ini + cant_fil; j++){
                                  var id = ''+j+'_'+i;
                                  if($('#'+id).length){
                                    $('#'+id).removeClass("unavailable");
                                    $('#'+id).addClass('available');
                                  }
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
                  <div class="col-sm-6" id="firefox" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                      
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Hora de inicio</label>
                  <div class="col-sm-10">
                      {!! Form::time('input_start_time',null, array('class' => 'form-control', 'id' => 'input-function-time')) !!}
                  </div>
                  <div class="col-sm-6" id="firefox2" style="visibility: hidden">
                      Formato hora(24 h): hh:mm
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
  {!!Html::script('js/jquery.seat-charts.js')!!}
  {!!Html::script('js/editEvent.js')!!}
   <script>


$('document').ready(function () {
  getSubs();
  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
    document.getElementById('firefox2').style.visibility='visible';
  }
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

  var config = {
        routes: [
            { getSeatsArray: "{{ URL::route('ajax.getSeatsArray') }}" },
            { price_ajax: "{{ URL::route('ajax.getPrice') }}" },
            { event_available: "{{URL::route('ajax.getAvailable')}}"},
            { slots: "{{URL::route('ajax.getSlots')}}"},
            { makeArray: "{{URL::route('ajax.getSeatsArray')}}"},
            { takenSlots: "{{URL::route('ajax.getTakenSlots')}}"},
            { getZonesSeatsIds: "{{URL::route('ajax.getZoneSeatsIds')}}"}
        ]
    };
    $('#yes').click(function(){
      $('#submitModal').modal('hide');  
    });
    
  </script>

@stop