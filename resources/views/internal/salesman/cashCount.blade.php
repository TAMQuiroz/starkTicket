@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Arqueo de Caja
@stop

@section('content')
  <!-- Contenido-->
  <h2>Ventas</h2>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Nombre Cliente</th>
        <th>Nombre del Evento</th>
        <th>Tipo de Zona</th>
        <th>Cantidad de Entradas</th>
        <th>Precio Individual</th>
        <th>Sub total</th>

      </tr>

      <tr>
        <td>Cliente Feliz 1</td>
        <td>Nubeluz Reencuentro</td>
        <td>FanBoys</td>
        <td>3</td>
        <td>50.00</td>
        <td>150.00</td>
      </tr>

      <tr>
        <td>Cliente Feliz 1</td>
        <td>Nubeluz Reencuentro</td>
        <td>Haters</td>
        <td>2</td>
        <td>25.00</td>
        <td>50.00</td>
      </tr>

      <tr>
        <td>Cliente Feliz 2</td>
        <td>Kiko y la Chili</td>
        <td>Vip</td>
        <td>1</td>
        <td>250.00</td>
        <td>250.00</td>
      </tr>
      <tr>
        <td>Cliente Amargado 1</td>
        <td>La banda de Pepito</td>
        <td>Normal</td>
        <td>2</td>
        <td>45.00</td>
        <td>90.00</td>
      </tr>
      <tr>
        <td>Cliente Feliz 3</td>
        <td>La banda de Pepito</td>
        <td>Normal</td>
        <td>4</td>
        <td>45.00</td>
        <td>180.00</td>
      </tr>
      <tr>
        <td>Cliente Amargado 2</td>
        <td>La banda de Pepito</td>
        <td>Normal</td>
        <td>2</td>
        <td>45.00</td>
        <td>90.00</td>
      </tr>
       <tr>
        <td>Cliente Feliz 4</td>
        <td>Yo Soy SuperCampeones</td>
        <td>Platea</td>
        <td>5</td>
        <td>100.00</td>
        <td>500.00</td>
      </tr>

      <tr>
        <!--<th scope="row">TOTAL</th>-->

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>TOTAL<strong></td>
        <td>1160.00</td>
      </tr>
    </table>

    <h1>Devoluciones</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Nombre Cliente</th>
        <th>Nombre del Evento</th>
        <th>Tipo de Zona</th>
        <th>Cantidad de Entradas</th>
        <th>Precio Individual</th>
        <th>Sub total</th>

      </tr>

      <tr>
        <td>Cliente Amargado 3</td>
        <td>Fatmagul, el Musical en 2D</td>
        <td>Vip</td>
        <td>2</td>
        <td>150.00</td>
        <td>300.00</td>
      </tr>

      <tr>
        <td>Cliente Lagrimoso 1</td>
        <td>Fatmagul, el Musical en 2D</td>
        <td>Normal</td>
        <td>3</td>
        <td>50.00</td>
        <td>150.00</td>
      </tr>

      <tr>
        <td>Cliente Amargado 4</td>
        <td>Fatmagul, el Musical en 2D</td>
        <td>Haters</td>
        <td>3</td>
        <td>100.00</td>
        <td>300.00</td>
      </tr>

      <tr>
        <!--<th scope="row">TOTAL</th>-->

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>TOTAL<strong></td>
        <td>750.00</td>
      </tr>
    </table>
    <div class="Total">
    <h2 class="totalType">Total del Día: <strong>410.00</strong></h2>
  </div>
  <div class="newArqueo">

      <a href="#" class="btn btn-primary">Arqueo de Caja</a>

  </div>
@stop

@section('javascript')

@stop