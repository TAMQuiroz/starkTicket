@extends('layout.admin')

@section('style')

@stop

@section('title')
	Tipo de cambio
@stop

@section('content')
{!!Form::open(array('url' => 'admin/config/exchange_rate','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
    <div class="col-sm-4">
        <label for="buyingRate" class="control-label">Nuevo tipo de Cambio: Compra</label>
        {!!Form::input('text','buyingRate', null ,['class'=>'form-control','id'=>'buyingRate','required','min' >0])!!}
    </div>
    <div class="col-sm-4">
        <label for="sellingRate" class="control-label">Nuevo tipo de Cambio: Venta</label>
        {!!Form::input('text','sellingRate', null ,['class'=>'form-control','id'=>'sellingRate','required','min' >0])!!}
    </div>
    <div class="col-sm-4">
        <br>
        <p><a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Modificar Tipo Cambio</a></p>
        <div class="modal fade"  id="submitModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que Modificar el Tipo de Cambio </h4>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                  <button id="yes" type="submit" class="btn btn-info">Si</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    {!!Form::close()!!}
    <div class="col-sm-12">
        <hr>
        <h3>Ultimos tipos de cambio</h3>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
          </tr>
          @foreach($exchangeRates as $exchangeRate)
          <tr>
            <td>{{$exchangeRate->buyingRate}}</td>
            <td>{{$exchangeRate->sellingRate}}</td>
            <td>{{$exchangeRate->startDate}}</td>
            <td>{{$exchangeRate->finishDate}}</td>
          </tr>
          @endforeach
        </table>
    </div>
    {!!$exchangeRates->render()!!}
@stop

@section('javascript')

@stop