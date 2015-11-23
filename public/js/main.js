var change = 0;
var price = 0;
var discount = 0;

$('document').ready(function () {
    getAvailable();
    getSlots();
    //getPromo();
    getPrice();
})

function cleanForm() {
    $('#payment').val(0);
    $('#amount').val(0);
    $('#amountIn').val(0);
    $('#amountInDollars').val(0);
    $('#amountMix').val(0);
    $('#paymentMix').val(0);
    $('#change').val(0);
    $('#changeDollars').val(0);
    $('#changeMix').val(0);
}

$('#creditCardPay').change(function() {
	if($('#creditCardPay').is(":checked")){
	    $('#creditCardNumber').prop('disabled',false);
		$('#expirationDate').prop('disabled',false);
		$('#securityCode').prop('disabled',false);
        $('#amountIn').prop('disabled',true);
        $('#amountInDollars').prop('disabled',true);
        $('#pay').prop('disabled',false);
        $('#dolares').prop('disabled',true);
        $('#soles').prop('disabled',true);
        $('#amountCredit').prop('disabled',true);
        $('#paymentMix').prop('disabled',true);
        $('#amountMix').prop('disabled',true);
        cleanForm()
    }
});

$('#cashPay').change(function(){
	if ($('#cashPay').is(":checked")) {
        //$('#amountIn').prop('disabled',false);

        $('#dolares').prop('disabled',false);
        $('#soles').prop('disabled',false);

        $('#creditCardNumber').prop('disabled',true);
        $('#expirationDate').prop('disabled',true);
        $('#securityCode').prop('disabled',true);
        $('#amountInDollars').prop('disabled',true);
        $('#pay').prop('disabled',true);
        $('#amountCredit').prop('disabled',true);
        $('#payment').prop('disabled',true);
        $('#paymentMix').prop('disabled',true);
        $('#amountMix').prop('disabled',true);
        cleanForm()
	}
});
$('input[name="currency"]').change(function(){
    if ($('#soles').is(":checked")) {
        cleanForm();
        $('#pay').prop('disabled',true);
        $('#amountIn').prop('disabled',false);
        $('#amountInDollars').prop('disabled',true);
    }else if ($('#dolares').is(":checked")) {
        cleanForm();
        $('#pay').prop('disabled',true);
        $('#amountInDollars').prop('disabled',false);
        $('#amountIn').prop('disabled',true);
    }
});

$('#mixPay').change(function(){
    if ($('#mixPay').is(":checked")) {
        $('#amountIn').prop('disabled',true);
        $('#amountInDollars').prop('disabled',true);
        $('#dolares').prop('disabled',true);
        $('#soles').prop('disabled',true);
        $('#creditCardNumber').prop('disabled',false);
        $('#expirationDate').prop('disabled',false);
        $('#securityCode').prop('disabled',false);
        $('#paymentMix').prop('disabled',false);
        $('#amountMix').prop('disabled',true);
        $('#pay').prop('disabled',true);
        cleanForm()
    }
});

$('#amountMix').change(function(){
    var total= $('#paymentMix').val();
    var amount = $(this).val();
    if($(this).val() != "" && $(this).val() != 0){
        if(parseInt(amount,10) < parseInt(total,10)){
            $('#changeMix').val('Falta dinero');
            $('#pay').prop('disabled',true);
        }else{
            $('#changeMix').val($(this).val() - $('#paymentMix').val());
            $('#pay').prop('disabled',false);
        }
    }else{
        $('#changeMix').val('Ingresar un valor a pagar');
        $('#pay').prop('disabled',true);
    }
});

$('#paymentMix').change(function(){
    if($(this).val() != "" && $(this).val() != 0){
       $('#amountMix').prop('disabled',false);
    }else{
        $('#changeMix').val('Ingresar un valor a pagar');
        $('#pay').prop('disabled',true);
        $('#amountMix').prop('disabled',true);
    }
});

$('#amountCredit').change(function(){
    if($(this).val() != "" && $(this).val() != 0){
        $('#amountIn').prop('disabled',false);
    }else{
        $('#change').val('Ingresar un valor a pagar');
        $('#pay').prop('disabled',true);
    }
});

$('#amountIn').change(function(){
    var total= $('#total2').val();
    var amount = $(this).val();
    if($(this).val() != "" && $(this).val() != 0){
        if(parseInt(amount,10) < parseInt(total,10)){
            $('#change').val('Falta dinero');
            $('#pay').prop('disabled',true);
        }else{
            $('#change').val(parseInt(amount,10) - parseInt(total,10));
            $('#pay').prop('disabled',false);
        }
    }else{
        $('#change').val('Ingresar un valor a pagar');
        $('#pay').prop('disabled',true);
    }
});

$('#amountInDollars').change(function(){
    var total= $('#total2').val();
    var amount = $(this).val();
    if($(this).val() != "" && $(this).val() != 0){
        if(parseInt(amount,10) < parseInt(total,10)){
            $('#changeDollars').val('Falta dinero');
            $('#pay').prop('disabled',true);
        }else{
            $('#changeDollars').val(parseInt(amount,10) - parseInt(total,10));
            $('#pay').prop('disabled',false);
        }
    }else{
        $('#changeDollars').val('Ingresar un valor a pagar');
        $('#pay').prop('disabled',true);
    }
});

