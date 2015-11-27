@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte de asignación
@stop

@section('content')
{!!Form::open(array('url' => 'admin/report/assignment', 'id'=>'form','class'=>'form-horizontal'))!!}
    <div class="col-sm-2">
        <label>Punto de venta</label>
        <hr style="margin:5px;">
        <p>{!!Form::text('name', null ,['class'=>'form-control', 'id'=>'search','placeholder' => 'Nombre del punto'])!!}</p>
    </div>
    <div class="col-sm-4">
        <label>Rango de Fechas de Asignación</label>
        <hr style="margin:5px;">
        <div class="col-sm-6">
            <label>Desde</label>
            {!!Form::input('date','firstDate', null ,['class'=>'form-control','id'=>'fecha-ini'])!!}
        </div>
        <div class="col-sm-6">
            <label>Hasta</label>
            {!!Form::input('date','lastDate', null ,['class'=>'form-control','id'=>'fecha-fin'])!!}
        </div>
    </div>
    <div class="col-sm-4">
        <label>Rango de Fechas de Desasociación</label>
        <hr style="margin:5px;">
        <div class="col-sm-6">
            <label>Desde</label>
            {!!Form::input('date','firstDateP', null ,['class'=>'form-control','id'=>'fecha-ini-des'])!!}
        </div>
        <div class="col-sm-6">
            <label>Hasta</label>
            {!!Form::input('date','lastDateP', null ,['class'=>'form-control','id'=>'fecha-fin-des'])!!}
        </div>
    </div>
    <div class="col-sm-2">
        <p><button class="btn btn-info" type="button" id = 'botoncito' >Buscar</button></p>
    </div>
    <div class="col-sm-12">

    <hr>

    <table class="table table-bordered table-striped" id="example">
        <tr>
            <th>Punto de Venta</th>
            <th>Nombres y Apellidos</th>
            <th>Fecha de Asignación</th>
            <th>Fecha de Desasociación</th>

        </tr>
        <tbody id="fbody">
        @foreach($assiInformation as $assig)
        <tr>
            <td>{{$assig[0]}}</td>
            <td>{{$assig[1]}} {{$assig[2]}}</td>
            <td>{{$assig[3]}}</td>
            <td>{{$assig[4]}}</td>

        </tr>
        @endforeach
      </tbody>
    </table>

    <p><button type="submit" class="btn btn-info">Descargar Archivo Excel</button></p>

</div>
 {!!Form::close()!!}
@stop

@section('javascript')

<script>
$("#botoncito").click(function () {

    var rows = $("#fbody").find("tr").hide();
    var name = document.getElementById("search");
    var data = name.value;
    var search = data.toString().toLowerCase();
    var date1 = document.getElementById("fecha-ini");
    var date2 = document.getElementById("fecha-fin");
    var date3 = document.getElementById("fecha-ini-des");
    var date4 = document.getElementById("fecha-fin-des");
    var dateS1 = date1.value.toString();
    var dateS2 = date2.value.toString();
    var dateS3 = date3.value.toString();
    var dateS4 = date4.value.toString();
    var d1 = new Date(dateS1);
    var d2 = new Date(dateS2);
    d2.setDate(d2.getDate()+1)
    var d3 = new Date(dateS3);
    var d4 = new Date(dateS4);
    d4.setDate(d4.getDate()+1)

    if(search==null || search == ''){
        //alert('23/11/1993'.split("/").reverse().join("-"));
        if(dateS1=='' && dateS2=='' && dateS3 =='' && dateS4==''){
            rows.show();
           // alert('vacio D:');
        }
        if(dateS1!='' && dateS2=='' && dateS3 == '' && dateS4 == ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(3)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d1){
                    $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2!='' && dateS3 == '' && dateS4 == ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(3)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl<=d2){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 == ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(3)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl >=d1 && dtabl<=d2){
                    $this.show();
                }
            });
        }

        if(dateS1=='' && dateS2=='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(4)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d3){
                    $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2=='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(4)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl<=d4){
                    $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(4)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d3 && dtabl<=d4){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2=='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1>=d1 && dtabl2 >= d3){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2=='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1>=d1 && dtabl2<=d4){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1>=d1 && dtabl2 >= d3 && dtabl2<=d4){
                    $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2 !='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1<=d2 && dtabl2 >= d3){
                    $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2!='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1<=d2 && dtabl2<=d4){
                    $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1<=d2 && dtabl2 >= d3 && dtabl2<=d4){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1 >= d1 && dtabl1<=d2 && dtabl2 >= d3 ){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1 >= d1 && dtabl1<=d2 && dtabl2 <= d4 ){
                    $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1 >= d1 && dtabl1<=d2 && dtabl2 >= d3  && dtabl2 <= d4 ){
                    $this.show();
                }
            });
        }


    }
    else{

        if(dateS1=='' && dateS2=='' && dateS3 == '' && dateS4 == ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
            });
        }
        /*
        if((dateS1!='' && dateS2=='') || (dateS1=='' && dateS2!='')){
            //alert('Ingrese un rango de fechas');
            dateS1=='' ? $("#fecha-ini").prop('required',true) : $("#fecha-fin").prop('required',true);
        }
        */
        if(dateS1!='' && dateS2=='' && dateS3 == '' && dateS4 == ''){
            /*
            alert('Ingrese un rango de fechas');
            dateS1=='' ? $("#fecha-ini").prop('required',true) : $("#fecha-fin").prop('required',true);
            */
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(3)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d1){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }

        if(dateS1=='' && dateS2!='' && dateS3 == '' && dateS4 == ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(3)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl<=d2){
                   $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 == ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(3)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d1 && dtabl<=d2){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2=='' && dateS3 != '' && dateS4 == ''){
            /*
            alert('Ingrese un rango de fechas');
            dateS1=='' ? $("#fecha-ini").prop('required',true) : $("#fecha-fin").prop('required',true);
            */
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(4)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d3){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }

        if(dateS1=='' && dateS2=='' && dateS3 == '' && dateS4 != ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(4)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl<=d4){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(4)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d3 && dtabl<=d4){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2=='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1>=d1 && dtabl2 >= d3){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2=='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1>=d1 && dtabl2<=d4){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1>=d1 && dtabl2 >= d3 && dtabl2<=d4){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2 !='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1<=d2 && dtabl2 >= d3){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2!='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1<=d2 && dtabl2<=d4){
                   $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1=='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1<=d2 && dtabl2 >= d3 && dtabl2<=d4){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1 >= d1 && dtabl1<=d2 && dtabl2 >= d3 ){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1 >= d1 && dtabl1<=d2 && dtabl2 <= d4 ){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST1= $this.find(':nth-child(3)').text();
                var dtabl1 = new Date(dateST1.split("/").reverse().join("-"));
                var dateST2= $this.find(':nth-child(4)').text();
                var dtabl2 = new Date(dateST2.split("/").reverse().join("-"));
                if(dtabl1 >= d1 && dtabl1<=d2 && dtabl2 >= d3  && dtabl2 <= d4 ){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                }
            });
        }

    }


});
</script>

@stop