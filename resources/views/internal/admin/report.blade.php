@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte
@stop

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a> 
                    </li>
                    <li class="active">Reportes</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="" class="list-group-item">Reporte Ventas</a>
                    <a href="" class="list-group-item active">Reporte de Asistencias</a>
                    <a href="" class="list-group-item">Reporte de Asignacion</a>               
                 
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
	
                <!-- <h2>Section Heading</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, et temporibus, facere perferendis veniam beatae non debitis, numquam blanditiis necessitatibus vel mollitia dolorum laudantium, voluptate dolores iure maxime ducimus fugit.</p>
				
				-->
				
				




<div class="container">  <!-- Comienza primer despliegue-->
<h2>Reporte de Asistencias</h2>
<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Ingresar Parámetros</button>
<div id="demo1" class="collapse">



<h4>Seleccione al vendedor</h4>



<select>
  <option value="volvo">Todos los vendedores</option>
  <option value="saab">Juan Perez</option>
  <option value="opel">Ana García</option>
  <option value="audi">Miguel Guanira</option>
</select>


<h4>Seleccione el periodo del reporte</h4>

<input type="date">


<div class="container">
 
  <form role="form">
    <label class="radio-inline">
      <input type="radio" name="optradio">Visualizar Ahora
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">.Excel
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">.PDF
    </label>
  </form>
</div>








	
<div class="container">  <!-- Comienza SEGUNDO despliegue-->

    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2">Mostrar Reporte</button>
    <div id="demo2" class="collapse">

        <br><br>

                <table class="table table-bordered table-striped">
            <tr>
                <th>Apellidos y Nombres</th>
                <th>DNI</th>
                <th>Telefonos(s)</th>
                <th>Sexo</th>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
            </tr>
        </table>
         
        <ul class="pager">  
         <li class="next"><a href="#">Subir</a></li> 
        </ul>
    </div>

 
 
 </div>
 
 
  <!-- <ul class="pager">   ESTO OCULTA TODO
   <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Ocultar Todo</button>
  
   <li type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Ocultar Todo</li>
   <li class="next"><a href="#">Subir</a></li> 
  </ul>
  -->



</div>


				
				
 </div><!-- Termina primer despliegue-->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/rangepicker.js"></script>


@stop

@section('javascript')

@stop