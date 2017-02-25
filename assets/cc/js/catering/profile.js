$(document).ready(function(){
	$(document).on('change', '[name="bill"]', function() {
		var val = $(this).val();
		$('[name="bill"]').prop('checked', false);
		$(this).prop('checked', true);
		if(val == 1) {
			$('#billing_data').prop('disabled', false);
		} else {
			$('#billing_data').prop('disabled', true);
			$('#billing_data').val('');
		}
	})
})