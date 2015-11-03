$('document').ready(function () {
    changeNumberedJquery($('input[name="local_type"]:checked'));
});

function changeNumberedJquery(element){
	//console.log(element.val());
	if(element.val() == 1){
		$('#capacity').prop('disabled',true);
		$('#capacity').val('');
		$('#row').prop('disabled',false);
		$('#column').prop('disabled',false);


	}else{
		$('#capacity').prop('disabled',false);
		$('#row').prop('disabled',true);
		$('#column').prop('disabled',true);
		$('#row').val('');
		$('#column').val('');
	}
}

function changeNumbered(element){
	//console.log(element.value);
	if(element.value == 1){
		$('#capacity').prop('disabled',true);
		$('#capacity').val('');
		$('#row').prop('disabled',false);
		$('#column').prop('disabled',false);


	}else{
		$('#capacity').prop('disabled',false);
		$('#row').prop('disabled',true);
		$('#column').prop('disabled',true);
		$('#row').val('');
		$('#column').val('');
	}
}