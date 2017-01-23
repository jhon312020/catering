<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
?>
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
	.panel-heading{
		border:none !important;
	}
	.btn {
		background-color: #5bc0de;
	}
	.btn-sm {
		padding : 12px 9px;
		border-radius: 30px;
	}
	.table > thead > tr > th {
	    font-weight: bold !important;
	    border: 1px solid #ddd !important;
	    border-bottom: 2px solid #ddd !important;
	}
	.table thead tr {
		background-color: #e4e4e4;
	}
	.table tbody tr:nth-child(even) {
		background-color: #e4e4e4;	
	}
	.table tbody tr td, .table thead tr th {
		padding-top:20px;
		text-align: center;
		vertical-align: middle;
		padding-bottom:20px;
		background-color: unset !important;
		color:#45234b !important;
	}
	.data-table td {
	    white-space: nowrap;
	    text-overflow: ellipsis;
	    overflow: hidden;
	}
	table.dataTable.no-footer {
		border-bottom: none;
	}
	#containter {
		background-color:#4C2454 !important;
	    height: 100px;
	    display: flex;
	    /* flex-direction: column;*/
	    align-items: center; 
	    font-size:14px;
		color: #fff;
	    /* justify-content: center;*/
	}
	.dataTables_filter > label {
		float: left !important;
		position: relative;
		left: -11px !important;
	}
	#content {}
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
	.inputtext {
		height: 31px;
		padding: 6px 12px;
		font-size: 12px;
		line-height: 1.42857143;
		color: #555555;
		background-color: #ffffff;
		background-image: none;
		border: 1px solid #ebebeb;
		border-radius: 3px;
		-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
		-moz-transition: border-color ease-in-out .15s, -moz-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		-webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		display: inline-block;
		width: 150px;
		margin-left: 5px;
	}

</style>
<div class="container">
	<div class="row">
		<div id="containter">
		    <div id="content" class="col-md-6 col-lg-6 col-sm-6" style="width: 50%;">
		    <?php echo Date('l d F Y'); ?>
		    </div>
		    <div id="dateSearch" style="text-align: right;display:none;" class="col-md-6 col-lg-6 col-sm-6">
				<form method="post" style="float:right;">
					<div class="input-group" style="width: 200px;float: right;">
				      <!--<input type="text" class="form-control" placeholder="Search for..." style="background-color: rgb(152, 123, 158) !important;border-color: rgb(152, 123, 158) !important;color: #000;" name="from_date" id="date2" value="<?php echo $this->input->post('from_date')?$this->input->post('from_date'):''; ?>">
				      <span class="input-group-btn">
				        <button class="btn btn-secondary" style="background-color: #fff;color: #000;" type="submit">Go!</button>
				      </span>-->
					  <input type="text" class="form-control" placeholder="Search for..." style="" name="from_date" id="date2" value="<?php echo $this->input->post('from_date')?$this->input->post('from_date'):''; ?>">
				      <span class="input-group-btn" style="background-color: #4C2454;border-color: #4C2454;">
				        <button class="btn btn-secondary" style="background-color: #4C2454;border-color: #4C2454;color: #fff !important;" type="submit">Go!</button>
				      </span>
					  
				    </div>
					
					<!--<label>
						Select Date:
						<input type="text" class="form-control input-sm inputtext" style="" name="from_date" id="date2" value="<?php echo $this->input->post('from_date')?$this->input->post('from_date'):''; ?>">
						<a href="<?php echo site_url($ln.'/booking_details') ?>" class="btn btn-sm btn-primary pull-right" style="text-align:right !important;padding:5px 10px;font-size:13px;margin-left: 10px;"><i class="entypo-cancel-circled"></i></a>
						<button class='btn btn-sm btn-primary pull-right' style="font-size:13px;padding:5px 10px;margin-left: 10px;" type="submit">Go</button>
					</label>-->
			    </form>
		    </div>
		</div>
	</div>
	<div class="row" style="margin-top: 50px;">
		<div class="table-responsive">
			<table class="table table-bordered datatable data_table" style="background-color: unset;">
				<thead>
					<tr style="background-color:#e4e4e4 !important">
						<!--<td><?php echo lang('trip_type'); ?></td>-->
						<th><?php echo lang('reference'); ?></th>
						<th><?php echo lang('name'); ?></th>
			            <!--<th><?php echo lang('date'); ?></th>-->
			            <th><?php echo lang('hour'); ?></th>
						<th><?php echo lang('from'); ?></th>
						<th><?php echo lang('to'); ?></th>
						<th><?php echo lang('price'); ?></th>
						<th><?php echo lang('passengers'); ?></th>
						<th><?php echo lang('payment_method'); ?></th>
						<th><?php echo lang('options'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($shuttles as $shuttle) {
						$clients = false;
						$arr = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
						if($shuttle->client_id)
							$clients = true;
						else
							$json = json_decode($shuttle->client_array,true);

						$address = $shuttle->mainaddress != '' && $shuttle->mainaddress != null ? $shuttle->mainaddress : $shuttle->col_address;
						$start_from = (in_array($shuttle->start_from, $arr))?$shuttle->start_from:$shuttle->name.' - '.$address;
						$end_at = (in_array($shuttle->end_at, $arr))?$shuttle->end_at:$shuttle->name.' - '.$address;
						if($shuttle->bcnarea_address_id != '') {
							if(!in_array($shuttle->start_from, $arr))
								$start_from = $shuttle->book_address;
							
							if(!in_array($shuttle->end_at, $arr))
								$end_at = $shuttle->book_address;
						}
					?>
					<tr>
						<!--<td><img src="<?php echo base_url().'assets/cc/images/'. (($shuttle->return_book_id > 0)?'round.png':'single.png'); ?>"></td>-->
						<td style="color:#F27D00 !important;"><?php echo $shuttle->reference_id.'-'.sprintf("%02d", $shuttle->id); ?></td>
						<td><?php echo $clients?$shuttle->first_name.' '.$shuttle->surname:$json['name'].' '.$json['surname']; ?></td>
						<!--<td><?php echo ($shuttle->start_journey)?date('d/m/Y', strtotime($shuttle->start_journey)):date('d-m-Y', strtotime($shuttle->return_journey)); ?></td>-->
						<td><?php echo date('H:i', strtotime($shuttle->hour)).'h'; ?></td>
						<td><?php echo $start_from; ?></td>
						<td><?php echo $end_at; ?></td>
						<td><?php echo $shuttle->price; ?></td>
						<td><?php echo $shuttle->adults + $shuttle->kids; ?></td>
						<td><?php 
							if($shuttle->book_status == 'completed')
								echo lang('online');
							else if($shuttle->book_status == 'cash')
								echo lang('cash_payment');
							else if($shuttle->book_status == 'paid')
								echo lang('pre_paid');

						 ?></td>
						<td>
							<a class="btn btn-info btn-sm" href="<?php echo site_url($ln.'/view_booking_details/' . $shuttle->id); ?>">
								<i class="entypo-eye"></i>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>	
	</div>
</div>
<?php $this->load->view('footer');?>
