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
  div.seatCharts-cell.seatCharts-space{
    visibility: visible;
  }
  </style>
@stop

@section('title')
    Nuevo Evento
@stop

@section('content')
<script type="text/javascript">

  window.onload = function(){
    var today = new Date();
    var month = today.getMonth() +1;
    var day = today.getDate();
    var string_month = '' + month;
    var string_day = '' + day;
    if(month<10)
      string_month = '0' + month;
    if(day<10)
      string_day = '0' + day;
    var todayDate = ''+today.getFullYear()+'-'+string_month+'-'+string_day;
    document.getElementsByName('selling_date')[0].min = todayDate;
    document.getElementById('input-function-date').min = todayDate;
    var e = document.getElementsByName('local_id')[0];
    var index= e.options[e.selectedIndex].value;
    document.getElementById('capacity-display').value = document.getElementsByName('capacity_'+index)[0].value;
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
    var day = today.getDate();
    var string_month = '' + month;
    var string_day = '' + day;
    if(month<10)
      string_month = '0' + month;
    if(day<10)
      string_day = '0' + day;
    if(timeToday > timePublic)
      document.getElementsByName('selling_date')[0].min = ''+today.getFullYear()+'-'+string_month+'-'+string_day;
    else
      document.getElementsByName('selling_date')[0].min = publication_date_1;
  }

  function incrementPresentationDate(){
    document.getElementById('input-function-date').min = document.getElementsByName('selling_date')[0].value;
  }
