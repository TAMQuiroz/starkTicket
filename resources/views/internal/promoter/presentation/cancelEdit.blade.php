@extends('layout.promoter')

@section('style')

@stop

@section('title') Editar cancelación de presentación
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        {!! Form::model($cancelPresentation, [ 'method' => 'POST','id'=>'forms','class'=>'form-horizontal']) !!}
            <div class="form-group">
                <label  class="col-sm-2 control-label">Devolución:</label>
                <div class="col-sm-10">
                    {!! Form::date('date_refund', date('Y-m-d',$date_refund), ['class' => 'form-control','required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Duración</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        {!! Form::text('duration', null, ['class' => 'form-control','required']) !!}
                        <div class="input-group-addon">Días</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Razón</label>
                <div class="col-sm-10">
                    {!! Form::textarea('reason', null, ['class' => 'form-control','required']) !!}

                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Autorizado?</label>
                <div class="col-sm-10">
                    <select name="authorized" class="form-control">
                        <option value="1" @if($cancelPresentation->authorized) selected @endif>Si</option>
                        <option value="0" @if(!$cancelPresentation->authorized) selected @endif>No</option>
                    </select>
                    <span class="help-block small">Autorizado para devolver entradas?</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button  type="submit" class="btn btn-info" href="#" >Cancelar Evento</button>
                  <a href="{{ url('promoter/presentation/cancelled') }}" class="btn btn-info">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
@stop