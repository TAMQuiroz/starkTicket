@extends('layout.promoter')

@section('style')
	
@stop

@section('title')
	Promociones
@stop

@section('content')
	<!-- Page Content -->
    <div class="container">
        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-md-9">	
				<div class="container">  <!-- Comienza primer despliegue-->
					<input type="text"></input>
					<button type="button" class="btn btn-info">Buscar</button>
					<br><br>
					<div class="table-responsive">
					  <table class="table table-hover">
					    <thead>
					        <tr>
					            <th>Nombre</th>
					            <th>Cantidad Eventos</th>
					            <th>Fecha Fin</th>
					            <th>Ver</th>
					            <th>Editar</th>
					            <th>Eliminar</th>
					        </tr>
					    </thead>
					    <tbody>
					        <tr>
					            <td>Promoción Visa Platinium</td>  
					            <td>13</td>
					            <td>13/10/2015</td>
					            <td><button type="button" class="btn btn-info" style="font-size:12px;color:#0000;font-family:verdana;" name="B1" onClick="edit('show.html','pagename','640','480','center','front');"><i class="glyphicon glyphicon-plus"></i></button></td>
					            <td><button type="button" class="btn btn-info" style="font-size:12px;color:#0000;font-family:verdana;" name="B1" onClick="edit('edit.html','pagename','640','480','center','front');"><span class="glyphicon glyphicon-pencil"></span></button></td>
					            <td><button type="button" class="btn btn-info" style="font-size:12px;color:#0000;font-family:verdana;" name="B1" onClick="edit('','pagename','640','480','center','front');"><span class="glyphicon glyphicon-remove"></span></button></td>
					        </tr>
					        <tr>
					            <td>Promoción Mastercard</td>  
					            <td>10</td>
					            <td>20/12/2015</td>
					            <td><button type="button" class="btn btn-info" style="font-size:12px;color:#0000;font-family:verdana;" name="B1" onClick="edit('','pagename','640','480','center','front');"><span class="glyphicon glyphicon-plus"></span></button></td>
					            <td><button type="button" class="btn btn-info" style="font-size:12px;color:#0000;font-family:verdana;" name="B1" onClick="edit('','pagename','640','480','center','front');"><span class="glyphicon glyphicon-pencil"></span></button></td>
					            <td><button type="button" class="btn btn-info" style="font-size:12px;color:#0000;font-family:verdana;" name="B1" onClick="edit('','pagename','640','480','center','front');"><span class="glyphicon glyphicon-remove"></span></button></td>
					        </tr>
					    </tbody>
					  </table>
					</div>
					<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Agregar Promoción</button>
					<div id="demo1" class="collapse">
						<br>
						<h4>Ingrese datos de nueva promoción</h4>
						Código: <input type="text"></input>
						Nombre: <input type="text"></input>
						<br><br>
						Fecha Inicio: <input type="text"></input>
						Fecha Fin: <input type="text"></input>
						<br><br>
						Descripcion: <input type="text"></input>
						Descuento (%): <input type="text"></input>
						<br><br>
						<h4>Agregar eventos:</h4>
						<input type="text"></input>
						<button type="button" class="btn btn-info">Buscar</button>
						<br><br>
						<div class="table-responsive">
						  <table class="table">
						    <thead>
						        <tr>
						            <th>Nombre</th>
						            <th>Eliminar</th>
						        </tr>
						    </thead>
						    <tbody>
						        <tr>
						            <td>Viva por el Rock 6</td>  
						            <td><button type="button" class="btn btn-info">x</button></td>
						        </tr>
						        <tr>
						            <td>Arctic Monkeys Lima 2020</td>  
						            <td><button type="button" class="btn btn-info">x</button></td>
						        </tr>
						    </tbody>
						  </table>
						</div>
						<br><br>
						<h4>Agregar categorías:</h4>
						<input type="text"></input>
						<button type="button" class="btn btn-info">Buscar</button>
						<br><br>
						<div class="table-responsive">
						  <table class="table">
						    <thead>
						        <tr>
						            <th>Tipo</th>
						            <th>Eliminar</th>
						        </tr>
						    </thead>
						    <tbody>
						        <tr>
						            <td>Conciertos</td>  
						            <td><button type="button" class="btn btn-info">x</button></td>
						        </tr>
						    </tbody>
						  </table>
						</div>
						<br><br>
						<button type="button" class="btn btn-info">Guardar</button>
						<button type="button" class="btn btn-info">Cancelar</button>
					</div>
				</div>
			</div>
		</div>		
	</div>	
@stop

@section('javascript')

@stop