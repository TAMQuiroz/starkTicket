@extends('layout.promoter')

@section('style')
@stop

@section('title')
    {{$event->name}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        @if($event->cancelled)<p><b>Estado: Cancelado</b></p> @else <p><b>Estado: Vigente</b></p> @endif
        <p><b>Código:</b>  {{$event->id}} </p>
        <p><b>Organizado por:</b> {{$event->organization->organizerName}} {{$event->organization->organizerLastName}}</p>
        <p><b>Comisión:</b> {{$event->percentage_comission}} % </p>
        <p><b>Descripción:</b>  {{$event->description}} </p>
        <p><b>Local:</b> {{$event->place->name}} </p>
        <p><b>Categoria:</b> {{$event->category->name}} </p>

        <p><b>Fecha Creación:</b> {{date_format(date_create($event->created_at),"d/m/Y")}}</p>
        <p><b>Fecha Publicación:</b> {{date("d/m/Y",$event->publication_date)}}</p>
        <p><b>Fecha Inicio ventas:</b> {{date("d/m/Y",$event->selling_date)}}</p>
        <p><b>Duracion función:</b> {{$event->time_length}} hora(s) </p>
        <hr>

        <p><b>Tickets vendidos: </b> {{$event->numberTickets()}}</p>
        <p><b>Total ventas: </b> s/ {{$event->amountAccumulated()}}</p>
        <p><a  type="reset" class="btn btn-info" href="javascript:window.history.back();">Volver</a></p>
    </div>
    <div class="col-sm-6">
        <legend>Entradas</legend>
        <ul>
        @foreach ($event->zones as $zone)
          <li>
              {{$zone->name}} : S/. {{$zone->price}}
          </li>
        @endforeach
        </ul>
        <legend>Funciones</legend>
        <ul>
        @foreach ($event->presentations as $present)
            <li>
                Función: {{date("d/m/Y",$present->starts_at)}} {{date('h:i:s',$present->starts_at)}}
            </li>
        @endforeach
        </ul>
        <hr>


        {!! Html::image($event->image, null, array('class'=>'img-thumbnail')) !!}


    </div>
</div>
@stop
