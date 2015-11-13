@extends('layout.promoter')

@section('style')

@stop

@section('title') Cancelar Evento
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        <p><b>Nombre: </b> {{$event->name}}</p>
        <p><b>Organizador: </b> {{$event->organization["organizerName"]}}</p>
    </div>
    <div class="col-sm-6">
        <form class="form-horizontal" method="post">
        {!!Form::open(array('id'=>'form','class'=>'form-horizontal'))!!}
            <input name="event_id" value="{{$event->id}}" type="hidden">
            <div class="form-group">
                <label  class="col-sm-2 control-label">Devolución:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="date_refund">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Duración</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="duration">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Reason</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reason">
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button  type="submit" class="btn btn-info" href="#" >Cancelar Evento</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
@stop