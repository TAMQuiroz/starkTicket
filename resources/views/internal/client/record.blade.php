@extends('layout.client')

@section('style')
	 
	 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.css">
     <style type="text/css">
        .input-group{
            width:600px;
        }
     </style>
@stop

@section('title')
	Historial de eventos del cliente
@stop

@section('content')
    <h5>Búsqueda</h5>
    <div class="input-group">
        {!! Form::text('search', '', array('class' => 'form-control')) !!}
        <span class="input-group-btn">
            <button class="btn btn-info" type="button">Buscar</button>
        </span>
    </div>
    <br>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Fecha del Evento</th>
            <th>Nombre del Evento</th>
            <th>Número de Tickets</th>
            <th>Costo Total</th>
            <th>Lugar del Evento</th>
        </tr>
        <tr>
           <td>12/02/2015</td>
           <td>Iron Maiden Tour 667</td>
           <td>3</td>
           <td>420</td>
           <td>Estadio Nacional</td>
        </tr>
        <tr>
            <td>03/04/2015</td>
            <td>Bob Esponja el musical</td>
            <td>5</td>
            <td>140</td>
            <td>Teatro Fondo de bikini</td>
        </tr>
         <tr>
            <td>23/04/2015</td>
            <td>Floricienta 3D</td>
            <td>1</td>
            <td>200</td>
            <td>Polideportivo PUCP</td>
        </tr>
         <tr>
            <td>23/04/2015</td>
            <td>Floricienta 4D</td>
            <td>1</td>
            <td>450</td>
            <td>Polideportivo PUCP</td>
        </tr>
        <tr>
            <td>27/06/2015</td>
            <td>Alianza vs Universitario</td>
            <td>4</td>
            <td>240</td>
            <td>Estadio Alejandro Villanueva</td>
        </tr>
    </table>
                 
@stop

@section('javascript')

    {!!Html::script('//cdn.datatables.net/1.10.9/js/jquery.dataTables.js')!!}

@stop