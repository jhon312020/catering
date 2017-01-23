<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	$path = $this->uri->segment(2);
	
	if($ln=='en'){
		$full_path_en = current_url();
		$full_path_es = str_replace('/en', '/es', current_url());
	}
	else{
		$full_path_es = current_url();
		$full_path_en = str_replace('/es', '/en', current_url());
	}

	if(!$ln || $ln == ""){	$ln = "es"; }
	$modalForm = site_url($ln . '/reserva01');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $template_path; ?>/css/validationEngine.jquery.css">
<style>
.ui-tooltip
{
    font-size:10pt;
	width:120px;
}
/*.formError{
	font-size: 11px;
	top: 34px !important;
}
.validateRadio .formError{
	font-size: 11px;
	top: 215px !important;
}
.paymentValid .formError{
	font-size: 11px;
	top: 21px !important;
}
.validTextpassword .formError{
	font-size: 11px;
	top: 77px !important;
	left:11px !important;
}
.validText .formError{
	font-size: 11px;
	top: 60px !important;
	left:11px !important;
}
.flight_noDiv .formError{
	font-size:8px;
	top: 57px !important;
}
.hoursDiv .formError{
	font-size:6px;
	top: 57px !important;
}
.countryDiv .formError{
	font-size:8px;
	top: 57px !important;
}
.adultsDiv .formError{
	font-size:8px;
	top: 57px !important;
}*/
.ui-menu .ui-menu-item:hover, .ui-menu .ui-menu-item:focus, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-widget-content .ui-state-hover {
	background-color:#45234B !important;
	background-image: none !important;
	color:#fff !important;
	font-weight: normal !important;
	font-size:14px!important;
	border:1px solid #646464 !important;
}
.ui-menu .ui-menu-item, .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
	background-image: none !important;
	background-color: #fff !important;
	color:#45234B !important;
	font-weight:normal !important;
	font-size:14px!important;
}
.ui-state-highlight {
	border:1px solid #646464 !important;
}
.ui-widget-header {
	background-color:#45234B !important;
	background-image: none !important;
	color:#fff !important;
	font-weight: normal !important;
	font-size:14px!important;
	border:1px solid #646464 !important;
}
.ui-widget select {
	background-color: #666666 !important;

}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/font-icons/entypo/css/entypo.css">


<div class="modal fade" id="confirmation_modal">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Confirmation Message</h4>
      </div>
      <div class="modal-body">
        <p><?php echo lang('alert_info'); ?></p>
      </div>
      <div class="modal-footer" style="text-align:right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button style="background-color:#391B38;" type="button" onClick="location.replace('<?php echo $ln=='en'?site_url('es/reservation'):site_url('en/reservation'); ?>');" class="btn btn-primary" id="confirmationButton">Confirm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
<div class="modal fade" id="message_modal">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p><?php echo lang('message_info'); ?></p>
      </div>
      <div class="modal-footer" style="text-align:right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
