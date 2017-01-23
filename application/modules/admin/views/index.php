<div class="headerbar">
	<h1><?php echo lang('dashboard'); ?></h1>
</div>
<br/>
<?php 
echo $this->layout->load_view('layout/alerts'); 
if($this->session->userdata('user_type') == '1') {
?>

<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#337ab7;">
			<div class="num" data-start="0" data-end="<?php echo $today_booking; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('today_booking'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#5cb85c;">
			<div class="num" data-start="0" data-end="<?php echo $today_passengers; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('today_passengers'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#d9534f;">
			<div class="num" data-start="0" data-end="<?php echo $today_sales; ?>" data-postfix="&euro;" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('today_sales'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#f0ad4e;">
			<div class="num" data-start="0" data-end="<?php echo $today_billing; ?>" data-postfix="&euro;" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('today_billing'); ?></h3></a>
		</div>
	</div>
</div>	
<div class="row">&nbsp;</div>
<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark">
			<div class="num" data-start="0" data-end="<?php echo $shuttles; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_shuttles'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-green-light">
			<div class="num" data-start="0" data-end="<?php echo $total_passengers; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_passengers'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-6">	
		<div class="tile-stats tile-green">
			<div class="num" data-start="0" data-end="<?php echo $total_price; ?>" data-postfix="&euro;" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_price'); ?></h3></a>
		</div>
	</div>
</div>
<?php } else if($this->session->userdata('user_type') == '6') { ?>

<div class="row">	
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark">
			<div class="num" data-start="0" data-end="<?php echo $shuttles; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_shuttles'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-pink-light">
			<div class="num" data-start="0" data-end="<?php echo $collaborators;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/collaborators/index'); ?>"><h3><?php echo lang('collaborators'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-aqua-light">
			<div class="num" data-start="0" data-end="<?php echo $clients; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/clients/index'); ?>"><h3><?php echo lang('clients'); ?></h3></a>
		</div>
	</div>
	<!--<div class="col-sm-3">	
		<div class="tile-stats tile-aqua-light">
			<div class="num" data-start="0" data-end="<?php echo $calendars;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/routes/calendar'); ?>"><h3><?php echo lang('calendar'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-pink">
			<div class="num" data-start="0" data-end="<?php echo $faq;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/faq/index'); ?>"><h3><?php echo lang('faq'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-green">
			<div class="num" data-start="0" data-end="<?php echo $routes;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/routes/schedule'); ?>"><h3><?php echo lang('routes'); ?></h3></a>
		</div>
	</div>-->
</div>
<div class="row">&nbsp;</div>
<?php } ?>
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
<script>
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
});
</script>