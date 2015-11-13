@extends('layout.promoter')

@section('style')

@stop

@section('title') Cancelar Presentación
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        <p><b>Detalles de la presentacion</b></p>
        {{$presentation}}

        <p><b>Detalles del evento</b></p>
        {{$presentation->event}}
    </div>
    <div class="col-sm-6">
        <form class="form-horizontal" method="post">
        {!!Form::open(array('id'=>'form','class'=>'form-horizontal'))!!}
            <input name="event_id" value="{{$presentation->id}}" type="hidden" required>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Devolución:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="date_refund" required>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Duración</label>
                <div class="col-sm-10">
                    <input type="numeric" class="form-control" name="duration" required>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Reason</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reason" required>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Autorizado?</label>
                <div class="col-sm-10">
                    <select name="authorized" class="form-control">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <span class="help-block small">Autorizao para devolver entradas .</span>
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