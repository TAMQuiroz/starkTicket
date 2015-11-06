@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Historial de pagos
@stop

@section('content')


<!-- Contenido-->
  <!--div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Fecha inicio</label>
                    <div class="col-sm-10">
                        {!! Form::date('dateIni','', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Fecha fin</label>
                    <div class="col-sm-10">
                        {!! Form::date('dateEnd','', array('class' => 'form-control')) !!}
                    </div>
                </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">Organizador</label>
                  <div class="col-sm-10">
                    {!! Form::select('organizer', ['Pepitos Producciones','Rayo en la botella','Hermanos yaipen'],null,['class' => 'form-control']) !!}
                  </div>
              </div>
                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info">Buscar</a>
                    </div>
                </div>
            </form>
          </div>
  </div-->

      <table class="table table-bordered table-striped">
        <tr>
          <th>Evento</th>
          <th>Organizdor</th>
          <th>Promotor</th>
          <th>Fecha</th>
          <th>Monto pagado</th>
          <th>Detalles</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
          <td>{{$payment->event["name"]}}</td>
          <td>{{$payment->event->organization["organizerName"]}} {{$payment->event->organization["organizerLastName"]}}</td>
          <td><a href="#">{{$payment->promoter["name"]}} {{$payment->promoter["lastname"]}}</a></td>
          <td>{{$payment->date_delivery}}</td>
          <td>S/ {{$payment->paid}}</td>
          <td><a href="{{ url ('promoter/transfer_payments/'.$payment->id  )}}" class="btn btn-primary">+</a></td>
        </tr>
        @endforeach
      </table>
@stop

@section('javascript')

@stop