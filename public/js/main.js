$('#creditCardPay').change(function() {

	if($('#creditCardPay').is(":checked")){
		//console.log('true');
		$('#creditCardNumber').prop('disabled',false);
		$('#expirationDate').prop('disabled',false);
		$('#securityCode').prop('disabled',false);
		$('#payment').prop('disabled',false);
	}else{
		//console.log('false');
		$('#creditCardNumber').prop('disabled',true);
		$('#expirationDate').prop('disabled',true);
		$('#securityCode').prop('disabled',true);
		$('#payment').prop('disabled',true);
	}

});

$('#cashPay').change(function(){
	if ($('#cashPay').is(":checked")) {
		console.log('true');
		$('#amount').prop('disabled',false);
	}else{
		$('#amount').prop('disabled',true);
	}
});	

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