</script>

        <!-- Contenido-->
        @foreach ($capacity_list as $capacity)
          {!! Form::hidden ('capacity_'.$capacity->id, $capacity->capacity) !!}
          {!! Form::hidden ('row_'.$capacity->id, $capacity->rows,  array('id' =>'row_'.$capacity->id)) !!}
          {!! Form::hidden ('column_'.$capacity->id, $capacity->columns, array('id' =>'column_'.$capacity->id)) !!}
          {!! Form::hidden('invisible', 'secret', array('id' => 'invisible_id')) !!}
        @endforeach
        {!! Form::hidden('counter', '0', array('id' => 'seat_counter')) !!}

        <div class="row">
          <div class="col-sm-12">
            {!!Form::open(array('route' => 'events.store','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label  class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                  {!! Form::text('name','', array('class' => 'form-control','required','maxlength' => 100)) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Lugar</label>
                <div class="col-sm-6">
                  {!! Form::select('local_id', $locals_list->toArray(), null, ['class' => 'form-control','required', 'onclick' => 'changeCapacity()','maxlength' => 50]) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-6">
                  {!! Form::textarea('description', null, ['class' => 'form-control','style' => 'resize:none','rows' => '3','maxlength' => 100]) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-6">

                    {!! Form::select('parent_category_id', $categories_list->toArray(),null,['class' => 'form-control','required','id'=>'category_id']) !!}
                </div>

              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sub categoría</label>
                <div class="col-sm-6">
                    {!! Form::select('category_id',$categories_list->toArray(),null,['class' => 'form-control','required','id'=>'subcategory_id','onLoad'=>'getSubs()']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Organizador</label>
                <div class="col-sm-6">

                    {!! Form::select('organizer_id', $organizers_list->toArray(),null,['class' => 'form-control','required','maxlength' => 50]) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Comisión(%)</label>
                <div class="col-sm-6">
                  {!! Form::number('percentage_comission','', array('class' => 'form-control','min' => '0','required','max' => '100')) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Duración Aproximada (horas) </label>
                <div class="col-sm-6">
                  {!! Form::number('time_length',1, array('class' => 'form-control','min' => '1','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de publicación del evento</label>
                <div class="col-sm-6">
                    {!! Form::date('publication_date',\Carbon\Carbon::now(), array('class' => 'form-control','required', 'oninput' => 'incrementSellingDate()', 'min'=>\Carbon\Carbon::now()->toDateString())) !!}
                  <div class="col-sm-6" id="firefox3" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de inicio de ventas</label>
                <div class="col-sm-6">
                    {!! Form::date('selling_date',\Carbon\Carbon::now()->addDay(), array('class' => 'form-control','required', 'oninput' => 'incrementPresentationDate()')) !!}
                  <div class="col-sm-6" id="firefox4" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen evento</label>
                <div class="col-sm-6">
                  {!! Form::file('image', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen distirbución evento</label>
                <div class="col-sm-6">
                  {!! Form::file('distribution_image', array('class' => 'form-control','required')) !!}
                </div>
              </div>              
              <br>

              <!-- ZONA -->
              <legend>Agregar zona:</legend>
              <div class="col-md-3">
                  <div class="form-group">
                <!--multiple
                {!! Form::radio('selection_mode', 'dos',true,['id'=>'multiple-mode-on'])!!} -->
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
                          {!! Form::number('start_column1',1, array('class' => 'form-control','id' => 'input-colIni','min' => '1','disabled')) !!}
                      </div>
                  </div>     
                  <div class="form-group" id="label_cini">
                      <label  class="col-md-4 control-label" >Fila inicial</label>
                      <div class="col-md-8">
                          {!! Form::number('start_row1',1, array('class' => 'form-control','id' => 'input-rowIni','min' => '1','disabled')) !!}
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
                  <div  id="dist" class="col-md-9">
                    <label  id="labelDist">Distribución evento</label>
                  </div>                                                
                <script>

                    function addZone(){
                      if($('#input-capacity').attr('disabled')){
                        $('.selected').removeClass('selected').addClass('reserved');
                        var col_min=100000000;
                        var fil_min=100000000;
                        var col_max=0;
                        var fil_max=0;
                        $('.reserved').each(function(index, element){
                          var id = $(this).attr('id');
                          var col = parseInt(id.split("_")[1]);
                          var fil = parseInt(id.split("_")[0]);
                          console.log(col+" fil "+fil); 
                          if(col<col_min) col_min = col;
                          if(fil<fil_min) fil_min = fil;
                          if(col>col_max) col_max = col;
                          if(fil>fil_max) fil_max = fil;
                        });
                        console.log(col_min);
                        console.log(fil_max);
                        $('#input-column').val(''+(col_max-col_min+1));
                        $('#input-row').val(''+(fil_max-fil_min+1));
                        $('#input-rowIni').val(''+fil_min);
                        $('#input-colIni').val(''+col_min);
                      }
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
                          var elementos = $('.reserved');
                          var index_table = $('#table-zone').find('tr').length-2;
                          $('.reserved').each(function(){
                            $('#table-zone').append('<input type="hidden" name="seats_ids['+index_table+'][]" value="'+this.id+'" id="seats_id_'+index_table+'" >');
                          });
                          $('.selected').each(function(){
                            $('#table-zone').append('<input type="hidden" name="seats_ids['+index_table+'][]" value="'+this.id+'" id="seats_id_'+index_table+'" >');
                          });
                          if($('.reserved').hasClass('available')) $('.reserved').removeClass('available');
                          $('.reserved').removeClass('reserved').addClass('unavailable');
                          $('.selected').removeClass('selected').addClass('unavailable');
                          document.getElementById('input-column').value = '';
                          document.getElementById('input-row').value = '';
                          document.getElementById('input-colIni').value = '';
                          document.getElementById('input-rowIni').value = '';
                        }

                        new_capacity = new_capacity - capacity;
                        if( document.getElementById('input-capacity').disabled==false){
                          document.getElementById('capacity-display').value = new_capacity;
                          document.getElementById("input-capacity").max=new_capacity;
                        }

                    }

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
                        if( document.getElementById('input-capacity').disabled==false){
                          document.getElementById('capacity-display').value = act_val;
                          document.getElementById("input-capacity").max=act_val;
                        }
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
                </table>
                <br>

                              <!-- agregar funciones -->
              <legend>Agregar función:</legend>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-6">
                      {!! Form::date('input_start_date',\Carbon\Carbon::now()->addDay(2), array('class' => 'form-control', 'id' =>'input-function-date')) !!}
                      <div class="col-sm-6" id="firefox" style="visibility: hidden">
                          Formato fecha: aaaaa-mm-dd
                      </div>                   
                  </div>                 
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Hora de inicio</label>
                  <div class="col-sm-6">
                      {!! Form::time('input_start_time',null, array('class' => 'form-control', 'id' => 'input-function-time')) !!}
                      <div class="col-sm-6" id="firefox2" style="visibility: hidden">
                          Formato hora(24 h): hh:mm
                      </div>                    
                  </div>                     
              </div>

              <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
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
                        console.log(start_date);
                        console.log(start_time);
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
                        x.setAttribute("readonly","readonly");
                        x.required = true;
                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "time");
                        newText2.setAttribute("value", start_time);
                        newText2.setAttribute("name", "start_time[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.setAttribute("readonly","readonly");
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
                </table>
                <br>
                {!! Form::hidden ('yesterday', ''.\Carbon\Carbon::now()->subDay()) !!}
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar Evento</a>
                  <a href="{{action('EventController@create')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
                </div>
              </div>

              <!-- MODAL -->
              <div class="modal fade"  id="submitModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">¿Estas seguro que desea crear el evento?</h4>
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
   {!!Html::script('js/events.js')!!}
  <script>


  </script>
  <script>


$('document').ready(function () {
  getSubs();
  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
    document.getElementById('firefox2').style.visibility='visible';
  document.getElementById('firefox3').style.visibility='visible';
  document.getElementById('firefox4').style.visibility='visible';    
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
            { makeArray: "{{URL::route('ajax.getZoneSeatArray')}}"},
            { takenSlots: "{{URL::route('ajax.getTakenSlots')}}"},
            { promo: "{{URL::route('ajax.getPromo')}}"}
        ]
    };
    $('#yes').click(function(){
      $('#submitModal').modal('hide');  
    });
    
  </script>

@stop