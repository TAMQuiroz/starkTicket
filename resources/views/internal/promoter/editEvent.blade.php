@extends('layout.promoter')

@section('style')
  <!--{!!Html::style('css/modern-business.css')!!} -->
  <!-- {!!Html::style('css/estilos.css')!!} -->
@stop

@section('title')
    Editar Evento
@stop

@section('content')
        <!-- Contenido-->
         <div class="row">
          <div class="col-sm-8">
            {!!Form::open(array('url' => 'promoter/event/'.$event->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label  class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  {!! Form::text('name',$event->name, array('class' => 'form-control','required')) !!}
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
                  {!! Form::textarea('description', $event->description, ['class' => 'form-control', 'rows' => '5']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-10">
                    {!! Form::select('category_id', $categories_list->toArray(),$event->category_id,['class' => 'form-control','required','id'=>'category_id']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sub categoría</label>
                <div class="col-sm-10">
                    {!! Form::select('category_id', $categories_list->toArray() ,$event->category_id,['class' => 'form-control','required','id'=>'subcategory_id']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Organizador</label>
                <div class="col-sm-10">
                    {!! Form::select('organizer_id', $organizers_list->toArray(),$event->organizer_id,['class' => 'form-control','required']) !!}
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
                    {!! Form::date('publication_date',$event->publication_date, array('class' => 'form-control','required', 'oninput' => 'incrementSellingDate()')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de inicio de ventas</label>
                <div class="col-sm-10">
                    {!! Form::date('selling_date',$event->selling_date, array('class' => 'form-control','required', 'oninput' => 'incrementPresentationDate()')) !!}
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Imagen evento</label>
                <div class="col-sm-10">
                  {!! Form::file('image', array('class' => 'form-control')) !!}
                </div>
              </div>
              <br>
              <div id="seat-map" class="seatCharts-container" tabindex ="0"></div>
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
                      {!! Form::number('zoneCapacity','', array('class' => 'form-control','id' => 'input-capacity')) !!}
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">Precio</label>
                  <div class="col-sm-10">
                      {!! Form::number('zonePrice','', array('class' => 'form-control','id' => 'input-price')) !!}
                  </div>
              </div>

              <div class="form-group">
                    <label  class="col-sm-3 control-label">capacidad disponible</label>
                    <div class="col-sm-3">
                    <input type="text" id="capacity-display" class="form-control" disabled>
                    </div>
                    <div class="col-sm-offset-10 col-sm-6">
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
                        newDelete.onclick= "deleteZone(newRow)";

                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(textPrice);
                        newCell5.appendChild(newDelete);

                        document.getElementById('input-zone').value = '';
                        document.getElementById('input-capacity').value = '';
                        document.getElementById('input-price').value = '';

                        var new_capacity = document.getElementById('capacity-display').value;
                        new_capacity = new_capacity - capacity;
                        document.getElementById('capacity-display').value = new_capacity;
                    }

                    function deleteZone(btn){
                        var row=btn.parentNode.parentNode.rowIndex;
                        document.getElementById('table-zone') .deleteZone(row);
                
                    }    
                </script>

                <table id="table-zone" class="table table-bordered table-striped ">
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </tr>

                    @foreach($event->zones as $zone)
                    <tr>
                        <td>$zone->name</td>
                        <td>$zone->capacity</td>
                        <td>$zone->Price</td>
                        <td>
                          <a class="btn btn-info" href=""  title="Eliminar"    data-toggle="modal" data-target="#deleteModal{{$zone->id}}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>     

                     <!-- MODAL -->
                      <div class="modal fade"  id="deleteModal{{$organizer->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">¿Estas seguro que desea eliminar a un organizador?</h4>
                            </div>
                            <div class="modal-body">
                              <h5 class="modal-title">Los cambios serán permanentes</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                <a class="btn btn-info" href="{{url('promoter/event/'.$zone->id.'/delete')}}" title="Delete" >Sí</a>
                            </div>
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->

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
                        newDelete.onclick= "deleteFunction(newRow)";
                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell4.appendChild(newDelete);


                        document.getElementById('input-function-date')[0].value = '';

                    }
                    function deleteFunction(btn){
                        var row=btn.parentNode.parentNode.rowIndex;
                        document.getElementById('functions-table') .deleteFunction(row);
                
                    }  


                </script>

                <table id="functions-table" class="table table-bordered table-striped ">
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Eliminar</th>
                    </tr>

                    @foreach($event->presentations as $function)
                    <tr>
                        <td>$function->start_date</td>
                        <td>$function->start_time</td>
                        <td>
                          <a class="btn btn-info" href=""  title="Eliminar"    data-toggle="modal" data-target="#deleteModal{{$function->id}}"><i class="glyphicon glyphicon-remove"></i></a>
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
                                <a class="btn btn-info" href="{{url('promoter/event/'.$function->id.'/delete')}}" title="Delete" >Sí</a>
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
                        <button id="yes" type="submit" class="btn btn-info">Si</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
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

      $('[name=local_id]').click(function(){
        var e = $('[name=local_id]')[0];
        var index= e.options[e.selectedIndex].value;

        var algo = $('#row_' + index).val();
        console.log("algo "+algo);
        if(algo !== undefined && algo >=1){
          console.log("index "+index);
          var rows = $('#row_'+index).val();
          var columns = $('#column_'+index).val();
          console.log("columnas "+columns);
          var arreglo = new Array();
          for(i=0; i<rows;i++){
            var texto = 'a';
            for(j=1; j<columns; j++){
              texto += 'a';
            }
            console.log(texto);
            arreglo.push(texto);
          }
          console.log(arreglo);
          $('#seat-map').show();
          var sc = $('#seat-map').seatCharts({
            map: arreglo,
          naming : {
            top : false,
            getLabel : function (character, row, column) {
              return column;
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
          $('#seat-map').show();
        }else{
          $('#seat-map').empty();
          var sc = $('#seat-map').hide();
        }
      });
    });
  </script>
  <script>
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