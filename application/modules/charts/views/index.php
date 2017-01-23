<?php 
foreach($error as $er){
?>	
<div class="alert alert-danger"><?php echo $er; ?></div>
<?php	
}
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('charts'); ?></h1>
		<div style="width:25%;" class="pull-right">
			<form method="POST" action="<?php echo site_url('/admin/charts/index');?>" id="dateRange">
				<label class="control-label clearfix" style="display:inline;">
					Select Date or Range:
					<?php
						if(isset($_POST['start_date']) && $_POST['start_date']){
							echo '<a href="'.site_url('/admin/charts/index').'" class="text-danger">clear range</a>';
						}
					?>
					<div class="input-group input-daterange pull-left" style="width:83%;">
						<?php echo form_input('start_date', Date('d/m/Y', strtotime($start_date)), 'class="form-control datepicker1"'); ?>
						<span class="input-group-addon">to</span>
						<?php echo form_input('end_date', Date('d/m/Y', strtotime($end_date)), 'class="form-control datepicker1"'); ?>
					</div>
					<button class='btn btn-sm btn-primary pull-right' style="font-size:13px;padding:5px 10px;" type="submit">Go</button>
				</label>
			</form>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#337ab7;">
			<div class="num" data-start="0" data-end="<?php echo $book_list['count']->book_count; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_shuttles'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#5cb85c;">
			<div class="num" data-start="0" data-end="<?php echo $book_bill['count']->book_bill; ?>" data-postfix="&euro;" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_billings'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#d9534f;">
			<div class="num" data-start="0" data-end="<?php echo $passenger_by_zone['count']->total_passengers; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_passengers'); ?></h3></a>
		</div>
	</div>
	<!--<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#f0ad4e;">
			<div class="num" data-start="0" data-end="<?php echo $today_billing = 0; ?>" data-postfix="&euro;" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_passengers_day'); ?></h3></a>
		</div>
	</div>-->
</div>	
<div class="row">&nbsp;</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Booking count</div>
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
							<strong style="">Total book count: <?php echo $book_list['count']->book_count; ?></strong>
							</div>
							<div id="book_count" style="height: 300px"></div>
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
				<div class="panel-title">Billing of the bookings per date</div>
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
							<!--<strong>Area Chart</strong>-->
							<div style="width:100%;text-align:center;">
							<strong style="">Total Billings: <?php echo $book_bill['count']->book_bill; ?></strong>
							</div>
							<div id="book_bill" style="height: 300px"></div>
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
				<div class="panel-title">Number of passenger by Zone and Date</div>
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
							<!--<strong>Area Chart</strong>-->
							<div style="width:100%;text-align:center;">
							<strong style="">Total Passengers: <?php echo $passenger_by_zone['count']->total_passengers; ?></strong>
							</div>
							<div id="passenger_zone" style="height: 300px"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default" data-collapsed="0">
			<!-- to apply shadow add class "panel-shadow" -->
			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title">Country of the passengers</div>
				<div class="panel-options">
					<!--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg">
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
			<!-- panel body -->
			<div class="panel-body no-padding"> 
				<div id="worldmap" style="height:450px;width:100%;" class="map">
				</div>
			</div>
		</div>
	</div>
</div>
<!--<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Billing of the collaborator per date.</div>
				<div class="panel-options">
				</div>
			</div>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td width="100%">
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
				</div>
			</div>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td width="100%">
							<div id="collaborator_book_passenger" style="height: 300px"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>-->

<script type="text/javascript">


$(document).ready(function(){

var myCustomColors = JSON.parse('<?php echo json_encode($passengers_country['country_color']); ?>')
var myCustomCount = JSON.parse('<?php echo json_encode($passengers_country['country_count']); ?>')
map = new jvm.WorldMap({
	map: 'world_mill_en',
	container: $('#worldmap'),
	backgroundColor: '#CCC',
	series: {
	regions: [{
	attribute: 'fill'}]
	},
	onRegionLabelShow: function(e, label, code) {
		//console.log(label)
		if (myCustomColors.hasOwnProperty(code)) {
			$('.jvectormap-label').html($('.jvectormap-label').html()+ '(' +myCustomCount[code]+ ')')
		}
	}
});
map.series.regions[0].setValues(myCustomColors);

//console.log(JSON.parse('<?php echo json_encode($book_list); ?>'))
	if(typeof Morris != 'undefined')
	{
		// Line Chart
		Morris.Line({
			element: 'book_count',
			data: JSON.parse('<?php echo json_encode($book_list['list']); ?>'),
			xkey: 'start_journey',
			ykeys: ['book_count'],
			labels: ['Book count'],
			parseTime: false,
			lineColors: ['#242d3c'],
			//events: ['2012-01-01', '2012-02-01', '2012-03-01'],
			dateFormat: function (d) {return d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear();},
			//xLabelFormat: function(d) { return d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear(); },
		});
		
		Morris.Area({
			element: 'book_bill',
			data: JSON.parse('<?php echo json_encode($book_bill['list']); ?>'),
			xkey: 'start_journey',
			ykeys: ['book_bill'],
			labels: ['Total price'],
			parseTime: false,
		});
		// Stacked Bar Charts
		Morris.Bar({
			element: 'passenger_zone',
			data: JSON.parse('<?php echo json_encode($passenger_by_zone['passenger_by_zone']); ?>'),
			xkey: 'start_journey',
			ykeys: JSON.parse('<?php echo json_encode($passenger_by_zone['bcn_no']); ?>'),
			labels: JSON.parse('<?php echo json_encode($passenger_by_zone['bcn_value']); ?>'),
			stacked: true,
			barColors: ['#337ab7', '#00a65a', '#303641']
		});
		/*Morris.Area({
			element: 'collaborator_book_bill',
			data: JSON.parse('<?php echo json_encode($collaborator_book_bill); ?>'),
			xkey: 'start_journey',
			ykeys: ['book_bill'],
			labels: ['Total price'],
			parseTime: false,
		});		
		Morris.Bar({
			element: 'collaborator_book_passenger',
			axes: true,
			data: JSON.parse('<?php echo json_encode($collaborator_book_count); ?>'),
			xkey: 'start_journey',
			ykeys: ['book_count', 'passenger_count'],
			labels: ['Book Count', 'Passenger count'],
			barColors: ['#707f9b', '#455064', '#242d3c']
		});*/
	}
});
</script>