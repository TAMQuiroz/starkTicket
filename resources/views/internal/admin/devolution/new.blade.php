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
            <label for="ticket_id" class="col-sm-3 control-label">Ticket</label>
            <div class="col-sm-9">
              <input type="numeric" class="form-control" id="ticket_id" placeholder="" name="ticket_id">
              <span class="help-block small">Ingrese código de ticket.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="ticket_id" class="col-sm-3 control-label">Devolver s/ :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="ticket_id" placeholder="" name="repayment">
            </div>
          </div>
          <div class="form-group">
            <label for="ticket_id" class="col-sm-3 control-label">Observaciòn:</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="observation" rows="5">
              </textarea>
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
        ticket_detail = "<b>Detalles de ticket</b>";
        $.getJSON(url_base+"/admin/ticket/"+ticket_id+"/tojson", function(data)
        {
          ticket_detail += "<br>Id : " + data.id;
          ticket_detail += "<br>Cliente id : " + data.owner_id;
          ticket_detail += "<br>Evento id : " + data.event_id;
          ticket_detail += "<br>Precio  : s/" + data.price;
            $("#ticket").html(ticket_detail);
        }).fail(function(jqXHR) {
            if (jqXHR.status == 404) {
                $("#ticket").html("<div class='alert alert-danger'>Ticket no encontrado</div>");
            }
        });

    });
});
</script>
@stop