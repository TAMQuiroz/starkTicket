var change = 0;
var price = 0;

$('document').ready(function () {
    getAvailable();
    getSlots();
})

function cleanForm() {
    $('#payment').val(0);
    $('#amount').val(0);
    $('#amountIn').val(0);
    $('#amountMix').val(0);
    $('#paymentMix').val(0);
    $('#change').val(0);
    $('#changeMix').val(0);
}

$('#creditCardPay').change(function() {
	if($('#creditCardPay').is(":checked")){
	    $('#creditCardNumber').prop('disabled',false);
		$('#expirationDate').prop('disabled',false);
		$('#securityCode').prop('disabled',false);
        $('#amountIn').prop('disabled',true);
        $('#pay').prop('disabled',false);
        $('#amountCredit').prop('disabled',true);
        $('#paymentMix').prop('disabled',true);
        $('#amountMix').prop('disabled',true);
        cleanForm()
    }
});

$('#cashPay').change(function(){
	if ($('#cashPay').is(":checked")) {
        $('#creditCardNumber').prop('disabled',true);
        $('#expirationDate').prop('disabled',true);
        $('#securityCode').prop('disabled',true);
        $('#amountIn').prop('disabled',false);
        $('#pay').prop('disabled',true);
        $('#amountCredit').prop('disabled',true);
        $('#payment').prop('disabled',true);
        $('#paymentMix').prop('disabled',true);
        $('#amountMix').prop('disabled',true);
        cleanForm()
	}
});

$('#mixPay').change(function(){
    if ($('#mixPay').is(":checked")) {
        $('#amountIn').prop('disabled',true);
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
                $('#quantity').val(0);
                $('#payModal').prop('disabled',true);
                $('#total2').val("");
            }
            else
            {
                console.log('no respuesta precio');  
                price = 0; 
            }
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