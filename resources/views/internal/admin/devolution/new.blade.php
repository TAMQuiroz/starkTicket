@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva devolucion de ticket
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        {!!Form::open(array('id'=>'form','class'=>'form-horizontal'))!!}
          <div class="form-group">
            <label for="ticket_id" class="col-sm-2 control-label">Ticket</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ticket_id" placeholder="">
              <span class="help-block small">Ingrese código de ticket.</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button class="btn btn-info">Guardar</button>
              <button type="reset" class="btn btn-info">Cancelar</button>
            </div>
          </div>
        </form>
    </div>
    <div class="col-sm-6">
        <div id="ticket">
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    url_base = "{{ url('/') }}";
    $("#ticket_id").change(function(){
        ticket_id = $("#ticket_id").val();

        $.getJSON(url_base+"/admin/ticket/"+ticket_id+"/tojson", function(data)
        {
            $("#ticket").val(data);
        }).fail(function(jqXHR) {
            if (jqXHR.status == 404) {
                $("#ticket").html("<div class='alert alert-danger'>Ticket no encontrado</div>");
            }
        });

    });
});
</script>
@stop