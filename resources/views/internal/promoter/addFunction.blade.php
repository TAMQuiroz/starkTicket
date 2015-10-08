@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Nueva Función
@stop

@section('content')


        <div class="row">
          <div class="col-sm-8"> 
            <form class="form-horizontal" method="post">

                <legend>Agregar precios:</legend>

                <div class="row">
                    
                    <div class="col-sm-3">
                        <label>Desde</label>
                        {!! Form::date('dateIni','', array('class' => 'form-control','required')) !!}
                    </div>
                    <div class="col-sm-3">
                        <label>Hasta</label>
                        {!! Form::date('dateEnd','', array('class' => 'form-control','required')) !!}
                    </div>
                    <div class="col-sm-3">
                        <label>Zona</label>
                        {!! Form::select('zone', ['Vip','Platea'],null,['class' => 'form-control','id' => 'zona','required']) !!}
                    </div>
                    <div class="col-sm-2">
                        <label>Cliente</label>
                        {!! Form::select('typeClient', ['Niño','Adulto','Adulto mayor'],null,['class' => 'form-control','id' => 'cliente','required']) !!}
                    </div>         
                        
                    <!--
                    <div class="col-sm-3">
                        <br>
                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2">Mostrar Reporte</button>
                    </div>
                    -->
                </div>
                <br>
                <div class="row">
                    <label for="inputEmail3" class="col-sm-1 control-label">Precio</label>
                    <div class="col-sm-3">
                      {!! Form::text('price','', array('class' => 'form-control','id' =>'precio','required')) !!}
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info" onclick="addPrice()">Agregar</a>
                        <!-- 
                        <button  type="reset" class="btn btn-info">Cancelar</button>
                        -->
                    </div>
                </div>

                <script>

                    function addPrice(){

                        var zonaSel = document.getElementById('zona');
                        var zona =zonaSel.options[zonaSel.selectedIndex].text;
                        var clienteSel = document.getElementById('cliente');
                        var cliente = clienteSel.options[clienteSel.selectedIndex].text;
                        var precio = document.getElementById('precio').value;

                        var tableRef = document.getElementById('table-price').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                        var newCell4 = newRow.insertCell(3);
                        var newCell5 = newRow.insertCell(4);

                        // Append values to cells
                        var newText  = document.createTextNode(zona);
                        var newText2  = document.createTextNode(cliente);
                        var newText3  = document.createTextNode(precio);
                        // buttons
                        var newEdit = document.createElement('button');
                        var newDelete = document.createElement('button');
                        newEdit.className = "btn"; 
                        newEdit.className += " btn-info glyphicon glyphicon-pencil"; 
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";

                        newCell.appendChild(newText);                        
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(newText3);
                        newCell4.appendChild(newEdit);
                        newCell5.appendChild(newDelete);
                
                    }

                </script>

                <table id="table-price" class="table table-bordered table-striped ">
                    <tr>
                        <th>Zona</th>
                        <th>Tipo de cliente</th>
                        <th>Precio</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>Vip</td>
                        <td>Adulto</td>   
                        <td>350</td>               
                        <td>
                            <a class="btn btn-info"  title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"   title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>
                    <tr>
                        <td>Platea</td>                        
                        <td>Nino</td>
                        <td>90</td>
                        <td>
                            <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>            

                </table>


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
                
                <legend>Agregar Promoción:</legend>                              
                <div class="form-group">
                    <label class="col-sm-2 control-label">Zona</label>
                    <div class="col-sm-10">
                        {!! Form::select('zonePromotion', ['Zona vip','Zona platea'],null,['class' => 'form-control','id' => 'zonaPromocion','required']) !!}
                    </div>            
                </div>  
                <div class="form-group">
                    <label class="col-sm-2 control-label">Promoción</label>
                    <div class="col-sm-10">
                        {!! Form::select('promotion', ['Cmr puntos','Lunes de infarto','Pagaron ya'],null,['class' => 'form-control','id' => 'promocion','required']) !!}
                    </div>            
                </div>  
                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info" onclick="addPromotion()" >Agregar</a>
                    </div>
                </div>      

                <script>

                    function addPromotion(){
      
                        var zonaSel = document.getElementById('zonaPromocion');
                        var zona =zonaSel.options[zonaSel.selectedIndex].text;
                        var promocionSel = document.getElementById('promocion');
                        var promocion = promocionSel.options[promocionSel.selectedIndex].text;
                        var tableRef = document.getElementById('table-promotion').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);

                        // Append values to cells
                        var newText  = document.createTextNode(zona);
                        var newText2  = document.createTextNode(promocion);
                        // buttons
                        var newDelete = document.createElement('button');
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";

                        newCell.appendChild(newText);                        
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(newDelete);
                
                    }

                </script>

                <table id="table-promotion" class="table table-bordered table-striped">
                    <tr>
                        <th>Nombre zona</th>
                        <th>Promoción</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>Zona vip</td>
                        <td>Cmr puntos</td>  
                        <td>
                             <a class="btn btn-info"   title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>
                    <tr>
                        <td>Zona vip</td>
                        <td>Lunes de infarto</td>
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>            
                    <tr>
                        <td>Zona platea</td>
                        <td>Lunes de infarto</td>
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>  
                </table>
                <legend>Funciones del evento:</legend>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Fecha inicio</th>
                        <th>Hora inicio</th>
                        <th>Fecha fin</th>
                        <th>Hora fin</th>
                        <th>Repetición</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>24/09/2015</td>  
                        <td>10:30 AM</td>  
                        <td>10/10/2015</td> 
                        <td>1:30 PM</td>  
                        <td>Diario(Lun-Dom)</td>
                        <td>
                            <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>                                 
                        <td>
                            <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>24/09/2015</td>  
                        <td>2:30 PM</td>  
                        <td>10/10/2015</td> 
                        <td>5:30 PM</td>  
                        <td>Diario(Lun-Vier)</td> 
                        <td>
                            <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>                                  
                        <td>
                            <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                </table>


                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a  class="btn btn-info" href="#" >Agregar</a>
                  
                    </div>
                </div>

                <legend>Pol&iacute;ticas</legend>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pol&iacute;tica</label>
                    <div class="col-sm-10">
                    {!! Form::select('politic', ['Politica1','Politica 2','Politica 3'],null,['class' => 'form-control','required']) !!}
                    </div>            
                </div> 

                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                        <a  class="btn btn-info" href="#"  >Guardar</a>
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