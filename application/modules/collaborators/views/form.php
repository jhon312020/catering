<style type="text/css">
	.datepicker1 {
		text-align: left !important;
	}
	.dataTables_filter > label {
		float: left !important;
	    position: relative;
	    left: -11px;
	}
	.date-input {
		height: 31px;
	    padding: 6px 12px;
	    font-size: 12px;
	    line-height: 1.42857143;
	    color: #555555;
	    background-color: #ffffff;
	    background-image: none;
	    border: 1px solid #ebebeb;
	    border-radius: 3px;
	}
	.pull-left {
		text-align: left !important;
	}
	.dt-buttons {
		left: 52px !important;
	}
	.dataTables_filter {
		width:53%;
	}
</style>
<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
//echo $this->mdl_collaborators->form_value('name');die;
//print_r($collaborator_book_bill);die;
?>
<!--<div class="headerbar">
	<h1><?php echo lang('collaborators'); ?></h1>
</div>-->
<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
	<input style="display:none" type="text" name="fakeusernameremembered"/>
	<input style="display:none" type="password" name="password"/>
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
				<div class="panel-heading headerbar" style="margin-top:0px;">
					<h1 style="margin-bottom:2px;"><?php echo lang('col_general_info'); ?></h1>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('name');?>: </label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('name'), $readonly=>true)); ?>
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('email'); ?>: </label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('email'), 'autocomplete'=>"off", $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('phone'); ?>: </label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'phone', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('phone'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('website'); ?>: </label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'website', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('website'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('available_seats'); ?>: </label>
						<div class="col-sm-9">
							<?php
								$available_seats = $this->mdl_collaborators->form_value('available_seats');
								$inputOption = array();
								$inputOption['name']  = 'available_seats';
								$inputOption['style']  = 'position:relative;top:2px;margin-right:5px;';
								$inputOption['value']  = 'activate';
								$inputOption['checked'] = ($available_seats && $available_seats === 'activate');
								if($readonly){ $inputOption['readonly']=1; }
								echo '<label>';
								echo form_radio($inputOption);
								echo 'Activate</label>&nbsp;&nbsp;&nbsp;&nbsp;';
								$inputOption['value']  = 'deactivate';
								$inputOption['checked'] = ($available_seats && $available_seats === 'deactivate');
								if($readonly){ $inputOption['readonly']=1; }
								echo '<label>';
								echo form_radio($inputOption);
								echo 'Deactivate</label>';
							?>
						</div>
					</div>
					<?php if($available_seats == 'activate'){ ?>
					<div class="form-group" id="seatsInput">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('no_of_available_seats'); ?>: </label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'no_of_available_seats', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('no_of_available_seats'), $readonly=>true)); ?>
						</div>
					</div>
					<?php } ?>
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('price') . ' Extra Seats'; ?>: </label>
						<div class="col-sm-9">
							<?php
								//echo form_input(array('name'=>'price_extra_seats', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('price_extra_seats'), $readonly=>true));
								echo $this->mdl_collaborators->form_value('price_extra_seats');
								echo form_dropdown('price', array(''=>'Select Rate', 'rate1'=>'Rate 1', 'rate2'=>'Rate 2', 'rate3'=>'Rate 3'), $this->mdl_collaborators->form_value('price'), 'class="form-control" '.($readonly ? 'readonly' : ''));
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left">Payment Type:</label>
						<div class="col-sm-9">
							<?php
								$payment_methods = $this->mdl_collaborators->form_value('payment_methods');
								$inputOption = array();
								$inputOption['name']  = 'payment_methods';
								$inputOption['style']  = 'position:relative;top:2px;margin-right:5px;';
								$inputOption['value']  = 'online';
								$inputOption['checked'] = ($payment_methods && $payment_methods === 'online');
								if($readonly){ $inputOption['readonly']=1; }
								echo '<label>';
								echo form_radio($inputOption);
								echo 'Online</label>&nbsp;&nbsp;&nbsp;&nbsp;';
								$inputOption['value']  = 'online_and_cash';
								$inputOption['checked'] = ($payment_methods && $payment_methods === 'online_and_cash');
								if($readonly){ $inputOption['readonly']=1; }
								echo '<label>';
								echo form_radio($inputOption);
								echo 'Online (OR) Pay by Cash</label>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label pull-left"><?php echo lang('password'); ?>: </label>
						<div class="col-sm-9">
							<?php echo form_input(array('name'=>'password', 'id'=>'password', 'class'=>'form-control', 'type'=>'password', $readonly=>true, 'value'=>$this->mdl_collaborators->form_value('password'), 'style'=>'padding-right:30px;', 'autocomplete'=>"off")); ?>
							<span style="position: relative; cursor: pointer; float: right; top: -22px; left: -5px;" class="glyphicon glyphicon-eye-open showpassword"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar" style="margin-top:0px;">
					<h1 style="margin-bottom:2px;color:#F27D00;"><?php echo lang('col_address_info'); ?></h1>
				</div>
				<div class="panel-body" style="padding:0px;" id="multisteppanel">
					<?php 
						$address_id = array();
						if(count($address_array) > 0) {							
							foreach ($address_array as $address) {
								if(isset($address['id'])) {
									array_push($address_id, $address['id']);
								}
					?>
					<div class="form-group addcontent">
						<label class="col-sm-2 control-label pull-left"><?php echo lang('bcn_area'); ?>: </label>
						<div class="col-sm-3">
							<?php echo form_dropdown(isset($address['id'])?'zone_old_'.$address['id'] : 'zone[]', array(''=>'Select Zone')+$bcn, $address['zone'], 'class="form-control" '.$disabled.''); ?>
						</div>
						<label class="col-sm-2 control-label pull-left"><?php echo lang('address'); ?>: </label>
						<div class="col-sm-4">
							<?php echo form_input(array('name'=>isset($address['id'])?'address_old_'.$address['id'] : 'address[]', 'class'=>'form-control', 'value'=>$address['address'], $readonly=>true)); ?>
						</div>
						<div class="col-sm-1" style="width:auto;padding:0;margin:0;">
							<i class="entypo-cancel-circled close deleteStep"></i>
						</div>
					</div>
					<?php 
							}
						} else {
					?>
					<div class="form-group addcontent">
						<label class="col-sm-2 control-label pull-left"><?php echo lang('bcn_area'); ?>: </label>
						<div class="col-sm-3">
							<?php echo form_dropdown('zone[]', array(''=>'Select Zone')+$bcn, $this->mdl_collaborators->form_value('zone'), 'class="form-control" '.$disabled.''); ?>
						</div>
						<label class="col-sm-2 control-label pull-left"><?php echo lang('address'); ?>: </label>
						<div class="col-sm-4">
							<?php echo form_input(array('name'=>'address[]', 'class'=>'form-control', 'value'=>$this->mdl_collaborators->form_value('address'), $readonly=>true)); ?>
						</div>
						<div class="col-sm-1" style="width:auto;padding:0;margin:0;">
							<i class="entypo-cancel-circled close deleteStep"></i>
						</div>
					</div>
					<?php 
						}
					?>	
					<input type="hidden" name="address_id" value='<?php echo json_encode($address_id); ?>'></input>
					<div class="form-group">
						<div class="col-sm-12 pull-right">
							<a class="btn btn-lg btn-default btn-block addstep" value="1" style="text-transform:uppercase;font-weight:bold;background:#CCCCCC;border-radius:10px;color:#FFFFFF;font-size:16px;">
								<i class="icon-ok icon-white"></i> ADD NEW ADDRESS
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<?php
				$user_id = $this->mdl_collaborators->form_value('user_id');
				echo form_hidden('user', $user_id ? base64_encode($user_id) : '');
				if(!$readonly)
					echo $this->layout->load_view('layout/header_buttons');
			?>
		</div>
	</div>
	</form>
	<?php if($col_id != '' && $col_id != null) { ?>
	<div class="headerbar" >
			<div class="clearfix">
				<div style="width:25%;" class="pull-right">
					<div id="dateSearch">
						<form method="POST" action="" id="dateRange" style="position:absolute; right:0px;z-index:998;">
							<label>
								<div class="input-group input-daterange pull-left" style="width:83%;">
									<?php echo form_input('start_date', Date('d/m/Y', strtotime($start_date)), 'class="form-control input-sm datepicker1" style="height:31px;"'); ?>
									<span class="input-group-addon">to</span>
									<?php echo form_input('end_date', Date('d/m/Y', strtotime($end_date)), 'class="form-control datepicker1 date-input" style="margin-left:0px !important;"'); ?>
								</div>
								<button class='btn btn-sm btn-primary pull-right' style="font-size:13px;padding:5px 10px;margin-left: 10px;" type="submit">Go</button>
							</label>
						</form>
					</div>
				</div>
			</div>
		</div>
	
	<div class="row" id="reserva01">
		<div class="col-md-12">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar" style="margin-top:0px;">
					<h1 style="margin-bottom:2px;"><?php echo lang('booking_list'); ?></h1>
				</div>
				<div class="panel-body">
					<table class="table table-bordered datatable data_table">
							<thead>
								<tr>
									<th><?php echo lang('reference'); ?></th>
									<th><?php echo lang('name'); ?></th>
									<th><?php echo lang('date'); ?></th>
									<th><?php echo lang('hour'); ?></th>
									<th style="width: 10%;"><?php echo lang('from'); ?></th>
									<th style="width: 10%;"><?php echo lang('to'); ?></th>
									<th><?php echo lang('price'); ?></th>
									<th><?php echo lang('passengers'); ?></th>
									<th style="width: 15%;"><?php echo lang('payment_method'); ?></th>
									<th style="width: 25%;"><?php echo lang('options'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($booking_array as $book) {
									$clients = false;
									$arr = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
									if($book['client_id'])
										$clients = true;
									else
										$json = json_decode($book['client_array'],true);

									$address = $book['mainaddress'] != '' && $book['mainaddress'] != null ? $book['mainaddress'] : $book['col_address'];
									
									$start_from = (in_array($book['start_from'], $arr))?$book['start_from']:$book['name'].' - '.$address;
									$end_at = (in_array($book['end_at'], $arr))?$book['end_at']:$book['name'].' - '.$address;
									if($book['bcnarea_address_id'] != '' && $book['bcnarea_address_id'] != '0') {
										if(!in_array($book['start_from'], $arr))
											$book['book_address'];
										if(!in_array($book['end_at'], $arr))
											$end_at = $book['book_address'];
									}

								?>
									<tr>
										<td style="color:#F27D00;"><?php echo $book['reference_id'].'-'.sprintf("%02d", $book['round_trip'] == 1?$res[$book['id']]:$book['id']); ?></td>
										<td><?php echo $clients?$book['first_name'].' '.$book['surname']:$json['name'].' '.$json['surname']; ?></td>
										<td><?php echo date('d/m/Y', strtotime($book['start_journey'])); ?></td>
										<td><?php echo date('H:i', strtotime($book['hour'])).'h'; ?></td>
										<td><?php echo (in_array($book['start_from'], $arr))?$book['start_from']:$book['name'].' - '.$address; ?></td>
										<td><?php echo (in_array($book['end_at'], $arr))?$book['end_at']:$book['name'].' - '.$address; ?></td>
										<td><?php echo $book['price']; ?></td>
										<td><?php echo $book['adults'] + $book['kids']; ?></td>
										<td><?php 
											if($book['book_status'] == 'completed' || $book['book_status'] == 'pending')
												echo lang('online');
											else if($book['book_status'] == 'cash')
												echo lang('cash_payment');
											else if($book['book_status'] == 'paid')
												echo lang('pre_paid');

										 ?></td>
										<td>
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/shuttles/view/' . $book['id']); ?>">
												<i class="entypo-eye"></i>
											</a>
											<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/shuttles/form/' . $book['id']); ?>">
												<i class="entypo-pencil"></i>
											</a>
											<a class="btn btn-info btn-sm" href="javascript:void(0);" style="<?php echo $book['journey_completed'] == 1?'background-color: rgb(109, 224, 109) !important;border-color: rgb(109, 224, 109) !important;':'background-color: #e5900f !important;border-color: #e5900f !important;'; ?>">
												<i class="entypo-check"></i>
											</a>
											<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/shuttles/delete/' .$book['id']); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
												<i class="entypo-trash"></i>
											</a>
										</td>
									</tr>
								<?php } ?>	
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
	
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
		<div class="headerbar" >
			<div class="clearfix">
				<h1 class="pull-left"><?php echo lang('charts'); ?></h1>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-3">	
				<div class="tile-stats tile-purple-dark" style="background-color:#337ab7;">
					<div class="num" data-start="0" data-end="<?php echo $collaborator_book_count['count']->book_count; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
					<a href="javascript:void(0);"><h3><?php echo lang('total_shuttles'); ?></h3></a>
				</div>
			</div>
			<div class="col-sm-3">	
				<div class="tile-stats tile-purple-dark" style="background-color:#5cb85c;">
					<div class="num" data-start="0" data-end="<?php echo $collaborator_book_bill['count']->bill_amount; ?>" data-postfix="&euro;" data-duration="1400" data-delay="0">0</div>
					<a href="javascript:void(0);"><h3><?php echo lang('total_billings'); ?></h3></a>
				</div>
			</div>
			<div class="col-sm-3">	
				<div class="tile-stats tile-purple-dark" style="background-color:#d9534f;">
					<div class="num" data-start="0" data-end="<?php echo $collaborator_book_count['count']->passenger_count; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
					<a href="javascript:void(0);"><h3><?php echo lang('total_passengers'); ?></h3></a>
				</div>
			</div>
		</div>	
		<div class="row">&nbsp;</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">Billing of the collaborator per date.</div>
						<div class="panel-options">
							<!--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg">
								<i class="entypo-cog"></i>
							</a>
							<a href="#" data-rel="collapse">
								<i class="entypo-down-open"></i>
							</a>
							<a href="#" data-rel="reload">
								<i class="entypo-arrows-ccw"></i>
							</a>
							<a href="#" data-rel="close">
								<i class="entypo-cancel"></i>
							</a>-->
						</div>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td width="100%">
									<div style="width:100%;text-align:center;">
									<strong style="">Total Billings: <?php echo $collaborator_book_bill['count']->bill_amount; ?></strong>
									</div>
									<div id="collaborator_book_bill" style="height: 300px"></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">Number of bookings and passenger per date for Collaborators Booking</div>
						<div class="panel-options">
							<!--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg">
								<i class="entypo-cog"></i>
							</a>
							<a href="#" data-rel="collapse">
								<i class="entypo-down-open"></i>
							</a>
							<a href="#" data-rel="reload">
								<i class="entypo-arrows-ccw"></i>
							</a>
							<a href="#" data-rel="close">
								<i class="entypo-cancel"></i>
							</a>-->
						</div>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td width="100%">
									<div style="width:100%;text-align:center;">
									<strong style="">Total Book count: <?php echo $collaborator_book_count['count']->book_count; ?></strong><br>
									<strong style="">Total Passengers: <?php echo $collaborator_book_count['count']->passenger_count; ?></strong>
									</div>
									<div id="collaborator_book_passenger" style="height: 300px"></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php } ?>
<script type="text/javascript">
	var newInputValue = '';
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
	$('.addstep').click(function(){
		$('.addcontent:last').after($('.addcontent:first').clone());
		$('.addcontent:last').each(function(){
			$(this).find('select').attr('name', 'zone[]').val($(this).find('select option:first').val());
			$(this).find('input').attr('name', 'address[]').val('');
		});
		deleteStep();
	});
	function deleteStep(){
		$('.deleteStep').unbind();
		$('.deleteStep').bind('click', function() {
			if($('.addcontent').length > 1)
				$(this).closest('.addcontent').remove();
		});
	}
	deleteStep();
	if(!$('[name=payment_methods]').is(':checked'))
		$('[name=payment_methods]:first').prop('checked', true);
	
	$(document).on('change', 'input[type="radio"][name="available_seats"]', function(){
		var $dom = $(this);
		var currentContainer = $dom.parent().parent().parent();
		var seatsInputContainer = $('#seatsInput');
		var html = '<div class="form-group" id="seatsInput"><label class="col-sm-3 control-label">No of Available Seats: </label><div class="col-sm-5"><input type="text" name="no_of_available_seats" value class="form-control"></div></div>';
		switch($dom.val()){
			case 'activate':
				if (!seatsInputContainer.length){
					html = html.replace(' value ',' value="'+newInputValue+'" ');
					currentContainer.after(html);
				}
			break;
			case 'deactivate':
				if (seatsInputContainer.length){
					newInputValue = seatsInputContainer.find('input[name="no_of_available_seats"]').length ? seatsInputContainer.find('input[name="no_of_available_seats"]').val() : '';
					seatsInputContainer.remove();
				}
			break;
		}
	});
	if(!$('[name=available_seats]').is(':checked')){
		$('[name=available_seats]:first').trigger('click');
	}
	$(document).ready(function(){
		
	
	Morris.Area({
		element: 'collaborator_book_bill',
		data: JSON.parse('<?php echo json_encode($collaborator_book_bill['list']); ?>'),
		xkey: 'start_journey',
		ykeys: ['book_bill'],
		labels: ['Total price'],
		parseTime: false,
	});		
	Morris.Bar({
		element: 'collaborator_book_passenger',
		axes: true,
		data: JSON.parse('<?php echo json_encode($collaborator_book_count['list']); ?>'),
		xkey: 'start_journey',
		ykeys: ['book_count', 'passenger_count'],
		labels: ['Book Count', 'Passenger count'],
		barColors: ['#707f9b', '#455064', '#242d3c']
	});
	})
</script>
