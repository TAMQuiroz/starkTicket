@extends('layout.client')

@section('style')
	 
	 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.css">

@stop

@section('title')
	Historial de eventos q asistio el cliente
@stop

@section('content')

	<div id="wrapper">

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <table id="example" class="display">
                            <thead>
                                <tr>
                                    <th>Fecha del evento</th>
                                    <th>Nombre del evento</th>
                                    <th>Detalle del evento</th>
                                    <th>Precio del evento(Soles)</th>
                                    <th>Direccion del evento</th>
                                    <th>Lugar del evento</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                        <th>Fecha del evento</th>
                                        <th>Nombre del evento</th>
                                        <th>Detalle del evento</th>
                                        <th>Precio del evento(Soles)</th>
                                        <th>Direccion del evento</th>
                                        <th>Lugar del evento</th>
                                    </tr>
                                </tfoot>
                           <tbody>
                               <tr>
                                   <td>12/02/2015</td>
                                   <td>Iron Maiden Tour 667</td>
                                   <td>Concierto Metal ofrecido por primera vez en Peru</td>
                                   <td>145</td>
                                   <td>Av universitaria 4212</td>
                                   <td>Estadio Nacional</td>


                               </tr>
                               <tr>
                                    <td>03/04/2015</td>
                                    <td>Bob Esponja el musical</td>
                                    <td>Bob Esponja debera luchar contra tus peores enemigos</td>
                                    <td>450</td>
                                    <td>Jr PepeLucho 6645 Urb Las Pinas</td>
                                    <td>Teatro Fondo de bikini</td>
                               </tr>
                                 <tr>
                                    <td>23/04/2015</td>
                                    <td>Floricienta 3D</td>
                                    <td>Vive una aventura magica con Floricienta</td>
                                    <td>450</td>
                                    <td>Jr PepeLucho 1245 Urb Las Flores</td>
                                    <td>Polideportivo PUCP</td>
                               </tr>
                                 <tr>
                                    <td>23/04/2015</td>
                                    <td>Floricienta 3D</td>
                                    <td>Vive una aventura magica con Floricienta</td>
                                    <td>450</td>
                                    <td>Jr PepeLucho 1245 Urb Las Flores</td>
                                    <td>Polideportivo PUCP</td>
                               </tr>
                                <tr>
                                    <td>27/06/2015</td>
                                    <td>Alianza vs Universitario</td>
                                    <td>Campeonato Clausura 2015</td>
                                    <td>40</td>
                                    <td>Av. Isabel La Catolica</td>
                                    <td>Estadio Alejandro Villanueva</td>
                                    
                               </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

    <script>

$(document).ready(function() {
    // DataTable
    var table = $('#example').DataTable();
  
    // Setup - add a text input to each footer cell
    $('th', table.table().footer()).each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );

    </script>

    {!!Html::script('//cdn.datatables.net/1.10.9/js/jquery.dataTables.js')!!}

@stop