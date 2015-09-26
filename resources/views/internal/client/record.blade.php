@extends('layout.client')

@section('style')
	 
	 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.css">

@stop

@section('title')
	Historial de eventos q asistio el cliente
@stop

@section('content')

	
                       <table id="example" class="display" cellspacing="0" width = "100%" >
                            <thead>
                                <tr>
                                    <th>Fecha del evento</th>
                                    <th>Nombre del evento</th>
                                    <th>Numero total de tickets</th>
                                    <th>Costo total</th>
                                    <th>Lugar del evento</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                        <th>Fecha del evento</th>
                                        <th>Nombre del evento</th>
                                        <th>Numero total de tickets</th>
                                 	    <th>Costo total/th>
                                  	    <th>Lugar del evento</th>
                                    </tr>
                                </tfoot>
                           <tbody>
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
                            </tbody>
                        </table>
                 
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