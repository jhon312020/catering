$(document).ready(function() {
	var paymentSelectedId = '';
	$(".jsPaymentType").click(function() {
			paymentSelectedId = this.id;
		$(".jsPaymentType").each(function() {
			if ( this.id == paymentSelectedId ) {
					this.checked = true;
			} else {
					this.checked = false;
			};        
		});
	});    
	/* This clcik event to confirm the payment for catering purchase*/
	$(document).on('click', '.payButton', function() {
		if(!$('.paymentTable tbody tr').length) {
			alert('Please select atleast one order!');
			return false;
		}
    $('.error').hide();
		if (!$('#card').is(':checked') && !$('#draft').is(':checked') && !$('#ticket').is(':checked')) {
      $('#jsPaymentType').show();
    } else if(!$('#accept').is(':checked')) {
			$('#jsAcceptTerms').show();
		} else {
			
			loadAndSave.save({'payment_type':paymentSelectedId}, SITE_URL + '/es/checkout').then(function(result){
				if(result.success) {
					if (result.process_type == 'credit') {
						$('#Ds_SignatureVersion').val(result.version);
						$('#Ds_MerchantParameters').val(result.params);
						$('#Ds_Signature').val(result.signature);
						$('#bank_form').attr('action', result.bank_url);
						$('#bank_form').submit();
					} else {
						location.href = SITE_URL + '/es/success';
					}
				} else {
					if(result.msg) {
						if(result.menu_ids) {
							$.each(result.order_ids, function(index, id){
								$('tr.order_'+id).remove();
								$total_price = parseFloat($total_price) - parseFloat($price_with_menu_id[id]);
							});
							var $count = $('.paymentTable tbody tr').length;
							$('.jsTotalCart').text($count);
							$('#order_count').text($count)
							$('span#total_price').text($total_price.toFixed(2));
						}
						alert(result.msg);
					}
				}
			});
		}
    //return false;
	});
	
	/* This funcion used to remove the order which is selected by the current login user*/
	$(document).on('click', '.removeOrder', function() {
		var order_id = $(this).data('id');
		var formData = {order_id:order_id};
		var $deleteTr = $(this).closest('tr');
		var url = SITE_URL + '/node/removeOrder';
		loadAndSave.deleteRecord(formData, url).then(function(result){
			if(result.success) {
				$deleteTr.remove();
				$total_price = parseFloat($total_price) - parseFloat($price_with_menu_id[order_id]);
				var $count = $('.paymentTable tbody tr').length;
				$('.jsTotalCart').text($count);
				$('#order_count').text($count)
				$('span#total_price').text($total_price.toFixed(2));
			}
		});
	});
});
