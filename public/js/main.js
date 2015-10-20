$('#creditCardPay').change(function() {

	if($('#creditCardPay').is(":checked")){
		console.log('true');
		$('#creditCardNumber').prop('disabled',false);
		$('#expirationDate').prop('disabled',false);
		$('#securityCode').prop('disabled',false);
		$('#payment').prop('disabled',false);
	}else{
		console.log('false');
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