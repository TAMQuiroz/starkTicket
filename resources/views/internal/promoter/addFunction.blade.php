@extends('layout.promoter')

@section('style')
  {!!Html::style('css/modern-business.css')!!}
  {!!Html::style('css/modern-business.css')!!}
@stop

@section('title')
    Nuevo Evento
@stop

@section('content')
	<div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="NuevoEvento.html">Inicio</a>
                    </li>
                    <li><a href="NuevoEventoFunciones.html">Funciones</a></li>
                  
                </ol>
            </div>
        </div>
        <!-- /.row --> 

        
        <fieldset>
            <legend>Funciones del evento:</legend>
            <div class="container">
            	<legend>Agregar función:</legend>    
                 <button type="button" class="btn btn-info">Agregar</button>      	
                <div>
                    <label for="name">Fecha inicio:</label>
                    <input type="date" data-date-inline-picker="true" />
                </div>
                <br>
                <div>
                    <label for="place">Fecha fin:</label>
                    <input type="date" data-date-inline-picker="true" />
                </div>
                <br>
                <div>
                    <label for="name">Hora inicio:</label>
                    <input type="time" />
                </div>
                <br>
                <div>
                    <label for="place">Hora fin:</label>
                    <input type="time" /><br>
                </div>  
                <br>              
                <div>
                    <label for="place">Repetición:</label>
                    <select>
                        <option value="">Una sola vez</option>
                        <option value="saab">Diario(Lun-Vier)</option>
                        <option value="saab">Diario(Lun-Dom)</option>
                        <option value="mercedes">Semanal</option>
                        <option value="audi">Mensual</option>
                    </select>
                </div>     
                <br>
                <div class="zona">
                    <legend>Agregar Zona:</legend> 
                    <label for="place">Nombre zona:</label>
                    <input type="text" /><br>
                    <label for="place">Capacidad zona:</label>
                    <input type="text" /><br>
                    <label for="place">Precio estandar:</label>
                    <input type="text" />
                    <button type="button" class="btn btn-info">Agregar</button>
                    <br><br>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Capacidad</th>
                                <th>Precio</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Zona vip</td>  
                                <td>200</td>  
                                <td>150.0</td>  
                                <td><button type="button" class="btn btn-info">x</button></td>
                            </tr>
                            <tr>
                                <td>Zona platea</td>  
                                <td>300</td>  
                                <td>120.0</td>  
                                <td><button type="button" class="btn btn-info">x</button></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>    
                    <br><br>
                    <legend>Agregar Promoción:</legend>  
                    <label>Zona:</label>
                    <select>
                        <option value="">Zona vip</option>
                        <option value="saab">Zona platea</option>
                    </select>                                         
                    <label>Promociones:</label>
                    <select>
                        <option value="">Viernes juergueros</option>
                        <option value="saab">Pepitos promociones</option>
                        <option value="mercedes">Promociones navideñas</option>
                        <option value="mercedes">Cmr descuentos</option>
                        <option value="mercedes">Lunes especiales</option>
                    </select>
                    <button type="button" class="btn btn-info">Agregar</button>
                    <br><br>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Zona</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cmr descuentos</td>  
                                <td>Zona vip</td>
                                <td><button type="button" class="btn btn-info">x</button></td>
                            </tr>
                            <tr>
                                <td>Lunes especiales</td>  
                                <td>Zona vip</td>
                                <td><button type="button" class="btn btn-info">x</button></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>    
                    <br><br>                                             
                </div>
                <legend>Funciones agregadas:</legend> 
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha inicio</th>
                                <th>Hora inicio</th>
                                <th>Fecha fin</th>
                                <th>Hora fin</th>
                                <th>Repetición</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24/09/2015</td>  
                                <td>10:30 AM</td>  
                                <td>10/10/2015</td> 
                                <td>1:30 PM</td>  
                                <td>Diario(Lun-Dom)</td>
                                <td><button type="button" class="btn btn-info">x</button></td>
                            </tr>
                            <tr>
                                <td>24/09/2015</td>  
                                <td>2:30 PM</td>  
                                <td>10/10/2015</td> 
                                <td>5:30 PM</td>  
                                <td>Diario(Lun-Vier)</td>  
                                <td><button type="button" class="btn btn-info">x</button></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <button type="button" class="btn btn-info">Registrar evento</button>                    
            </div>    
            <br>

@stop

@section('javascript')
  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/rangepicker.js')!!}
@stop