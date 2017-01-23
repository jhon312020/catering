<style type="text/css">
	@page { margin: 10mm; } /* All margins set to 2cm */
	@media print {
		 body, .page-container, .sidebar-menu {margin:0 !important; padding-left: 0px !important;}
	    .btn {
	        display: none !important;
	    }
	    .list-inline, .sidebar-menu, .col-md-5 .panel-heading  {
	    	display: none !important;
	    }
	    .col-md-6, .col-md-5 {
	    	float: left !important;
	    	margin-left: 0px !important;
	    	padding-left:0px !important;
	    	width:55% !important;
	    }
	    .col-md-7 {
	    	float: left !important;
	    	margin-left: 0px !important;
	    	padding-left:0px !important;
	    	width:42% !important;
	    }
	}
</style>
<div class="headerbar">
	<h1><?php echo lang('route'); ?></h1>
	<?php
		if ($this->mdl_calendars->form_value('reference_id')){
			echo '<span style="color:#F27D00;font-size:18px;">'.$this->mdl_calendars->form_value('reference_id').'</span>';
		}
		$zones = $this->mdl_calendars->form_value('zone');
		$hours1 = $this->mdl_calendars->form_value('hours');
		$minutes1 = $this->mdl_calendars->form_value('minutes');
	?>
</div>
<style>
.bookTable td{
	border:none !important;
}
</style>
<form method="post" class="form-horizontal" enctype="multipart/form-data" >
	<div class="row">
		<?php
			echo $this->layout->load_view('layout/alerts');
			$inputOption = array('name'=>'','class'=>'form-control', 'placeholder'=>'Lorem Ipsum','value'=>null);
		?>
		<div class="col-md-5">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar"><h1>&nbsp;</h1></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('car'); ?>: </label>
						<div class="col-sm-8">
							<?php
								$inputOption['name']  = 'car';
								$inputOption['placeholder'] = 'Lorem Ipsum';
								$inputOption['value'] = $this->mdl_calendars->form_value('car');
								if($readonly){ $inputOption['readonly']=1; }
								echo form_input($inputOption);
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('driver'); ?>: </label>
						<div class="col-sm-8">
							<?php
								$inputOption['name']  = 'driver';
								$inputOption['value'] = $this->mdl_calendars->form_value('driver');
								$inputOption['placeholder'] = 'Lorem Ipsum';
								$inputOption['class'] = 'form-control';
								if($readonly){ $inputOption['readonly']=1; }
								echo form_input($inputOption);
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('seats'); ?>: </label>
						<div class="col-sm-8">
							<?php
								$inputOption['name']  = 'seats';
								$inputOption['value'] = $this->mdl_calendars->form_value('seats');
								$inputOption['placeholder'] = '10';
								$inputOption['class'] = 'form-control';
								if($readonly){ $inputOption['readonly']=1; }
								echo form_input($inputOption);
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Days of the week: </label>
						<div class="col-sm-9">
							<?php
								$daysName = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
								$daysValue = $this->mdl_calendars->form_value('days');
								foreach($daysName as $key => $day) {
									$inputOption = array();
									$inputOption['name']  = 'days[]';
									$inputOption['style']  = 'position:relative;top:2px;margin-right:5px;' . ($key !== 0 ? 'margin-left:5px;' : '');
									$inputOption['value']  = $day;
									$inputOption['id']  = 'id-'.$key;
									$inputOption['checked'] = ($daysValue && in_array($day, $daysValue));
									if($readonly){ $inputOption['readonly']=1; }
									echo '<label for="id-'.$key.'">';
									echo form_checkbox($inputOption);
									echo $day.'</label>';
								}
							?>
						</div>
					</div>
					<hr/><h3><?php echo lang('route'); ?></h3>
					<table class="table">
						<tbody>
							<?php
								foreach ($zones as $key => $zone) {
									$time = strtotime($hours1[$key] . ':' . $minutes1[$key]);
									$time = date('H:i A', $time);
									printf("<tr><td>%d</td><td><span style='color:#F27D00;'>%s</span></td><td>%s</td></tr>", ($key+1), $time, $bcn[$zone]);
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar" style="border-bottom:none !important;"><h1>
					<?php echo lang('booking_information'); ?></h1></div>
				<div class="panel-body">
					<?php
					$terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
					foreach($book_info as $book) {
						$clients = json_decode($book['client_array'], true);
					?>
					<div class="row">
						<div class="col-sm-11">
						<div class="col-sm-10" style="padding-top:20px;border-top:1px solid black;">
						<table class="table bookTable" style="border:none !important;">
							<tbody>
								<tr>
									<td><span><?php echo lang('no_reference'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $book['reference_id'].'-'.sprintf("%02d", $book['book_id']); ?></span></td>
								</tr>
								<tr>	
									<td><span><?php echo lang('name'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $book['client_id']?$book['name'].' '.$book['surname']:$clients['name'].' '.$clients['surname']; ?></span></td>
								</tr>
								<tr>
									<td><span><?php echo lang('adults'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $book['adults']; ?></span></td>
								</tr>
								<tr>
									<td><span><?php echo lang('kids'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $book['kids']; ?></span></td>
								</tr>
								<?php if($book['baby'] > 0) { ?>
								<tr>
									<td><span><?php echo lang('baby'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $book['baby']; ?></span></td>
								</tr>
								<?php } ?>
								<tr>
									<td><span><?php echo lang('price'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $book['price']; ?>&nbsp;&euro;</span></td>
								</tr>
								<tr>
									<td><span><?php echo lang('payment_status'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;">
									<?php 
										$address = $book['mainaddress'] != '' && $book['mainaddress'] != null?$book['mainaddress'] : $book['collaborator_address'];
										if($book['book_status'] == 'completed')
											echo lang('completed');
										else if($book['book_status'] == 'pending')
											echo lang('pending'); 
										else if($book['book_status'] == 'cash')
											echo lang('cash_payment');
										else if($book['book_status'] == 'paid')
											echo lang('pre_paid');
									?>
									</span></td>
								</tr>
								<tr>
									<td><span><?php echo lang('address'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo $address; ?></span></td>
								</tr>
								<tr>
									<td><span><?php echo lang('from').'/'.lang('to'); ?>:</span>&nbsp;&nbsp;&nbsp;<span style="color:#f18545;"><?php echo (in_array($book['start_from'], $terminal)?$book['start_from']:$book['collaborators_name']).'/'.(in_array($book['end_at'], $terminal)?$book['end_at']:$book['collaborators_name']); ?></span></td>
								</tr>
							</tbody>
						</table>
						</div>
						<div class="col-sm-2" style="padding-top:20px;border-top:1px solid black;">
							<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/shuttles/form/'.$book['book_id']); ?>">
								<i class="entypo-pencil"></i>
							</a>
						</div>
						</div>
					</div>
					<?php	
					}
					?>
					<div class="row">
						<div class="col-sm-11">
							<div class="col-sm-12">
								<span style="color:#F27D00;text-transform:uppercase;float:right;font-size:16px;font-weight:bold;"><?php echo lang('avail_seats').' : '.$seats; ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-11">
							<div class="col-sm-12">
								<span style="color:#F27D00;text-transform:uppercase;float:right;font-size:16px;font-weight:bold;"><?php echo lang('return_seats').' : '.$return_seats; ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:15px;">
		<div class="col-sm-10 pull-right">
			<button class="btn btn-danger print btn-lg" style="padding:10px 16px;width:30%;margin:0px 0px 0px 10px;" name="btn_print" value="1" onclick="window.print();return false;">
				Print
			</button>
		</div>
	</div>
</form>
