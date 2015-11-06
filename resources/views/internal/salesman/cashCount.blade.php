@extends('layout.salesman')

@section('style')

<style type="text/css">
  #demo3{
    visibility:'hidden';

  }
</style>

<script>
  function myFunction () {
    // body...
      document.getElementById("demo3").style.visibility = 'visible';
  }
</script>
@stop




@section('title')
	Arqueo de Caja
@stop

@section('content')
  <!-- Contenido-->
  <br>
  <div class="row">
    <div class="col-sm-10">
      {!!Form::open(array('url' => 'salesman/cash_count','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Nuevo Monto Inicial</label>
        <div class="col-sm-3">
          {!!Form::number('cash', $cashFirst ,['class'=>'form-control','id'=>'cash', 'min'>=0])!!}
          {!! Form::hidden('cash_val', null, ['cash'=>'cash_val'])!!}
        </div>
        <div class="col-sm-2">
          <a  class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Modificar Monto</a>
        </div>
        <label for="inputEmail3" class="col-sm-4 control-label">Monto Inicial Actual: {{$cashFirst}}</label>

      </div>
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea Modificar el Monto Inicial de la caja?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button href="{{action('BusinessController@updateCash')}}"  id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      {!!Form::close()!!}
    </div>
   <!-- 
    <div class="col-md-2">
      <h4>Nuevo Monto Inicial:</h4>
    </div>
   <div class="col-md-4">
      {!! Form::text('initial', '', array('class' => 'form-control')) !!} 
    </div>
    <div class="col-md-2"> <button type="button" class="btn btn-info" onclick="myFunction()" data-toggle="collapse" data-target="#demo2" >Agregar Monto</button> </div>
    <div class="col-md-4">  
      <div>
        <h4 id="demo3" style="visibility:hidden"> Monto Inicial: 1000.00</h4>
      </div>
    </div>
    <div class="col-md-2"> <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2" >Modificar Monto</button> </div>
    <div class="col-md-4">  
      <div>
        <h4 id="demo3"> Monto Inicial Actual: {{$cashFirst}} </h4>
      </div>
    </div> -->
  </div>
  <h2>Ventas</h2>   
    <table class="table table-bordered table-striped">
      
      <tr>
        <th>Nombre Cliente</th>
        <th>Nombre del Evento</th>
        <th>Tipo de Zona</th>
        <th>Función</th>
        <th>Cantidad de Entradas</th>
        <th>Precio Individual</th>
        <th>Sub total</th>
      </tr>
      <!--
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
      </tr> -->
      
      @foreach($sales as $sale)
      <tr>
        <td>{{$sale->clientName}} {{$sale->clientLast}}</td>
        <td>{{$sale->eventName}}</td>
        <td>{{$sale->zoneName}}</td>
        <td>{{date("d/m/Y H:i",$sale->funtionTime)}}</td>
        <td>{{$sale->totalTicket}}</td>
        <td>{{$sale->zonePrice}}</td>
        <td>{{$sale->subtotal}}</td>
      </tr>
      @endforeach
    


      <tr>
        <!--<th scope="row">TOTAL</th>-->

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>TOTAL<strong></td>
        <td>{{$sumSale}}</td>
      </tr>
    </table>

    <h2>Devoluciones</h2>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Nombre Cliente</th>
        <th>Nombre del Evento</th>
        <th>Tipo de Zona</th>
        <th>Función</th>
        <th>Cantidad de Entradas</th>
        <th>Precio Individual</th>
        <th>Sub total</th>
      </tr>
      @foreach($refunds as $refund)
      <tr>
        <td>{{$refund->clientName}} {{$refund->clientLast}}</td>
        <td>{{$refund->eventName}}</td>
        <td>{{$refund->zoneName}}</td>
        <td>{{date("d/m/Y H:i",$refund->funtionTime)}}</td>
        <td>{{$refund->totalTicket}}</td>
        <td>{{$refund->zonePrice}}</td>
        <td>{{$refund->subtotal}}</td>
      </tr>
      @endforeach
      <!--
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
      -->
      <tr>
        <!--<th scope="row">TOTAL</th>-->

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>TOTAL<strong></td>
        <td>{{$sumRefound}}</td>
      </tr>
    </table>
    <br>
    <h2>Resultado Final del Día</h2>
    <br>
    <div class="row">
      <div class="col-sm-12">
        {!!Form::open(array('url' => 'salesman/cash_count','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Total del día</label>
          <div class="col-sm-3">
            {!!Form::input('number','cash', $sumTotal,['class'=>'form-control','id'=>'total','readonly'])!!}
            {!! Form::hidden('cash_val', null, ['cash'=>'cash_val'])!!}
          </div>
          <div class="col-sm-6">
            <a  class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#info" >Arquear Caja</a>
          </div>

        </div>
        <div class="modal fade"  id="info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que desea Arquear la caja?</h4>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                  <button  href="{{action('BusinessController@updateCash')}}" id="yes" type="submit" class="btn btn-info">Si</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {!!Form::close()!!}
      </div>
    </div>

    <!--
    <div class="row">
      <div class="col-md-8"></div>
      <div class="col-md-4">
           <h2 class="totalType">Total del Día: <strong>{{$sumTotal}}</strong></h2>
           <button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo">Arqueo de Caja</button>


    </div>

     <div id="info" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        
                        <div class="modal-content">
                          <div class="modal-body">
                            <h2>Mensaje del Sistema</h2>
                            <h3>El Arqueo ha sido todo un exito. Ya puede Cerrar la caja</h3>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
      </div>
    -->

@stop

@section('javascript')

@stop