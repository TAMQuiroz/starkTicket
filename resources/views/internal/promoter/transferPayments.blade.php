@extends('layout.promoter')

@section('style')
	{!!Html::style('css/modern-business.css')!!}
@stop

@section('title')
	Pagos de transferencias
@stop

@section('content')
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a >Pagos</a></li>
                  
                </ol>
            </div>
        </div>
        <!-- /.row -->  
        <legend>Eventos registrados:</legend>  
        <label>Nombre del Evento:</label>
        <input type="text" />
        <button type="button" class="btn btn-info">Buscar</button> 
        <div>
            <label>Categoria Evento:</label>
            <select>
                <option value="">Concierto</option>
                <option value="saab">Teatro</option>
                <option value="mercedes">Ferias y Circo</option>
                <option value="audi">Danzas</option>
                <option value="audi">Otros</option>
            </select>
        </div>  
        <br>
        <br>
        <div class="table-responsive">
          <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Organizador</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Vivo por el rock 6</td>  
                    <td>Contara con artistas nacionales e internacionales,<br> Arctic monkeys, red hot, cold play y tourista</td>  
                    <td>Concierto</td>  
                    <td>Limapalooza producciones</td> 
                    <td><input type="checkbox" class="checkbox" /></td>
                </tr>
                <tr>
                    <td>Vivo por el rock 7</td>  
                    <td>Contara con artistas nacionales e internacionales,<br> Arctic monkeys, red hot, cold play y tourista</td>  
                    <td>Concierto</td>  
                    <td>Limapalooza producciones</td>
                    <td><input  type="checkbox" class="checkbox" /></td>
                </tr>
            </tbody>
          </table>
        </div>
        <legend>Datos organizador:</legend>  
        <label>Nombre organizador:</label>
        <input type="text" disabled="disabled" value="Limapalooza producciones"/>  
        <br>  
        <label>RUC organizador:</label>
        <input type="text" disabled="disabled" value="2010155082"/>  
        <br>   
        <label>Número de cuenta:</label>
        <input type="text" disabled="disabled" value="4010155086"/>  
        <br>                 
        <label>Fecha de entrega:</label>
        <input type="text" disabled="disabled" value="30/10/2015"/>
         <br> 
        <label>Monto de pago:</label>
        <input type="text" disabled="disabled" value="$15000.00"/>       <br>
        <label>Evento:</label>
        <input type="text" disabled="disabled" value="Vivo por el rock 6"/>  
        <br>   
        <br>
        <br>  
        <button type="button" class="btn btn-info">Registrar pago</button>                 
    </div>
@stop

@section('javascript')
	{!!Html::script('js/moment.js')!!}
	{!!Html::script('js/rangepicker.js')!!}
@stop