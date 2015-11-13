@extends('layout.promoter')

@section('style')

@stop

@section('title') Autorizar modulos para devoluciones
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        Detalles de la
        <code>{{$cancelled->id}}</code>
        <legend>Autorizados</legend>
        <ul>
            @foreach($authorized as $mod)
            <li>{{$mod->module_id}}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-6">
        <form class="form-horizontal" method="post">
        {!!Form::open(array('id'=>'form','class'=>'form-horizontal'))!!}
            <div class="form-group">
                <label  class="col-sm-2 control-label">Módulos</label>
                <div class="col-sm-10">
                    @foreach($modules as $module)
                    <input tabindex="1" type="checkbox" name="modules[]" value="{{$module->id}}">{{$module->name}}</input><br>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button  type="submit" class="btn btn-info" href="#" >Autorizar modulos</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
@stop