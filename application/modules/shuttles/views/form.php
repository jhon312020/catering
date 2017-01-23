<style>
@page { margin: 10mm; } /* All margins set to 2cm */
@media print {
	 body, .page-container, .sidebar-menu {margin:0 !important; padding-left: 0px !important;}
	.btn {
		display: none !important;
	}
	.list-inline, .sidebar-menu {
		display: none !important;
	}
	.col-md-6 {
		float: left !important;
		margin-left: 0px !important;
		padding-left:0px !important;
		width:50% !important;
	}
	.editButton, .shareprint {
		display:none;
	}
}
.control-label{
	text-align:left !important;
	font-size:14px;
}
.custom-combobox{
	width:100%;
}
td{
	border:none !important;
	line-height: 1.42857;
	padding-bottom:5px;
	vertical-align: top;
	font-size:12px !important;
}
.well {
	border:1px dotted #88758d;
	padding: 19px;
	margin-bottom: 20px;
}
body {
	font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
	line-height: normal;
	font-size: 12px;
	color: #58385f;
}
.token-input{
	//font-size:14px;
}
.token-label{
	//font-size : 14px;
}
.token .close {
	padding-top:0px !important;
}
.form-group {
	margin-bottom: 5px !important;
}
div.headerbar {
	margin-bottom: 15px !important;
	margin-top: 15px !important;
}
.popover {
	position: absolute;
	margin-right:10px;
	background-color:#391B38;
	color:#fff;
	font-size:14px;
	width:300px;
	right:0;
}
.popover .arrow {
	display:none;
}
.tokenfield {
	border-radius:20px;
}
.formError {
    display: block;
    cursor: pointer;
    text-align: left;
	z-index: 1000000 !important;
}
.formError .formErrorArrow div {
	box-shadow: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	-o-box-shadow: none;
    border-left: 2px solid #ddd;
    border-right: 2px solid #ddd;
    box-shadow: 0 2px 3px #444;
    -moz-box-shadow: 0 2px 3px #444;
    -webkit-box-shadow: 0 2px 3px #444;
    -o-box-shadow: 0 2px 3px #444;
    font-size: 0px;
    height: 1px;
    background: #ee0101;
    margin: 0 auto;
    line-height: 0;
    font-size: 0;
    display: block;
}
.formError .formErrorArrowBottom div {
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    -o-box-shadow: none;
}
.formError .formErrorArrowBottom {
	box-shadow: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	-o-box-shadow: none;
	margin: 0px 0 0 12px;
	top: 2px;
	width: 15px;
	margin: -2px 0 0 13px;
	position: relative;
	z-index: 996;
}
.formErrorContent {
    width: 100%;
    background: #ee0101;
    position: relative;
    color: #fff;
    min-width: 120px;
    font-size: 11px;
    border: 2px solid #ddd;
    box-shadow: 0 0 6px #000;
    -moz-box-shadow: 0 0 6px #000;
    -webkit-box-shadow: 0 0 6px #000;
    -o-box-shadow: 0 0 6px #000;
    padding: 4px 10px 4px 10px;
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    -o-border-radius: 6px;
	z-index: 991;
	background-color: #FF0000 !important;
    border: 1px solid #ffffff !important;
    font-size: 13px !important;
    padding: 5px !important;
    border-radius: 5px !important;
    min-width: 140px !important;
}
.line1 {
	width: 3px;
	border: none;
	background: #ddd;
}
.line2 {
	width: 3px;
border: none;
background: #ddd;
}
.line3 {
	    width: 1px;
    border-left: 2px solid #ddd;
    border-right: 2px solid #ddd;
    border-bottom: 0 solid #ddd;

}
.line4 {
width: 3px;	
}
.line5 {
	width: 5px;
}
.line6 {
	width: 7px
}
.line7 {
	width: 9px
}
.line8 {
	width: 11px
}
.line9 {
	width: 11px
	border:none;
}
.line10 {
	width: 13px
	border:none;
}
</style>
<?php
$extra_array = json_decode($bookings['extra_array'], true);	
?>
<div class="row">
	<?php 
	echo $this->layout->load_view('layout/alerts'); 
	foreach($error as $er){
	?>	
	<div class="alert alert-danger"><?php echo $er; ?></div>
	<?php	
	}
	?>

