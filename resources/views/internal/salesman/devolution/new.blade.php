@extends('layout.salesman')

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
      <legend>Ticket</legend>
      <p><b>Id:</b>: <span id="ticket_code"></span></p>
      <p><b>Precio total:</b>: S/ <span id="ticket_total_price"></span></p>
      <p><b>Descuento:</b>: S/ <span id="ticket_discount"></span></p>
      <p><b>Cantidad:</b>: <span id="ticket_quantity"></span></p>
      <p><b>Canceled:</b>: <span id="ticket_cancelled"></span></p>
      <legend>Presentación</legend>
      <p><b>Fecha</b>: <span id="presentation_date"></span></p>
      <p><b>Cancelado</b>: <span id="presentation_cancelled"></span></p>
      <p><b>Evento</b>: <span id="presentation_event"></span></p>
      <legend>Cliente</legend>
      <p><b>Full Name</b>: <span id="client_name"></span></p>
      <p><b>DI</b>: <span id="client_di"></span></p>
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
        $.getJSON(url_base+"/salesman/ticket/"+ticket_id+"/tojson", function(data)
        {
          if (data.cancelled == "1")
            alert("El ticket ya fue devuelto");
          $("#ticket_code").text(data.ticket_id);
          $("#ticket_total_price").text(data.total_price);
          $("#ticket_discount").text(data.discount);
          $("#ticket_quantity").text(data.quantity);
          $("#ticket_cancelled").text(data.cancelled);

          $("#presentation_date").text(data.presentation_date);
          $("#presentation_cancelled").text(data.presentation_cancelled);
          $("#presentation_event").text(data.presentation_event);

          $("#client_name").text(data.client_name);
          $("#client_di").text(data.client_di);

        }).fail(function(jqXHR) {
            if (jqXHR.status == 404) {
                $("#ticket").html("<div class='alert alert-danger'>Ticket no encontrado</div>");
            }
        });

    });
});
</script>
@stop