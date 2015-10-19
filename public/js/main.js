$('#creditCardPay').change(function() {

	if($('#creditCardPay').is(":checked")){
		console.log('true');
		$('#creditCardNumber').prop('disabled',false);
	}else{
		console.log('false');
		$('#creditCardNumber').prop('disabled',true);
	}

});