</div>
	<div class="row" id="reserva01">
		<div class="col-md-6">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar" style="margin-top:0px;margin-bottom:10px !important;">
					<h1 style=
					"margin-bottom:2px;">Booking Information</h1>
					<?php 
						
						echo '<h1 style="color:#F27D00;font-size:12px;margin-bottom:10px;">';
						echo lang('no_es').' Reference: '. $book_reference;
						echo '</h1>';
						echo form_input(array('name'=>'zone', 'value'=>$this->mdl_shuttles->form_value('zone'), 'type'=>'hidden', 'id'=>'zone'));
					?>
				</div>
				<div class="panel-body" style="padding:0px;">
					<form method="post" class="form-horizontal" enctype="multipart/form-data">
						<?php if($bookings['book_role'] == 2){ ?>
						<div class="form-group">
							<label class="col-sm-3 control-label" style="color:#F27D00;"><?php echo lang('collaborator_name'); ?>:
							</label>						
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['collaborator_name']; ?></label>
						</div>
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
						<?php } ?>
						<div class="form-group" style="<?php echo $bookings['book_role'] == 2 ? 'margin-top:10px !important;':''; ?>">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('from'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['start_from']; ?></label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('to'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['end_at']; ?></label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('date_go'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo Date('d/m/Y', strtotime($bookings['start_journey'])); ?></label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('hour_go'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo Date('H:i', strtotime($bookings['hour'])).'h'; ?></label>
						</div>
						<?php if(isset($return_bookings)) { ?>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('date_back'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo Date('d/m/Y', strtotime($return_bookings['start_journey'])); ?></label>							
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('hour_back'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo Date('H:i', strtotime($return_bookings['hour'])).'h'; ?></label>							
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('country'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $countries[$bookings['country']]; ?></label>							
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('flight_no'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['flight_no']; ?></label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('adults'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['adults']; ?></label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('kids'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['kids']; ?></label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label pull-left"><?php echo lang('baby'); ?>: </label>
							<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['baby']; ?></label>
						</div>
						<?php
						if($bookings['book_role'] == 2)
							echo "</div>";
						?>
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
							<div class="form-group" style="margin-top:10px !important;">
								<label class="col-sm-3 control-label pull-left" style="color:#F27D00;"><?php echo lang('passengers_price'); ?>: </label>
								<label class="col-sm-8 control-label pull-left editLabel"><?php echo $bookings['passenger_price']; ?> &euro;</label>
							</div>	
						</div>
						<div class="headerbar" style="border-top:1px solid #ebebeb;height:20px;">
						</div>
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
							<div class="form-group" style="margin-top:10px!important;">
								<label class="col-sm-6 control-label pull-left" style="font-size:18px;color:#F27D00;">Extras</label>
						<?php
						$count=1;
						if(count($extra_array) > 0){
						?>	
								<label class="col-sm-6 control-label pull-left editLabel"  style="font-size:18px;">YES</label>
							</div>
						</div>	
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
						<?php
							foreach($extra_array as $ex){
						?>
						<div class="form-group"  style="<?php echo $count == 1 ? 'margin-top:10px!important':''; ?>">
							<label class="col-sm-4 control-label pull-left"><?php echo $ex['extra_name']; ?>: </label>
							<label class="col-sm-3 control-label pull-left editLabel"><?php echo $ex['extra_count']; ?></label>
							
							<label class="col-sm-2 control-label">*</label>
							<label class="col-sm-3 control-label pull-left editLabel"><?php echo $ex['extra_value']; ?></label>
						</div>
						<?php
							$count++;
							}
						?>	
						</div>
						<?php
						} else {
						?>						
								<label class="col-sm-6 control-label pull-left editLabel" style="font-size:18px;">NO</label>
							</div>
						</div>
						<?php
						}
						if($bookings['promotional_code_id']){ 
						?>
						<div class="headerbar" style="border-top:1px solid #ebebeb;height:20px;">
						</div>
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
							<div class="form-group">
								<label class="col-sm-6 control-label pull-left editLabel"  style="font-size:18px;color:#F27D00;">Promotional codes</label>
							</div>	
							<div class="form-group">
								<label class="col-sm-6 control-label"><?php echo ($bookings['promotional_type'] == 'price')?'Promotional code deduction price':'Promotional code deduction '.$bookings['promotional_value'].' %'; ?>:
								</label>						
								<label class="col-sm-6 control-label pull-left editLabel"><?php echo $bookings['reduction_value']; ?></label>
							</div>
						</div>	
						<?php } ?>						
						<div class="headerbar" style="border-top:1px solid #ebebeb;height:20px;">
						</div>
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
							<div class="form-group" style="margin-top:10px!important;">
								<label class="col-sm-6 control-label pull-left editLabel"  style="font-size:18px;color:#F27D00;"><?php echo lang('payment_status'); ?></label>
								<label class="col-sm-6 control-label pull-left editLabel" style="font-size:18px;">
									<?php
										if($bookings['book_status'] == 'completed')
											echo lang('completed');
										else if($bookings['book_status'] == 'pending')
											echo lang('pending'); 
										else if($bookings['book_status'] == 'cash')
											echo lang('cash_payment');
										else if($bookings['book_status'] == 'paid')
											echo lang('pre_paid');
									?></label>
							</div>							
						</div>
						<div class="headerbar" style="border-top:1px solid #ebebeb;">
							<h1 style="margin-top:16px;">Price<span class="pull-right" style="font-weight:normal;" id="price-display"><?php echo $bookings['price']; ?> &euro;</span></h1>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar" style="margin-top:0px;margin-bottom:10px !important;">
					<h1 style=
					"margin-bottom:2px;color:#F27D00;">Personal Information</h1>
					<h1 style="color:#F27D00;font-size:12px;margin-bottom:10px;">&nbsp;</h1>
				</div>
				<div class="panel-body" style="padding:0px;">
					<form method="post" id="clientform" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="mode" value="client">
						<?php
							$key = array('name', 'surname', 'email', 'phone', 'address', 'cp', 'country', 'city', 'nationality', 'dni_passport', 'doc_no');
							$i=0;
							$email_id='';
							foreach($clients as $ckey=>$cvalue){
								if($key[$i] == 'email'){
									$email_id = $cvalue;
								}
							?>	
							<div class="form-group displayClient">
								<label class="col-sm-3 control-label pull-left " style="width:auto"><?php $lang_key = $key[$i]; echo lang($key[$i]); ?>: </label>
								<label class="col-sm-8 control-label pull-left editLabel" style="color:#F27D00;"><?php echo ($ckey == 'dni_passport')?lang('dni_'.$cvalue):$cvalue; ?></label>
							</div>
							<div class="form-group editClient" style="display: none;">
								<label class="col-sm-3 control-label pull-left"><?php $lang_key = $key[$i]; echo lang($key[$i]); ?>: </label>
								<div class="col-sm-9">
								<?php 
								if($ckey == 'dni_passport') {
									echo form_dropdown($key[$i], array(''=>'Select DNI or passport', 'id'=>'ID', 'passport'=>'Passport'), $this->mdl_clients->form_value($key[$i]), 'class="form-control"');
								} else {
									echo form_input(array('name'=>$key[$i], 'value'=>$this->mdl_clients->form_value($key[$i]), 'type'=>'text', 'id'=>$key[$i], 'class' => 'form-control'));
								}
								?>
								</div>
							</div>
							<?php
							$i++;
							}
						?>
					</form>	
					<div class="form-group" id="saveButtons" style="display:none;">
						<div class="pull-right">
						<a href="javascript:void(0);" class="btn btn-primary btn-md cancelButton" style="float:right;background-color:#cc2424 !important;color:#fff;" name="cancel" value="Cancel">Cancel</a>
						<a href="javascript:void(0);" class="btn btn-primary btn-md print" onClick="$('#clientform').submit();" style="float:right;background-color:#391B38;color:#fff;margin-right:10px;">
								Submit
							</a>
							
							
						</div>	
					</div>
					<?php if($this->uri->segment(3) == 'form') { ?>
					<div class="headerbar editButton" style="border-top:1px solid #ebebeb;">
						<div class="form-group">
							<label class="control-label" style="color:#0F7BE0 !important;cursor:pointer;margin-top:10px;" onClick="showClient();"><a class="btn btn-primary edit btn-sm" href="javascript:void(0);">
										<i class="entypo-pencil"></i>
							</a>
							Edit Personal Info</label>
							
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>			
	</div>
	<div id="printButton">
		<div class="pull-right">
			<a href="javascript:void(0);" class="btn btn-primary btn-md print" style="float:right;background-color:#391B38;color:#fff;background-color:rgb(242, 125, 0) !important;" onClick="window.print();">
				<span class="glyphicon glyphicon-print"></span> Print
			</a>
		</div>	
	</div>
	<div>
		<div class="pull-right">
			<a href="javascript:void(0);" class="btn btn-primary btn-md sharepop" style="margin-right:10px;background-color:#391B38;color:#fff;">
				<span class="glyphicon glyphicon-envelope"></span> Share
			</a>
			
		</div>
	</div>
	<div style="position:relative;width:100%;" class="shareprint">
		<div class="popover fade top in" style="display:none;top:-134px;left:unset !important;" id="popoverShare" data-top="-134">
		<a href="javascript:void(0);" class="" style="position:relative;text-align:right !important;padding:0px;font-size: 25px;margin-left: 10px;float:right;right: -24px;top: -19px;" onClick="$('#popoverShare').fadeOut('slow');"><i class="entypo-cancel-circled"></i></a>
			<div class="popover-content">
				<div class="row">
				   <div class="col-md-12">
						<form action="<?php echo site_url('admin/shuttles/form/'.$bookings['id']); ?>" method="post" id="shareform">
							<div class="form-group"> 
								<label class="control-label" for="tokenfield-tokenfield" style="font-weight:bold;"><?php echo lang('booking_confirmation'); ?></label>
							</div>	
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo lang('your_email'); ?>" id="tokenfield">
								<input type="hidden" id="share_email" name="email_list" class="form-control">
								<input type="hidden" value="share" name="mode" class="form-control">
							</div>
							<div class="form-group" style="margin-top:18px;">
								<button style="float:right;background-color:#F27D00 !important;padding:3px 16px;" class="btn btn-primary" id="sharelink" type="button">Send</button>
							</div>
						</form>  	
				   </div>
				</div>            
			 </div>
			 
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	//alert($('.main-content').width())
	//$('#popoverShare').css('top', $('#printButton').position().top - 130);
	//$('#popoverShare').data('top', $('#printButton').position().top - 130);
	//$('#popoverShare').css('left', $('.main-content').width() - 300);
	
	$('#sharelink').click(function(){
		$('#share_email').val($('#tokenfield').tokenfield('getTokensList'));
		if($('#share_email').val().length > 0) {
			$('#shareform').submit();
		}
		else {
			$('div.tokenfield').prepend('<div style="opacity: 0.87; position: absolute; top: 25px; left: 15px; right: initial; margin-top: 40px;" 	 class="date1formError parentFormundefined formError">'+
											'<div class="formErrorArrow formErrorArrowBottom" id="reserve_error"><div class="line2"></div><div class="line3"></div><div class="line4"></div><div class="line5"></div><div class="line6"></div><div class="line7"></div><div class="line8"></div><div class="line9"></div><div class="line10"></div></div>'+
											'<div class="formErrorContent">Please enter valid email address</div>'+
										
										'</div>');
		}
		//alert($('#tokenfield').tokenfield('getTokensList'));
	});
	$('#tokenfield').on('tokenfield:createtoken', function (e) {
			var data = e.attrs.value.split('|')
			e.attrs.value = data[1] || data[0]
			e.attrs.label = data[1] ? data[0] + ' (' + data[1] + ')' : data[0]
		}).on('tokenfield:createdtoken', function (e) {
			// Über-simplistic e-mail validation
			var re = /\S+@\S+\.\S+/
			var valid = re.test(e.attrs.value)
			if (!valid) {
			  $(e.relatedTarget).addClass('invalid')
			}
			var h = $('.tokenfield').height() - 26;
			$('#popoverShare').css('top', parseFloat($('#popoverShare').data('top')) - h);
		}).on('tokenfield:edittoken', function (e) {
			if (e.attrs.label !== e.attrs.value) {
			  var label = e.attrs.label.split(' (')
			  e.attrs.value = label[0] + '|' + e.attrs.value
			}
			var h = $('.tokenfield').height() - 26;
			$('#popoverShare').css('top', parseFloat($('#popoverShare').data('top')) - h);
		}).on('tokenfield:removedtoken', function (e) {
			var h = $('.tokenfield').height() - 26;
			$('#popoverShare').css('top', parseFloat($('#popoverShare').data('top')) - h);
			//alert('Token removed! Token value was: ' + e.attrs.value)
		}).tokenfield({
			createTokensOnBlur:true
		});
});
$('.sharepop').click(function(){
	if($('#popoverShare').is(':visible')) {	
		//$('#popoverShare').removeClass('in');
		$('#popoverShare').fadeOut('slow');		
	} else {
		//$('#popoverShare').addClass('in');
		$('#popoverShare').fadeIn('slow');
	}
})
$('.showpassword').click(function(){
	if($(this).hasClass('glyphicon-eye-open')){
		$(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
		$('#password').attr('type', 'text');
	}
	else{
		$(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
		$('#password').attr('type', 'password');
	}
});
function showClient(){
	$('.editClient').show();
	$('.displayClient').hide();
	$('#saveButtons').show();
	$('#printButton').hide();
	$('.editButton').hide();
}
$('.cancelButton').click(function(){
	$('#saveButtons').hide();
	$('#printButton').show();	
	$('.editClient').hide();
	$('.displayClient').show();
	$('.editButton').show();
});
if($('.alert-danger').length != 0){
	showClient();
}
function printPage(){
	var e = $('#reserva01').clone();
	$('button#saveButtons', e).remove();
	$('button#printButton', e).remove();
	$('fieldset', e).remove();
	
	var content = e.html();
	var printWindow = window.open('', '', 'height=400,width=800');
		printWindow.document.write('<html><head><title>DIV Contents</title>');
			   printWindow.document.write('<style>'+
	'td{'+
		'border:none !important;'+
		'padding-bottom:5px;'+
		'line-height: 1.42857;'+
		'vertical-align: top;'+
		'font-size:12px !important;'+
	'}'+
	'.well {'+
		'border:1px dotted #88758d;'+
		'padding: 19px;'+
		'margin-bottom: 20px;'+
	'}'+
	'body {'+
		'font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;'+
		'line-height: normal;'+
		'font-size: 12px;'+
		'color: #58385f;'+
	'}'+
'</style>')

		printWindow.document.write('</head><body>');
		printWindow.document.write(content);
		
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		
		
		printWindow.document.close();
		printWindow.print();
}
</script>