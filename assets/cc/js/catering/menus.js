$(document).ready(function() {
	$('.datepicker12').datepicker({
		format:'dd-mm-yyyy',
		autoclose:true,
		startDate:new Date(),
		daysOfWeekDisabled: [0, 6],
		weekStart:1,
		beforeShowDay:function(dt) {
			return isAvailableDates(dt);
		}
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$('.button-datepicker').offset().top + $('.button-datepicker').height(), left:$('.button-datepicker').offset().left})
	}).on('changeDate', function(e) {
			$('#menuListform').submit();
	});
	$(document).on('click', '.button-datepicker', function(){
		$('.datepicker12').datepicker('show');
	})

	var $menus_total = 0;
	var $cool_drinks_selected = {};
	
	$('.boostrap-multiselect').multiselect({
		includeSelectAllOption: false,
		enableFiltering: false,
		// numberDisplayed: 0,
		nonSelectedText: 'Select drinks',
		onChange: function(option, checked, select) {
			var $mainDiv = $(option).closest('.jsSubMenu');
			var $menu_id = $mainDiv.find('.jsSelectMenu').attr('name').replace ( /[^\d.]/g, '' );
			var opselected = $(option).val();
			var $cool_drinks_price = $cool_drinks[opselected].price;
			if($mainDiv.find('.jsSelectMenu').is(':checked')) {
				if(checked) {
					$menus_total += parseFloat($cool_drinks_price);
				} else {
					$menus_total -= parseFloat($cool_drinks_price);
				}
				$mainDiv.find('.jsSelectOrder').val($menus_total.toFixed(2));
				$('#jsTotalPrice').html($menus_total.toFixed(2)+'&euro;');
			}
			$old_price = 0;
			if($cool_drinks_selected[$menu_id]) {
				$old_price = $cool_drinks_selected[$menu_id];
			}
			if(checked) {
				 $cool_drinks_selected[$menu_id] = parseFloat($old_price) + parseFloat($cool_drinks_price);
			} else {
				$cool_drinks_selected[$menu_id] = parseFloat($old_price) - parseFloat($cool_drinks_price);
			}
		}
	});
	
	$(document).on('change', '.jsSelectOrder', function() {
		$('.jsSelectMenu').prop('disabled',false);
		$('.jsSelectOrder').prop('disabled',false);
		var $mainDiv = $(this).closest('.jsSubMenu');
		if($(this).is(':checked')) {
			$('.jsSelectMenu').prop('checked',false);
			$('.jsSelectMenu').prop('disabled',true);
			$('.jsSelectOrder').prop('disabled',true);
			$(this).prop('disabled',false);
			$mainDiv.find('.jsSelectMenu').prop('checked', true);
			$mainDiv.find('.jsSelectMenu').prop('disabled', false);
		} else {
			$mainDiv.find('.jsSelectMenu').prop('checked', false);
		}
		addPrice();
	});
	
	$(document).on('change', '.jsSelectMenu', function(){
		var $mainDiv = $(this).closest('.jsSubMenu');
		var $checkedLength = $mainDiv.find('.jsSelectMenu:checked').length;
		if($checkedLength == 2) {
			$('.jsSelectMenu').prop('checked',false);
			$('.jsSelectMenu').prop('disabled',true);
			$('.jsSelectOrder').prop('disabled',true);
			$mainDiv.find('.jsSelectMenu').prop('checked', true);
			$mainDiv.find('.jsSelectOrder').prop('checked', true);
			$mainDiv.find('.jsSelectMenu').prop('disabled', false);
			$mainDiv.find('.jsSelectOrder').prop('disabled', false);
		} else {
			$mainDiv.find('.jsSelectOrder').prop('checked', false);
		}
		addPrice();
	});

	$(document).on('change', '.jSelectDrinks', function(){
		if ($('.jSelectDrinks:checked').length == 2) {
			$('.jSelectDrinks').find('input[type=checkbox]').attr('disabled',true);
			$('.jSelectDrinks').find('input[type=checkbox]:checked').attr('disabled',false);
		} else {
			$('.jSelectDrinks').find('input[type=checkbox]').attr('disabled',false);
		}
	});
		
	
	function addPrice() {
		var $main_total = 0;
		$('.jsSelectOrder').each(function() {
			var $mainDiv = $(this).closest('.jsSubMenu');
			var $checkedLength = $mainDiv.find('.jsSelectMenu:checked').length;
			var $menu_id = $mainDiv.find('.jsSelectMenu').attr('name').replace ( /[^\d.]/g, '' );
			var $amount = parseFloat($menus[$menu_id].full_price);
			
			var $total = 0;
			if ($checkedLength > 0) {
				if($checkedLength == 1) {
					$amount = parseFloat($menus[$menu_id].half_price);
				}
			
				$total += $amount;
				
				//console.log($cool_drinks_selected)
				
				if($cool_drinks_selected[$menu_id]) {
					$total += parseFloat($cool_drinks_selected[$menu_id]);
				}
				
				$total = $total.toFixed(2);
				$main_total = parseFloat($main_total) + parseFloat($total);
				
				$(this).val($total);
			}
		});
		$menus_total = $main_total;
		console.log($menus_total, $main_total)
		$('#jsTotalPrice').html($main_total.toFixed(2)+'&euro;');
	}
	
	$(document).on('click', '.jsAddMenuButton', function(e) {
		var $form = $('form#jsMenuForm');
		if(!$('.jsSelectMenu:checked').length) {
			alert('Kindly select atleast one menu to proceed!');
			return false;
		}

		var reloadValue = $(this).data('value');
		var menu_completed_with_others = false;

		$('.jsSelectOrder').each(function(){
			if ($(this).is(":checked")) {
				var mainDiv = $(this).closest('.jsSubMenu');
				var checkedLength = mainDiv.find('.jsSelectMenu:checked').length;
				var totalCheckedLength = $('.jsSelectMenu:checked').length;
				if (checkedLength != totalCheckedLength) {
					menu_completed_with_others = true;
					alert('Kindly unselect any one Menu Completo');
				}
			}
		}).promise().done(function(){
			if (menu_completed_with_others == false) {
				$form.append('<input type="hidden" name="is_reload" value="'+reloadValue+'">');
				$form.submit();	
			}
		});
		return false;
	})
	
		

	var interval = null;
	if(timeLeft > 0) {
		interval = setInterval(startTimer, 1000);
	}
	function startTimer() {
		var timer = timeLeft, hours, minutes, seconds;
		
		sec_num = parseInt(timer, 10);
		hours   = Math.floor(timer / 3600)
		minutes = Math.floor((sec_num - (hours * 3600)) / 60)
		seconds = sec_num - (hours * 3600) - (minutes * 60);

		hours = hours < 10 ? "0" + hours : hours;
		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		display.text(hours+":"+minutes + ":" + seconds);

		if (--timeLeft < 0) {
			$('.add_menu').remove();
			$('.jsMenuDiv').remove();
			clearInterval(interval);
		}
	}
		
});

function isAvailableDates(date) {
	if (typeof availableDates != 'undefined') {
		ymd = date.getFullYear()+'-'+ ('0'+(date.getMonth()+1)).slice(-2) + "-" + ('0'+date.getDate()).slice(-2);
		if ($.inArray(ymd, availableDates) != -1) {
			//return true;
			return {classes: 'menuAvailable'}
		} else {
			return false;
		}
	}
	return true;
}