<!-- Modal -->
<!--<div class="modal fade reservePop" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo lang('choose_your_route'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<div class="row contacto">
						<div class="form-group col-xs-6 zd-29">
							<button id="vuelta" class="btn btn-block active mytpbtn" type="button"><?php echo lang('round_trip'); ?></button>
						</div>
						<div class="form-group col-xs-6 zd-28">
							<button id="ida" class="btn btn-block mytpbtn" type="button"><?php echo lang('one_way'); ?></button>
						</div>
						<?php echo form_open($modalForm, array('class'=>'validateForm')); ?>
						<form method="POST" action="<?php echo $modalForm; ?>" class="validateForm">
						<div class="form-group col-xs-12 zd-27"><hr></div>
						<div class="form-group col-xs-12 trip_alert zd-26">
							<div class="alert alert-info" style="background-color:#391B38;border-color:#391B38;color:#fff;">
								<a href="javascript:void(0);" class="close" style="display:block;color:#fff;opacity:1;" data-hide="trip_alert">&times;</a>
							  <strong>*</strong> <?php echo lang('trip_alert'); ?>
							</div>
						</div>
						<div class="form-group col-xs-12">
							<?php echo form_dropdown('start_from1', $start_from, null, 'class="form-control zd-25 validate[required]" onchange="addPlaceInput(this);"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
							<?php echo  form_input(array('name'=>'zone', 'id'=>'zone', 'type'=>'hidden')); ?>
							<?php echo  form_input(array('name'=>'collaborator_address_id', 'id'=>'collaborator_address_id', 'type'=>'hidden')); ?>
							<?php echo  form_input(array('name'=>'collaborators_id', 'id'=>'collaborators_id', 'type'=>'hidden')); ?>
						</div>
						<div class="form-group col-xs-12 ui-front zd-24">
							<input type="text" class="form-control zd-23 validate[required,funcCall[validStart]]" name="start_from" id="autoCompletePlace" placeholder="<?php echo lang('from'); ?>" data-errormessage-value-missing="<?php echo lang('require_field'); ?>">
						</div>
						<div class="form-group col-xs-12 ui-front zd-22">
							<?php echo form_input('end_at', null, 'class="form-control zd-21 validate[required,funcCall[validEnd]]" id="end_at" placeholder="'.lang('to').'" data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div id="select_ida" class="form-group col-xs-6 zd-20 testId">
							<?php echo form_input(array('name'=>'start_journey', 'id'=>'date1', 'style'=>'padding-left:35px;', 'placeholder'=>lang('go_trip'), 'class'=>'form-control zd-19 validate[required, funcCall[validHumanDate]]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
							<i style="position: relative; top: -26px; color: #ec7123; left: 8px;"class="entypo-flight"></i>
						</div>
						<div id="select_vuelta" class="form-group col-xs-6 zd-18" style="padding-left:5px;">
							<?php echo form_input(array('name'=>'return_journey', 'id'=>'date2', 'style'=>'padding-left:35px;', 'placeholder'=>lang('return_trip'), 'class'=>'form-control zd-17 validate[required, funcCall[validHumanDate]]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
							<i style="position: relative; top: -24px; color: #ec7123; left: 8px;display: inline-block;-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-o-transform: rotate(180deg);-ms-transform: rotate(180deg);transform: rotate(180deg);"class="entypo-flight"></i>
						</div>
						<div class="form-group col-xs-6 startTripText zd-16" style="margin-top: -15px;">
							<label><?php echo lang('departure_time'); ?></label>
						</div>
						<div class="form-group col-xs-6 returnTripText zd-15" style="padding-left: 5px;margin-top: -15px;">
							<label><?php echo lang('landing_time'); ?></label>
						</div>
						<div class="form-group col-xs-3 mar_min_5 hoursDiv startTrip zd-14" style="padding-right:5px;margin-top: -15px;">
							
							<?php echo form_dropdown('hours', $hours, null, 'class="form-control validate[required] zd-13"   data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-3 mar_min_5 startTrip zd-12" style="padding-left:5px;margin-top: -15px;">
							
							<?php echo form_dropdown('minutes', $minutes, null, 'class="form-control zd-11"'); ?>
						</div>
						<div class="form-group col-xs-3 mar_min_5 hoursDiv returnTrip zd-10" style="padding-right:5px; padding-left:5px;margin-top: -15px;">
							
							<?php echo form_dropdown('return_hours', $hours, null, 'class="form-control validate[required] zd-9"   data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-3 mar_min_5 returnTrip zd-8" style="padding-left:5px;margin-top: -15px;">
							
							<?php echo form_dropdown('return_minutes', $minutes, null, 'class="form-control zd-7"'); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 countryDiv zd-6">
							<label><?php echo lang('your_country'); ?></label>
							<?php echo form_dropdown('country', $countries, null, 'class="form-control validate[required]"   data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 flight_noDiv zd-5" style="padding-left:5px;">
							<label><?php echo lang('flight'); ?></label>
							<?php echo form_input(array('name'=>'flight_no', 'id'=>'flight_no', 'class'=>'form-control validate[required]',   'data-errormessage-value-missing'=>lang('require_field'))); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 adultsDiv zd-4">
							<label><?php echo lang('adults'); ?></label>
							<?php echo form_dropdown('adults', $adults, null, 'class="form-control validate[required]"   data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 zd-3" style="padding-left:5px;">
							<label><?php echo lang('child'); ?></label><img data-toggle="tooltip" data-placement="top" title="Kids are under 5 years. Others are considered only adults." src="<?php echo $template_path;?>images/popup_info_icon.png" style="width:22px;" class="pull-right">
							<?php echo form_dropdown('kids', $kids, null, 'class="form-control"'); ?>
						</div>
						<div class="form-group col-xs-12 zd-2"><hr></div>
						<div class="form-group col-xs-12 zd-1">
							<button type="submit" class="btn btn-primary btn-lg pickbluebg btn-block" style="font-size:41.67px;font-family:FuturaStdBold;"><?php //echo lang('go'); ?>Go</button>
						</div>
						</form>
					</div>
				</div>
	  		</div>
	    	<div class="modal-footer"></div>
	    </div>
  	</div>
</div>-->
<div class="modal fade" id="duplicate_modal">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Duplicate Booking</h4>
      </div>
      <div class="modal-body">
        <p class="duplicate_message" id="both_duplicate"><?php echo lang('both_duplicate'); ?></p>
        <p class="duplicate_message" id="start_duplicate"><?php echo lang('start_duplicate'); ?></p>
        <p class="duplicate_message" id="return_duplicate"><?php echo lang('return_duplicate'); ?></p>
      </div>
      <div class="modal-footer" style="text-align:right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button style="background-color:#391B38;" type="button" class="btn btn-primary" id="dupliacteConfirmbutton">Confirm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

<div class="row mob-show" style="width:95%;">&nbsp;</div>
<!-- Footer -->
<footer id="footer" class="container">
	<hr>
	<div class="mob-hide">
	<div class="col-xs-6" style="padding-left:0px;">
	<p><?php echo (isset($site_title))?$site_title:''; ?>  <span class="separator">|</span>  
	Email: <a href="mailto:<?php echo (isset($site_email))?$site_email:''; ?>"><?php echo (isset($site_email))?$site_email:''; ?></a> 
	 <span class="separator">|</span> Telf. <?php echo (isset($telephone))?$telephone:''; ?> </p>
	</div>
	<div class="col-xs-6 text-right" style="padding-right:0px;">
	<?php
		if(!$this->session->userdata('user_name')) { ?>
		<a href="<?php echo site_url($ln.'/collaborators_login'); ?>" class='collaborator_link'><?php echo lang('collaborators_access'); ?></a> <span class="separator hide_sep">|</span> 
		<a href="<?php echo site_url($ln.'/carchannel'); ?>" class='collaborator_link'><?php echo lang('car_channel'); ?></a> <span class="separator hide_sep">|</span> 
	<?php } ?>
	<a href="<?php echo site_url('/').$ln; ?>/terms"><?php echo lang('terms_and_conditions'); ?></a> <span class="separator">|</span> 
	<a href="<?php echo (isset($social_facebook))?$social_facebook:'#'; ?>" style="display:none;"><img src="<?php echo $template_path;?>images/facebook.png" style="width:20px;"></a> <span class="separator" style="display:none;">|</span> 
	<a href="<?php echo $full_path_es; ?>" onClick="return checkPage();"><img src="<?php echo $template_path;?>images/spanish.png" style="width:20px;"></a> <span class="separator">|</span> 
	<a href="<?php echo $full_path_en; ?>" onClick="return checkPage();"><img src="<?php echo $template_path;?>images/english.png" style="width:20px;"></a>
	</div>
	</div>
	<div class="mob-show">
		<div class="col-xs-9" style="padding-left:0px; font-size:15px;">
		<p><?php echo (isset($site_title))?$site_title:''; ?>  <span class="separator">|</span> Email: <a href="mailto:<?php echo (isset($site_email))?$site_email:''; ?>"><?php echo (isset($site_email))?$site_email:''; ?></a> <br> Telf.<?php echo (isset($telephone))?$telephone:''; ?>
		 <span class="separator">|</span> <a href="<?php echo site_url('/').$ln; ?>/terms" class="foot_mob_term"><?php echo lang('terms_and_conditions'); ?></a> <span class="separator spt-cob">|</span> <a href="<?php echo site_url('/').$ln; ?>/collaborators_login" class="foot_mob_term"><?php echo lang('collaborators_access'); ?></a>  </p> 
		</div>
		<div class="col-xs-3 text-right" style="padding-right:0px;">
		<a href="<?php echo (isset($social_facebook))?$social_facebook:'#'; ?>" style="display:none;"><img src="<?php echo $template_path;?>images/facebook.png" style="width:20px;"></a> <span class="separator" style="display:none;">|</span>  
		<a href="<?php echo $full_path_es; ?>" onClick="return checkPage();"><img src="<?php echo $template_path;?>images/spanish.png" style="width:20px;"></a> <span class="separator">|</span>  
		<a href="<?php echo $full_path_en; ?>" onClick="return checkPage();"><img src="<?php echo $template_path;?>images/english.png" style="width:20px;"></a> 
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12"  style="clear:both;">
			<div style="text-align: center;">
				<img src="<?php echo $template_path; ?>images/sabadell.png">
				<img src="<?php echo $template_path; ?>images/visamaster.png">
				<img src="<?php echo $template_path; ?>images/mastermaestro.png">
				<img src="<?php echo $template_path; ?>images/paypal.png">
			</div>
			<div style="position: relative;bottom: 20px;">
				<a href="http://www.grupovisualiza.com"><span  style="float: right;color: rgb(195, 180, 180);font-size: 13px;line-height: 1.5;" class="mob-hide">Website by Grupo Visualiza</span></a>
				<span  style="float: right;" class="mob-show">&nbsp;</span>
			</div>			
		</div>
	</div>
</footer>
<script>
$('[data-toggle=tooltip]').tooltip({
	container: "body"
});
var modal = $('#confirmation_modal').modal('hide');
var msg_modal = $('#message_modal').modal('hide');
var duplicate_modal = $('#duplicate_modal').modal('hide');
function checkPage(){
	if('<?php echo end($this->uri->segment_array()); ?>' == 'reservation'){
		modal.modal('show');
		return false;
	}
}

</script>
<script src="<?php echo $template_path; ?>/js/salvattore.min.js"></script>
<script src="<?php echo $template_path; ?>/js/myscript.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/jquery-ui.1.11.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/jquery.validationEngine-en.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/jquery.validationEngine.js"></script>
<script src="<?php echo base_url()."assets/default/"; ?>js/combobox.js"></script>
<script type="text/javascript">
	var arr = [];
	var startValid = true;
	var endValid = true;
	var collaborator_address = <?php echo json_encode($this->details['collaborator_address']); ?>;
	var collaborator_details = <?php echo json_encode($this->details['collaborator_details']); ?>;
	var validBoth = true;
	if("<?php echo $this->session->userdata('user_name'); ?>" != '' && '<?php echo $this->session->userdata('user_type'); ?>' == 2) {
		validBoth = false;
		$('#autoCompletePlace').removeClass('validate[required]').addClass('validate[required, funcCall[validStart]]')
	}
	var autoSource = '';
	function postcodeChange() {
		$('#postal_code').change(function(){
			$('#bcnarea_address_id').val('');
			if(!startValid) {
				$('#zone').val('');
			}
		});
	}
	if("<?php echo $this->session->userdata('user_name'); ?>" != '' && '<?php echo $this->session->userdata('user_type'); ?>' == 2){
		if(collaborator_address.length > 0) {
			if(collaborator_address.length == 1) {
				$( "#autoCompletePlace").val(collaborator_address[0]['label']).prop('readonly', true);
				$( "#zone").val(collaborator_address[0]['zone']);
				$('#collaborator_address_id').val(collaborator_address[0]['collaborator_address_id']);
				$( "#collaborators_id").val(collaborator_address[0]['id']);
			} else {
				autoSource =  collaborator_address;
			}
		} else {
			$( "#autoCompletePlace").val(collaborator_details['name']+' - '+collaborator_details['address']).prop('readonly', true);
			$( "#zone").val(collaborator_details['zone']);
			$( "#collaborators_id").val(collaborator_details['id']);
		}
	}
	else{
		autoSource = '<?php echo site_url() . 'admin/shuttles/getPlaces/city/1'; ?>';
	}
	function autocompleteText() {
		$( "#autoCompletePlace").autocomplete({
			source: autoSource,
			minLength: 2,
			open:function(){
				//$('#end_at').parent().removeClass('ui-front');
			},
			response : function(event, ui){
				//console.log(ui.content)
			},
			change: function(event, ui){
				if (ui.item !== null && typeof ui.item === 'object'){
					startValid = true;
				}
				else {
					startValid = false;
					//if($('select[name=start_from1]').val() == 'city') {
						$('#collaborators_id').val('');
						$('#zone').val('');
						$('#collaborator_address_id').val('');
					//}
				}
			},
			select: function( event, ui ) {
				startValid = true;
				//console.log(ui.item)
				if('zone' in ui.item) {
					$('#collaborators_id').val(ui.item.id);
					$('#zone').val(ui.item.zone);
					$('#collaborator_address_id').val(ui.item.collaborator_address_id);
					$('#bcnarea_address_id').val('');
				}
			}
		});
	}
	autocompleteText();
	postcodeChange();
	/*$( "#end_at").autocomplete({
		source: arr,
		minLength: 2,
		open:function(){
			$('#end_at').parent().addClass('ui-front');
		},
		response : function(event, ui){
			//console.log(ui.content)
		},
		change: function(event, ui){
			if (ui.item !== null && typeof ui.item === 'object'){
				endValid = true;
			}
			else {
				if($('select[name=start_from1]').val() == 'airport') {
					$('#collaborators_id').val('');
					$('#zone').val('');
					$('#collaborator_address_id').val('');
				}
				endValid = false;
			}
		},
		select: function( event, ui ) {
			endValid = true;
			if('zone' in ui.item) {
				$('#collaborators_id').val(ui.item.id);
				$('#zone').val(ui.item.zone);
				$('#collaborator_address_id').val(ui.item.collaborator_address_id);
			}
		}
	});*/
	function addPlaceInput(select){
		var arr = [{label:'Barcelona Airport Terminal 1',value:'Barcelona Airport Terminal 1'},{label:'Barcelona Airport Terminal 2',value:'Barcelona Airport Terminal 2'}];
		
		var _this = $(select);
		var parent= _this.parent();
		var fromPlaceHolder = ''
		var toPlaceHolder = ''
		if (_this.val()== 'city') {
			if($( "[name=end_at]").prop('tagName').toLowerCase() != 'select') {
				var start_clone = $('[name=start_from]').clone();
				var end_clone = $( "[name=end_at]").clone();
				$( "[name=start_from]").remove();
				$( "[name=end_at]").remove();
				$('#start_journey_div').html(end_clone);
				$('#return_journey_div').html(start_clone);
				autocompleteText();
				$('#autoCompletePlace').attr('name', 'start_from');
				$('#end_at').attr('name', 'end_at');
			}
			
			/*if("<?php echo $this->session->userdata('user_name'); ?>" != '' && '<?php echo $this->session->userdata('user_type'); ?>' == 2){
				if(collaborator_address.length > 0) {
					if(collaborator_address.length == 1) {
						$( "#autoCompletePlace").val(collaborator_address[0]['label']).prop('readonly', true);
						$( "#zone").val(collaborator_address[0]['zone']);
						$('#collaborator_address_id').val(collaborator_address[0]['collaborator_address_id']);
						$( "#collaborators_id").val(collaborator_address[0]['id']);
					} else {
						$( "#autoCompletePlace").autocomplete('option', 'source', collaborator_address);
						$('#autoCompletePlace').val('');
					}
				} else {
					$( "#autoCompletePlace").val(collaborator_details['name']+' - '+collaborator_details['address']).prop('readonly', true);
					$( "#zone").val(collaborator_details['zone']);
					$( "#collaborators_id").val(collaborator_details['id']);
				}
			}
			else{
				$( "#autoCompletePlace").autocomplete('option', 'source', '<?php echo site_url() . 'admin/shuttles/getPlaces/city/0'; ?>');
				$('#autoCompletePlace').val('');
			}
			
			$( "#end_at").autocomplete('option', 'source', arr);
			$('#end_at').val('').prop('readonly', false);*/
			
			
			$('.startTripText label').text('<?php echo lang('departure_time').' *'; ?>');
			$('.returnTripText label').text('<?php echo lang('landing_time').' *'; ?>');
			
			fromPlaceHolder = "<?php echo lang('type_hotel'); ?>";
			toPlaceHolder = "<?php echo lang('type_terminal'); ?>";
			var postal_div = $('#postal_div').clone();
			$('#postal_div').remove();
			$('#start_journey_div').after(postal_div);
			
			/*if(validBoth){
				if(!$('#end_at').hasClass('validate[required,funcCall[validEnd]]')) {
					$('#end_at').removeClass('validate[required]');
					$('#end_at').addClass('validate[required,funcCall[validEnd]]');
				}

				if($('[name=start_from]').hasClass('validate[required,funcCall[validStart]]')) {
					$('[name=start_from]').removeClass('validate[required,funcCall[validStart]]');
					$('[name=start_from]').addClass('validate[required]');
				}
			}*/
		} else if (_this.val()== 'airport') {
			//$( "#autoCompletePlace").autocomplete('option', 'source', arr);
			if($( "[name=end_at]").prop('tagName').toLowerCase() == 'select') {
				var start_clone = $('[name=start_from]').clone();
				var end_clone = $( "[name=end_at]").clone();
				$( "[name=start_from]").remove();
				$( "[name=end_at]").remove();
				$('#start_journey_div').html(end_clone);
				$('#return_journey_div').html(start_clone);
				autocompleteText();
				$('#autoCompletePlace').attr('name', 'end_at');
				$('#end_at').attr('name', 'start_from');
			}
			/*if("<?php echo $this->session->userdata('user_name'); ?>" != '' && '<?php echo $this->session->userdata('user_type'); ?>' == 2){
				if(collaborator_address.length > 0) {
					if(collaborator_address.length == 1) {
						$( "#end_at").val(collaborator_address[0]['label']).prop('readonly', true);
						$( "#zone").val(collaborator_address[0]['zone']);
						$('#collaborator_address_id').val(collaborator_address[0]['collaborator_address_id']);
						$( "#collaborators_id").val(collaborator_address[0]['id']);
					} else {
						$( "#end_at").autocomplete('option', 'source', collaborator_address);
						$('#end_at').val('');
					}
				} else {
					$( "#end_at").val(collaborator_details['name']+' - '+collaborator_details['address']).prop('readonly', true);
					$( "#zone").val(collaborator_details['zone']);
					$( "#collaborators_id").val(collaborator_details['id']);
				}
			}
			else{
				$( "#end_at").autocomplete('option', 'source', '<?php echo site_url() . 'admin/shuttles/getPlaces/city/1'; ?>');
				$('#end_at').val('');
			}
			$('#autoCompletePlace').val('').prop('readonly', false);*/
			
			$('.startTripText label').text('<?php echo lang('landing_time').' *'; ?>');
			$('.returnTripText label').text('<?php echo lang('departure_time').' *'; ?>');
			
			fromPlaceHolder = "<?php echo lang('type_terminal'); ?>";
			toPlaceHolder = "<?php echo lang('type_hotel'); ?>";
			var postal_div = $('#postal_div').clone();
			$('#postal_div').remove();
			$('#return_journey_div').after(postal_div);
			
			/*if(validBoth){
				if($('#end_at').hasClass('validate[required,funcCall[validEnd]]')) {
					$('#end_at').removeClass('validate[required,funcCall[validEnd]]');
					$('#end_at').addClass('validate[required]');
				}

				if(!$('[name=start_from]').hasClass('validate[required,funcCall[validStart]]')) {
					$('[name=start_from]').removeClass('validate[required]');
					$('[name=start_from]').addClass('validate[required,funcCall[validStart]]');
				}
			}*/
			
		}
		/*$('#end_at').attr('Placeholder', toPlaceHolder);
		$('#autoCompletePlace').attr('Placeholder', fromPlaceHolder);*/
		$('#autoCompletePlace').attr('Placeholder', "<?php echo lang('type_hotel'); ?>");
		$( "#autoCompletePlace").focus();
		postcodeChange();
	}
</script>
<script>
	/*$( '#select_ida' ).addClass( "col-xs-12");
	$( '#select_ida' ).css( 'padding-right','15px');
	$( '#select_ida' ).removeClass('col-xs-6');
	$('#select_vuelta').css('display','none');*/
	 $('#ida').click(function() {
		if($('select[name=start_from1]').val() == 'city'){
			$('.startTripText label').text('<?php echo lang('departure_time'); ?>');
			$('.returnTripText label').text('<?php echo lang('landing_time'); ?>');
		}
		else if($('select[name=start_from1]').val() == 'airport'){
			$('.startTripText label').text('<?php echo lang('landing_time'); ?>');
			$('.returnTripText label').text('<?php echo lang('departure_time'); ?>');
		}
		$('.testId').removeClass('col-xs-6').addClass("col-xs-12");
		
		$('.returnTrip').hide();
		$('.returnTripText').hide();
		$('.trip_alert').fadeOut();
		$('.startTrip').removeClass('col-xs-3').addClass('col-xs-6');
		$('.startTripText').removeClass('col-xs-6').addClass('col-xs-12');
		$('.startTrip:first').css('padding-right', '');
		$('input[name=return_journey]').val('');
		$('select[name=return_hours]').val('');
		$('select[name=return_minutes]').val('00');
		$('#select_vuelta').css('display','none');
		$( '#ida' ).addClass( "active" );
		$( '#vuelta' ).removeClass('active');
		$( '.testId' ).css( 'padding-right','15px');
		
		var height = $('#firstStepForm').height();
		$('#firstLeftStep div').css('height', height);
		console.log(height)
	});
	$('#vuelta').click(function() {
		if($('select[name=start_from1]').val() == 'city'){
			$('.startTripText label').text('<?php echo lang('departure_time'); ?>');
			$('.returnTripText label').text('<?php echo lang('landing_time'); ?>');
		}
		else if($('select[name=start_from1]').val() == 'airport'){
			$('.startTripText label').text('<?php echo lang('landing_time'); ?>');
			$('.returnTripText label').text('<?php echo lang('departure_time'); ?>');
		}
		
		$('.returnTrip').show();
		$('.returnTripText').show();
		$('.trip_alert').fadeIn();
		$('.startTrip').removeClass('col-xs-6').addClass('col-xs-3');
		$('.startTripText').removeClass('col-xs-12').addClass('col-xs-6');
		$('.startTrip:first').css('padding-right', '5px');
		$('#select_vuelta').css('display','block');
		$( '#vuelta' ).addClass('active');
		$( '#ida' ).removeClass('active');
		$( '.testId' ).css('padding-right','5px');
		$( '.testId' ).addClass( "col-xs-6");
		$( '.testId' ).removeClass('col-xs-12');
		
		var height = $('#firstStep').height();
		$('#firstLeftStep div').css('height', height);
	});
	$('select[name=hours] option:first').val('');
	$('select[name=return_hours] option:first').val('');
	$('select[name=adults] option:first').val('');
	var unavailableDates = ["23-12-2016", "24-12-2016", "25-12-2016", "26-12-2016", "27-12-2016", "28-12-2016", "29-12-2016", "30-12-2016", "31-12-2016", "1-1-2017", "2-1-2017"];
	function unavailable(date) {
			dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
			if ($.inArray(dmy, unavailableDates) == -1) {
					return [true, ""];
			} else {
					return [false, "", "Unavailable"];
			}
	}
	$(function() {
		$( "#date1" ).datepicker({
			minDate: 0,
			changeMonth: true,
			dateFormat:'dd/mm/yy',
			firstDay:1,
			beforeShowDay: unavailable,
			onSelect: function(dateText, inst) {
				$(this).prev('.formError').remove();
			},
			onClose: function( selectedDate ) {
				$( "#date2" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#date2" ).datepicker({
			changeMonth: true,
			dateFormat:'dd/mm/yy',
			firstDay:1,
			beforeShowDay: unavailable,
			onSelect: function(dateText, inst) {
				$(this).prev('.formError').remove();
			},
			onClose: function( selectedDate ) {
				$( "#date1" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		 $("[data-hide]").on("click", function(){
			//$("." + $(this).attr("data-hide")).hide();
			// -or-, see below
			$(this).closest("." + $(this).attr("data-hide")).fadeOut();
		});
		
	});
	function validStart(field, rules, i, options){
		if(!startValid) {
			return "<?php echo lang('invalid_start'); ?>";
		}
	}
	function validEnd(field, rules, i, options){
		if(!endValid)
			return "<?php echo lang('invalid_end'); ?>";
	}
	function validHumanDate(field, rules, i, options){
		if (field.val() == '') {
			return false;
		}
		var reg = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g;
		//var reg = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
		var txt = field.val();
		if (!reg.test(txt)) {
			return "<?php echo lang('invalid_date'); ?>";
		} 
		
		//var dateSplit = txt.replace(/\//g, '-');
		var dateSplit = txt.split('/');
		var date = parseInt(dateSplit[0])+'-'+parseInt(dateSplit[1])+'-'+dateSplit[2];
		if ($.inArray(date, unavailableDates) != -1) {
				return "<?php echo lang('invalid_date'); ?>";
		}
	}
	$('.reservePop input').focus(function(){
		$(this).closest('div').find('.formError').remove();
	})
	$('body').scroll(function(){
	   $("input").datepicker("hide");
	   $("input").blur();
	});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-365764-35', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
