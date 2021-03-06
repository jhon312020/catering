var discountObject = {};
function applyDiscount() {
	if (discountObject) {
		if (discountObject.detail.discount_type == 'percentage') {
			$('#promo_code_section .row div').append('<span style="color:green;font-weight:bold">El descuento de '+discountObject.detail.price_or_percentage+'%  ha sido aplicado correctamente</span>');
		} else {
			$('#promo_code_section .row div').append('<span style="color:green;font-weight:bold">El descuento de '+discountObject.detail.price_or_percentage+'&euro;  ha sido aplicado correctamente</span>');
		}
		$('#promo_code_section .row .formsection').hide();
		$total_price = discountObject.total_price;
		$('#total_price').text($total_price);
	}
}
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
		if ($('#paid_by_company').val() == 0 && !$('#card').is(':checked') && !$('#draft').is(':checked') && !$('#ticket').is(':checked') && !$('#cash').is(':checked')) {
      $('#jsPaymentType').show();
    } else if(!$('#accept').is(':checked')) {
			$('#jsAcceptTerms').show();
		} else {
			
			loadAndSave.save({'payment_type':paymentSelectedId,'discount':discountObject,'paid_by_company':$('#paid_by_company').val()}, SITE_URL + '/es/checkout').then(function(result){
				if(result.success) {
					if (result.process_type == 'credit') {
						$('#Ds_SignatureVersion').val(result.version);
						$('#Ds_MerchantParameters').val(result.params);
						$('#Ds_Signature').val(result.signature);
						$('#bank_form').attr('action', result.bank_url);
						$('#bank_form').submit();
					} else {
						location.href = result.redirectUrl;
					}
				} else {
					if(result.msg) {
						if(result.menu_ids) {
							$.each(result.order_ids, function(index, id){
								$('tr.order_'+id).remove();
								$('div.order_'+id).remove();
								$total_price = parseFloat($total_price) - parseFloat($price_with_menu_id[id]);
							});
							var $count = $('.paymentTable tbody tr').length;
							$('.jsTotalCart').text($count);
							$('#order_count').text($count);
							$('span#total_price').text($total_price.toFixed(2));
						}
						$('#server_error_response').html(result.msg);
						$('#server_error_response').show();
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
				$('tr.order_'+order_id).remove();
				$('div.order_'+order_id).remove();
				$total_price = parseFloat($total_price) - parseFloat($price_with_menu_id[order_id]);
				var $count = $('.paymentTable tbody tr').length;
				$('.jsTotalCart').text($count);
				$('#order_count').text($count)
				$('span#total_price').text($total_price.toFixed(2));
			}
		});
	});

	$(document).on('click', '#promo_code_apply', function() {
		if ($('#promo_code').val().trim() == '') {
			$('.promocode_error').html('Kindly type the Código Promocional');
			return false;
		} else {
			$('.promocode_error').html('');
		}
		inputs = {'code':$('#promo_code').val().trim(),'total_price':$total_price};
		$.ajax({
			url:SITE_URL+'ajax/getPromoCodeDetail',
			type:'post',
			data:inputs,
			dataType:'json',
			success:function(result){
				if (result.error) {
					$('.promocode_error').html(result.error);
				} else {
					discountObject = result;
					applyDiscount();
				}
			}
		});
	});
});