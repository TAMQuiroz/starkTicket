@extends('layout.promoter')

@section('style')
  <!--{!!Html::style('css/modern-business.css')!!} -->
  <!-- {!!Html::style('css/estilos.css')!!} -->
  {!!Html::style('css/jquery.seat-charts.css')!!}
@stop

@section('title')
    Nuevo Evento
@stop

@section('content')
<script type="text/javascript">

  window.onload = function(){
    var today = new Date();
    var month = today.getMonth() +1;
    var todayDate = ''+today.getFullYear()+'-'+month+'-'+today.getDate();
    document.getElementsByName('selling_date')[0].min = todayDate;
    document.getElementById('input-function-date').min = todayDate;
    var e = document.getElementsByName('local_id')[0];
    var index= e.options[e.selectedIndex].value;
    document.getElementById('capacity-display').value = document.getElementsByName('capacity_'+index)[0].value;
  }

  function changeCapacity(){
    var e = document.getElementsByName('local_id')[0];
    var index= e.options[e.selectedIndex].value;
    document.getElementById('capacity-display').value = document.getElementsByName('capacity_'+index)[0].value;

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
    if(timeToday > timePublic)
      document.getElementsByName('selling_date')[0].min = ''+today.getFullYear()+'-'+month+'-'+today.getDate();
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
        @endforeach
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
                  {!! Form::select('local_id', $locals_list->toArray(), null, ['class' => 'form-control','required', 'onclick' => 'changeCapacity()']) !!}
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
                    {!! Form::select('category_id', $categories_list->toArray(),null,['class' => 'form-control','required','id'=>'category_id']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sub categoría</label>
                <div class="col-sm-10">
                    {!! Form::select('category_id', ['Rock','Cumbia','Tropical','Otros'],null,['class' => 'form-control','required','id'=>'subcategory_id']) !!}
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
                  {!! Form::number('time_length','', array('class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de publicación del evento</label>
                <div class="col-sm-10">
                    {!! Form::date('publication_date',\Carbon\Carbon::now(), array('class' => 'form-control','required', 'oninput' => 'incrementSellingDate()')) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de inicio de ventas</label>
                <div class="col-sm-10">
                    {!! Form::date('selling_date',\Carbon\Carbon::now()->addDay(), array('class' => 'form-control','required', 'oninput' => 'incrementPresentationDate()')) !!}
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
@stop