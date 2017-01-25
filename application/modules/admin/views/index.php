<div class="headerbar">
	<h1><?php echo lang('dashboard'); ?></h1>
</div>
<br/>
<?php 
echo $this->layout->load_view('layout/alerts'); 
?>
<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#8EC63F;">
			<div class="num" data-start="0" data-end="<?php echo $today_menus; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('today_menus'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#BA9551;">
			<div class="num" data-start="0" data-end="<?php echo $total_clients; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_clients'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#8EC63F;">
			<div class="num" data-start="0" data-end="<?php echo $total_business; ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="javascript:void(0);"><h3><?php echo lang('total_business'); ?></h3></a>
		</div>
	</div>
</div>	
