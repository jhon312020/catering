<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('car_navigation_menu');
?>
<style type="text/css">
.tabalign {
	position: relative;
	top: -45px;
	left: 91px;
	width: 200px;
	border-bottom: none;
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
@media (max-width: 1000px) {
	.lineDiv {
		width: 20px;
	}  
}
@media (max-width: 780px) {
  .tabalign {
		position: relative;
		top: -45px;
	}
}
@media (max-width: 767px) {
  .tabalign {
		position: relative;
		top: -42px;
	}
}
@media (max-width: 414px) {
  .tabalign {
		position: relative;
		top: -39px;
	}
	.lineDiv {
		width: 20px;
	}
}
.table tr th {
	border: 1px solid black;
}
ol li {
	padding : 5px;
	font-size: 12px;
}
.table > thead > tr > th {
    font-weight: bold;
    border: 1px solid #ddd;
    border-bottom: 2px solid #ddd;
}
.table thead tr {
	background-color: #e4e4e4;
}
.table tbody tr:nth-child(even) {
	background-color: #e4e4e4;	
}
.btn {
	background-color: #5bc0de;
}
.btn-sm {
	padding : 12px 12px;
	border-radius: 30px;
}
.table tbody tr td, .table thead tr th {
	padding-top:20px;
	text-align: center;
	vertical-align: middle;
	padding-bottom:20px;
}
.tabinactive {
	background-color: #9099a8;
	color:#fff;
}
</style>
<div class="container">
  <ul class="nav nav-tabs tabalign" style="">
    <li class="<?php echo $this->input->post('routes')? 'active':''; ?>"><a class="tabinactive" data-toggle="tab" href="#home"><?php echo lang('routes'); ?></a></li>
    <li class="<?php echo $this->input->post('routes')? '':'active'; ?>"><a class="tabinactive" data-toggle="tab" href="#menu1"><?php echo lang('reservation'); ?></a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade <?php echo $this->input->post('routes')? 'in active':''; ?>">
		<div class="row">
			<div class="col-sm-12">
	
				<?php 
				foreach ($routes as $key => $value) {
				?>
				<div class="col-sm-4 route_content">
					<div class="minimal minimal-gray" style="border : none;background-color: unset;box-shadow: unset;">
						<div class="panel-heading headerbar"  style="border : none;border-bottom: 1px solid #876186;padding: 0px;"><h1><?php echo lang('routes').' '.$value['reference_id']; ?></h1></div>
						<div class="panel-body" style="padding: 0px;padding-top:15px;">
							<ol style="padding-left: 16px;">
								<?php	
								$steps = json_decode($value['steps'], true);
								foreach($steps['zone'] as $key=>$step) {
									$zone_name = is_numeric($step)?$bcn_array[$step]:$step;
									$time = $steps['hours'][$key].':'.$steps['minutes'][$key];
								?>
								<li>
								<!--
								<table>
									<tbody>
										<tr>
											<td><div class="firstspan" style="color:#F27D00;float: left; padding-right: 12px;"><?php echo date('H:i', strtotime($time)).'h'; ?></div></td>
											<td><div style="width:75px; border-bottom:1px solid #ccc; float:left;height:10px; padding-right: 12px;"></div></td>
											<td><div style="float: left; padding-left: 12px;"><?php echo $zone_name; ?></div></td>
										</tr>
									</tbody>
								</table>
								-->
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
	<div id="menu1" class="tab-pane fade <?php echo $this->input->post('routes')? '':'in active'; ?>">	
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th><?php echo lang('reference'); ?></th>
						<th><?php echo lang('name'); ?></th>
						<th><?php echo lang('hour'); ?></th>
						<th><?php echo lang('from'); ?></th>
						<th><?php echo lang('to'); ?></th>
						<th><?php echo lang('passengers'); ?></th>
						<th><?php echo lang('price'); ?></th>
						<th style="width: 15%;"><?php echo lang('payment_method'); ?></th>
						<th style="width: 15%;"><?php echo lang('options'); ?></th>
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

						$address = $book['mainaddress'] != '' && $book['mainaddress'] != null ? $book['mainaddress'] : $book['address'];
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
							<td><?php echo $book['adults'] + $book['kids']; ?></td>
							<td><?php echo $book['price']; ?></td>
							<td><?php 
								if($book['book_status'] == 'completed')
									echo lang('online');
								else if($book['book_status'] == 'cash')
									echo lang('cash_payment');
								else if($book['book_status'] == 'paid')
									echo lang('pre_paid');

							 ?></td>
							<td>
								<a class="btn btn-info btn-sm" href="<?php echo site_url($ln.'/calendar_details/'.$book['id']); ?>">
									<i class="fa fa-eye"></i>
								</a>
								<a class="btn btn-primary btn-sm" href="<?php echo $book['journey_completed'] == 1?'javascript:void(0);':site_url('node/update_journey/'.$book['id']); ?>" style="<?php echo $book['journey_completed'] == 1?'background-color: rgb(109, 224, 109);':'background-color: #e5900f;'; ?>">
									<i class="fa fa-check"></i>
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
<script type="text/javascript">
	$(document).ready(function(){
		if($(window).width() <= 1000) {
			$('.route_content').removeClass('col-sm-4');
			$('.route_content').addClass('col-sm-6');
			var elem = $('table');
			//$('.top_col_menu').css('width',elem.width() + 30);
		}
	})
</script>
