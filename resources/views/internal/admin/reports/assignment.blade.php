@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte de asignación
@stop

@section('content')
{!!Form::open(array('url' => 'admin/report/assignment', 'id'=>'form','class'=>'form-horizontal'))!!}
    <div class="row">
        <div class="col-sm-3">
            <label>Punto de venta</label>
            <hr style="margin:5px;">
            <p>{!!Form::text('name', null ,['class'=>'form-control', 'id'=>'search','placeholder' => 'Nombre del punto'])!!}</p>
        </div>
        <div class="col-sm-9"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-5">
            <label>Rango de Fechas de Asignación</label>
            <hr style="margin:5px;">
            <div class="col-sm-6">
                <label>Desde</label>
                {!!Form::input('date','firstDate', null ,['class'=>'form-control','id'=>'fecha-ini'])!!}
                  <div class="col-sm-6" id="firefox" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                    
            </div>
            <div class="col-sm-6">
                <label>Hasta</label>
                {!!Form::input('date','lastDate', null ,['class'=>'form-control','id'=>'fecha-fin'])!!}
                  <div class="col-sm-6" id="firefox2" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                    
            </div>
        </div>
        <div class="col-sm-5">
            <label>Rango de Fechas de Desasociación</label>
            <hr style="margin:5px;">
            <div class="col-sm-6">
                <label>Desde</label>
                {!!Form::input('date','firstDateP', null ,['class'=>'form-control','id'=>'fecha-ini-des'])!!}
                  <div class="col-sm-6" id="firefox3" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                 
            </div>
            <div class="col-sm-6">
                <label>Hasta</label>
                {!!Form::input('date','lastDateP', null ,['class'=>'form-control','id'=>'fecha-fin-des'])!!}
                  <div class="col-sm-6" id="firefox4" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                 
            </div>
        </div>
        <div class="col-sm-2">
            <br>
            <p><button class="btn btn-info" type="button" id = 'botoncito' >Buscar</button></p>
        </div>
    </div>  
    <div class="col-sm-12">

        <div class="col-sm-12">
            <div id="error-msg1" style="visibility: hidden"> <p class="alert alert-danger" >Rango de fechas incorrecto</p></div>
            <hr>
        </div>
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
        
        <br>
        <h5>Seleccione el tipo de formato de su reporte</h5>  
        <div class="col-sm-2">
            {!!Form::select('type', [
               '1' => 'Excel',
               '2' => 'PDF'],
               null,
               ['class' => 'form-control']
            )!!}
        </div>

        <div class="col-sm-2">
            <button type="submit" class="btn btn-info">Descargar Archivo</button>
        </div>
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
    d2.setDate(d2.getDate()+1);
    var d3 = new Date(dateS3);
    var d4 = new Date(dateS4);
    d4.setDate(d4.getDate()+1);

    if(search==null || search == ''){
        //alert('23/11/1993'.split("/").reverse().join("-"));
        if(dateS1=='' && dateS2=='' && dateS3 =='' && dateS4==''){
            rows.show();
           // alert('vacio D:');
           document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 == ''){
            if(dateS2>=dateS1){
                $rows = rows;
                $rows.each(function(){
                    var $this = $(this);
                    var dateST= $this.find(':nth-child(3)').text();
                    var dtabl = new Date(dateST.split("/").reverse().join("-"));
                    if(dtabl >=d1 && dtabl<=d2){
                        $this.show();
                    }
                });
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            if(dateS4>=dateS3){
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
            else document.getElementById("error-msg1").style.visibility= "visible";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1!='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS4>=dateS3){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1=='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS4>=dateS3){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            if(dateS2>=dateS1){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else $("#error-msg").show();
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            if(dateS2>=dateS1){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS2>=dateS1 && dateS4>=dateS3){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }


    }
    else{

        if(dateS1=='' && dateS2=='' && dateS3 == '' && dateS4 == ''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
            });
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 == ''){
            //rows.show();
            if(dateS2>=dateS1){
                $rows = rows;
                $rows.each(function(){
                    var $this = $(this);
                    var dateST= $this.find(':nth-child(3)').text();
                    var dtabl = new Date(dateST.split("/").reverse().join("-"));
                    if(dtabl>=d1 && dtabl<=d2){
                        $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                    }
                });
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1=='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS4>=dateS3){
                $rows = rows;
                $rows.each(function(){
                    var $this = $(this);
                    var dateST= $this.find(':nth-child(4)').text();
                    var dtabl = new Date(dateST.split("/").reverse().join("-"));
                    if(dtabl>=d3 && dtabl<=d4){
                        $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                    }
                });
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1!='' && dateS2=='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS4>=dateS3){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
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
            document.getElementById("error-msg1").style.visibility= "hidden";
        }
        if(dateS1=='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS4>=dateS3){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 == ''){
            //rows.show();
            if(dateS2>=dateS1){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }
        if(dateS1!='' && dateS2!='' && dateS3 == '' && dateS4 != ''){
            //rows.show();
            if(dateS2>=dateS1){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }
        if(dateS1!='' && dateS2!='' && dateS3 != '' && dateS4 != ''){
            //rows.show();
            if(dateS2>=dateS1 && dateS4>=dateS3){
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
                document.getElementById("error-msg1").style.visibility= "hidden";
            }
            else document.getElementById("error-msg1").style.visibility= "visible";
        }

    }


});
</script>

<script>
$('document').ready(function () {

  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
    document.getElementById('firefox2').style.visibility='visible';
    document.getElementById('firefox3').style.visibility='visible';
    document.getElementById('firefox4').style.visibility='visible';
  }
})
</script>     

@stop