$('#quantity').change(function(){
    count = $(this).val();
    if($(this).val() > 0){
        $('#payModal').prop('disabled',false);
        $('#total2').val(count*price);
    }else{
        $('#payModal').prop('disabled',true);
        $('#total2').val("");
    }
});

function getPromo(){
    //console.log("promo");
    $.ajax({
        url: config.routes[6].promo,
        type: 'get',
        data: 
        { 
            quantity: $('#quantity').val(),
            event_id: $('#event_id').val(),
            zone_id: $('#zone_id').val(),
            type_id: $('input[name="payMode"]:checked').val(),
        },
        success: function( response ){
            //console.log(response);
            //console.log("exito");
            if (response != ""){
                $('#promotion_id').val(response.id);
                $('#total2').val(response.amount);
                
            }else{
                getPrice();
                $('#promotion_id').val("");
                $('#total2').val($('#quantity').val()*price);
            }
        },
        error: function( response ){
            console.log("failure :c");
            console.log(response);
        }
    });
}

function addQuantity() {
    count = $('#seats option:selected').length;
    $('#quantity').val(count);
    if(count == 0){
        $('#payModal').prop('disabled',true);
        $('#total2').val("");
    }else{
        $('#payModal').prop('disabled',false);
        $('#total2').val(count*price);
    }
}  

function resetPay(){
    $('#quantity').val(0);
    $('#payModal').prop('disabled',true);
    $('#total2').val("");
}

function getPrice(){
    $.ajax({
        url: config.routes[1].price_ajax,
        type: 'get',
        data: 
        { 
            id: $('#zone_id').val(),
        },
        success: function( response ){
            //console.log(response);
            if(response != "")
            {
                //console.log(response.price);
                price = response.price;
            }
            else
            {
                console.log('no respuesta precio');  
                price = 0; 
            }
            //console.log(price);
        },
        error: function( response ){
            
        }
    });
} 

function getAvailable(){

    funcion = $('#pres_selection').val();
    zona = $('#zone_id').val();
    evento = $('#event_id').val();
    $.ajax({
        url: config.routes[2].event_available,
        type: 'get',
        data: 
        { 
            event_id: evento,
            function_id: funcion,
            zone_id: zona,
        },
        success: function( response ){
            //console.log(response);
            if(response != "")
            {
                $('#available').val(response);
                $('#quantity').prop('max',response);
            }else{
                console.log(response);  
            }
        },
        error: function( response ){
            console.log(response);
        }
    });
}

function getSlots(){
    

    funcion = $('#pres_selection').val();
    zona = $('#zone_id').val();
    evento = $('#event_id').val();
    $.ajax({
        url: config.routes[3].slots,
        type: 'get',
        data: 
        { 
            event_id: evento,
            function_id: funcion,
            zone_id: zona,

        },
        success: function( response ){
            if(response != "")
            {
                var options = '';
                for (x in response)
                { 
                    //console.log(x);
                    options += '<option value="' + x + '">' + response[x] + '</option>';
                }
                $('#seats').html(options);
            }else{
                //console.log('no respuesta slots');  
            }
        },
        error: function( response ){
            console.log(response);
        }
    });
}

$('#user_di').focusout( function() {
    $.ajax({
        url: config.routes[0].zone,
        type: 'get',
        data: 
        { 
            id: $('#user_di').val()
        },
        success: function( response ){
            //console.log(response);
            if(response != "")
            {
                $('#user_name').val(response.name+" "+response.lastname);
                $('#user_id').val(response.id);
            }
            else
            {
                $('#user_name').val('No existe ese cliente');
                $('#user_di').val("");
                $('#user_id').val(0);
            }
        },
        error: function( response ){
            
        }
    });
});


function getReserves(){
    $('#li-uno').remove();
    $('#erroresp').hide();
    dni = $('#dni_recojo').val();
    $.ajax({
        url: config.routes[0].reserve,
        type: 'get',
        data: 
        { 
            dni: dni
        },
        success: function( response ){
            if(response != "")
            {
                var options = '';
                $.each(response,function(key,value)
                { 
                    options += '<tr><td>'+value.codigo+'</td><td>'
                    +value.nombre+'</td><td>'+value.funcion+'</td><td>'
                    +value.zona+'</td><td>'+value.cantidad+'</td><td>'
                    +'<input type="radio" class="radio pay" name="reserve_code" value="'+ value.codigo+'" required>'+"</td></tr>";
                });
                $('#tbody_reserve').html(options);
            }else{
                console.log('no respuesta reserva');  
            }
        },
        error: function( response ){
            $('#erroresp').append('<li id=li-uno>'+response.responseText+'</li>');
            $('#erroresp').show();
        }
    });
}

$('#salesman_di').focusout( function() {
    $.ajax({
        url: config.routes[0].salesman,
        type: 'get',
        data: 
        { 
            id: $('#salesman_di').val()
        },
        success: function( response ){
            //console.log(response);
            if(response != "")
            {
                if (response.role_id == 2){
                   $('#salesman_name').val(response.name+" "+response.lastname);
                    $('#salesman_id').val(response.id); 
                }
                else{
                     $('#salesman_name').val('Este no es un vendedor');
                    $('#salesman_di').val("");
                    $('#salesman_id').val(0);
                }
                
            }
            else
            {
                $('#salesman_name').val('No existe ese vendedor');
                $('#salesman_di').val("");
                $('#salesman_id').val(0);
            }
        },
        error: function( response ){
            
        }
    });
});
