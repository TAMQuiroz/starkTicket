var change = 0;

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

function getInnerText(element) {
    var text = element.options[element.selectedIndex].text;
    document.getElementById("funcion").innerHTML = text;
}

function getEventAvailable(element){
    $.ajax({
        url: config.routes[2].event_available,
        type: 'get',
        data: 
        { 
            id: element.options[element.selectedIndex].value
        },
        success: function( response ){
            if(response != "")
            {
                $('#available').val(response);
            }else{
                console.log('no respuesta');  
            }
        },
        error: function( response ){
            console.log(response);
        }
    });
}

function getSlots(element){
    $.ajax({
        url: config.routes[3].slots,
        type: 'get',
        data: 
        { 
            id: element.options[element.selectedIndex].value
        },
        success: function( response ){
            
            if(response != "")
            {
                var options = '';
                for (x in response) options += '<option value="' + response[x] + '">' + response[x] + '</option>';
                $('#seats').html(options);
            }else{
                console.log('no respuesta');  
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