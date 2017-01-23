<?php
//print_r($res);die;
?>
<style type="text/css">
	#DataTables_Table_0_wrapper,  #DataTables_Table_0_wrapper tbody tr td {
		border : none !important;
	}
	#DataTables_Table_0_wrapper .dataTables_length, #DataTables_Table_0_wrapper .dt-buttons, #DataTables_Table_0_wrapper .dataTables_filter, #DataTables_Table_0_wrapper .dataTables_info {
		display:none;
	}
	#DataTables_Table_0 thead {
		display: none;
	}
	#DataTables_Table_0 {
		border-bottom: none;
	}
	tbody li {
		padding: 5px; 
	}
	.tabinactive {
		padding: 15px 15px !important;
		background-color: #9099a8;
		color:#fff;
	}
	.zoneDiv {
		float: left;
		padding-left: 12px;
	}
	.lineDiv {
		width:75px;
		border-bottom:1px solid #ccc;
		float:left;
		height:10px;
		padding-right: 12px;
	}
	.hourDiv {
		color:#F27D00;
		float: left;
		padding-right: 12px;
	}
	ol li {
		padding : 5px;
		font-size: 12px;
	}
	@media (max-width: 1000px) {
		.lineDiv {
			width: 20px;
		}  
	}
</style>
<div class="headerbar">
	<h1><?php echo $this->mdl_cars->form_value('car_name'); ?></h1>
	<span style="color:#F27D00;font-size: 18px;"><?php echo date('j F Y'); ?></span>
</div>
<ul class="nav nav-tabs tabalign" style="">
    <li><a class="tabinactive" data-toggle="tab" href="#home"><?php echo lang('routes'); ?></a></li>
    <li class="active"><a class="tabinactive" data-toggle="tab" href="#menu1"><?php echo lang('reservation'); ?></a></li>
</ul>
<div class="tab-content">
	<div id="home" class="tab-pane fade">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel minimal minimal-gray">
					<div class="panel-heading headerbar"  style="margin-bottom: 10px !important;"><h1 style="font-size: 18px;"><?php echo lang('route'); ?></h1>
					</div>
					<div class="panel-body" style="padding: 0px;">
					<?php /*
						<table class="table datatable data_table1">
							<thead>
								<tr>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach($rsteps as $time=>$zone) {	
										if($i == 1 || $i%18 == 1) {
											echo "<tr><td>";
										}

										if($i == 1 || $i%6 == 1) {
											echo "<div class='col-md-4' style='padding: 0px;'><ol start='".$i."' style='padding: 0px;padding-left:10px;'>";
										}

								
										$zone_name = is_numeric($zone)?$bcn_array[$zone]:$zone;
								?>
											<li>
												<div class="firstspan" style="color:#F27D00;float: left; padding-right: 12px;"><?php echo date('H:i', strtotime($time)).'h'; ?></div>
												<div style="width:75px; border-bottom:1px solid #ccc; float:left;height:10px; padding-right: 12px;"></div>

												<div style="float: left; padding-left: 12px;"><?php echo $zone_name; ?></div>
											</li>
										<?php 

											if($i%6 == 0)
												echo "</ol></div>";	

											if($i%18 == 0)
												echo "</td></tr>";										

											$i++;
									}
								?>
							</tbody>
						</table>
						*/?>
						<?php 
						
						foreach ($routes as $key => $value) {
						?>
						<div class="col-sm-4 route_content">
							<div class="panel minimal minimal-gray" style="border : none;background-color: unset;">
								<div class="panel-heading headerbar"  style="border : none;border-bottom: 1px solid #876186;padding: 0px;"><h1><?php echo lang('routes').' '.$value['reference_id']; ?></h1></div>
								<div class="panel-body" style="padding: 0px;">
									<ol style="padding-left: 16px;" start="1">
										<?php	
										$steps = json_decode($value['steps'], true);
										foreach($steps['zone'] as $key=>$step) {
											$zone_name = is_numeric($step)?$bcn_array[$step]:$step;
											$time = $steps['hours'][$key].':'.$steps['minutes'][$key];
										?>
										<li>
											<div class="hourDiv" style=""><?php echo date('H:i', strtotime($time)).'h'; ?></div>
											<div class="lineDiv" style=""></div>

											<div class="zoneDiv" style=""><?php echo $zone_name; ?></div>
										</li>
										<?php } 
										?>								
									</ol>
								</div>
							</div>
						</div>
						<?php
						}
						?>

					</div>
				</div>
			</div>				
		</div>
	</div>
	<div id="menu1" class="tab-pane fade in active">	
		<div class="row">
			<div class="col-md-12">
				<div class="panel minimal minimal-gray">
					<div class="panel-heading headerbar"  style="margin-bottom: 10px !important;"><h1 style="font-size: 18px;"><?php echo lang('booking_list'); ?></h1></div>
					<div class="panel-body">
						<table class="table table-bordered datatable data_table" id="bookingTable">
							<thead>
								<tr>
									<th><?php echo lang('reference'); ?></th>
									<th><?php echo lang('name'); ?></th>
									<th><?php echo lang('hour'); ?></th>
									<th><?php echo lang('from'); ?></th>
									<th><?php echo lang('to'); ?></th>
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
										
									$address = $book['mainaddress'] != '' && $book['mainaddress'] != null?$book['mainaddress'] : $book['collaborator_address'];
									
									$start_from = (in_array($book['start_from'], $arr))?$book['start_from']:$book['name'].' - '.$address;
									$end_at = (in_array($book['end_at'], $arr))?$book['end_at']:$book['name'].' - '.$address;
									if($book['bcnarea_address_id'] != '') {
										if(!in_array($book['start_from'], $arr))
											$start_from = $book['book_address'];
										if(!in_array($book['end_at'], $arr))
											$end_at = $book['book_address'];
									}
								?>
									<tr>
										<td style="color:#F27D00;"><?php echo $book['reference_id'].'-'.sprintf("%02d", $book['round_trip'] == 1?$res[$book['id']]:$book['id']); ?></td>
										<td><?php echo $clients?$book['first_name'].' '.$book['surname']:$json['name'].' '.$json['surname']; ?></td>
										<td><?php echo date('H:i', strtotime($book['hour'])).'h'; ?></td>
										<td><?php echo $start_from; ?></td>
										<td><?php echo $end_at; ?></td>
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
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/shuttles/view/' . ($book['round_trip'] == 1?$res[$book['id']]:$book['id'])); ?>">
												<i class="entypo-eye"></i>
											</a>
											<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/shuttles/form/' . ($book['round_trip'] == 1?$res[$book['id']]:$book['id'])); ?>">
												<i class="entypo-pencil"></i>
											</a>
											<a class="btn btn-info btn-sm" href="javascript:void(0);" style="<?php echo $book['journey_completed'] == 1?'background-color: rgb(109, 224, 109) !important;border-color: rgb(109, 224, 109) !important;':'background-color: #e5900f !important;border-color: #e5900f !important;'; ?>">
												<i class="entypo-check"></i>
											</a>
											<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/shuttles/delete/' .($book['round_trip'] == 1?$res[$book['id']]:$book['id'])); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
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
	</div>	
</div>
<script>
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
if($(window).width() <= 1000) {
	$('.route_content').removeClass('col-sm-4');
	$('.route_content').addClass('col-sm-6');
	var elem = $('table');
	//$('.top_col_menu').css('width',elem.width() + 30);
}
</script>
