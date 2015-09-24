@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Historial de eventos
@stop

@section('content')
  <div class="rangoFechas">
      <label for="from">Inicio</label>
      <input type="date" id="from" name="from">
      <label for="to">Fin</label>
      <input type="date" id="to" name="to">
      <td><a href="#" class="btn btn-primary">Buscar</a></td>
  </div>
  <!-- Contenido-->
  <hr>
  <h2>Historial de Eventos</h2>
      <table class="table table-bordered table-striped">
        <tr>
          <th>Código de Evento</th>
          <th>Nombre de Evento</th>
          <th>Fecha Inicio</th>
          <th>Fecha Fin</th>
          <th>Estado</th>
          <th>Entradas Vendidas</th>
          <th>Monto Acumulado</th>
          <th></td>

        </tr>

        <tr>
          <td>00001</td>
          <td>Nubeluz Reencuentro</td>
          <td>19/09/2015</td>
          <td>25/10/2015</td>
          <td>Vigente</td>
          <td>1500</td>
          <td>17500.00</td>
          <td><a href="#" class="btn btn-primary">Detalle</a></td>
        </tr>

        <tr>
          <td>00002</td>
          <td>Kiko y la Chili</td>
          <td>20/09/2015</td>
          <td>25/10/2015</td>
          <td>Vigente</td>
          <td>1000</td>
          <td>8300.00</td>
          <td><a href="#" class="btn btn-primary">Detalle</a></td>
        </tr>

        <tr>
          <td>00005</td>
          <td>La banda de Pepito</td>
          <td>20/09/2015</td>
          <td>20/09/2015</td>
          <td>Finalizado</td>
          <td>750</td>
          <td>4300.00</td>
          <td><a href="#" class="btn btn-primary">Detalle</a></td>
        </tr>
        <tr>
          <td>00006</td>
          <td>Visita a Marte</td>
          <td>29/09/2015</td>
          <td>29/09/2015</td>
          <td>Vigente</td>
          <td>100</td>
          <td>50000.00</td>
          <td><a href="#" class="btn btn-primary">Detalle</a></td>
        </tr>
        <tr>
          <td>00007</td>
          <td>Fatmagul el Musical en 2D</td>
          <td>26/10/2015</td>
          <td>02/12/2015</td>
          <td>Cancelado</td>
          <td>30</td>
          <td>1000.00</td>
          <td><a href="#" class="btn btn-primary">Detalle</a></td>
        </tr>

      </table>
      <nav>
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
@stop

@section('javascript')

@stop