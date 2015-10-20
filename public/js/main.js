$('#creditCardPay').change(function() {

	if($('#creditCardPay').is(":checked")){
		//console.log('true');
		$('#creditCardNumber').prop('disabled',false);
	}else{
		//console.log('false');
		$('#creditCardNumber').prop('disabled',true);
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