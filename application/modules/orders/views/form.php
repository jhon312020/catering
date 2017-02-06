<style type="text/css">

</style>
<?php
$readonly = ($readonly)?'readonly':'';
$order_date = date('d/m/Y', strtotime($order->order_date));

$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('menu'); ?> 
			<span class="dateSpan"><?php echo $order_date; ?> </span>
		</h1>
	</div>
</div>
	<div class="row">
		<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	} ?>
	</div>	
	<div class="row" id="business">
		<div class="col-md-12 martop menuList">
			<div class="form-content">
				<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group">
						<div class="col-sm-12">
						<p><span><?php echo lang('menu_type'); ?></span> : <span><?php echo lang('menu').' '.$order->menu_name; ?></span></p>
						<p><span><?php echo lang('client_code'); ?></span> : <span><?php echo $order->client_code; ?></span></p>
						<p><span><?php echo lang('name'); ?></span> : <span><?php echo $order->name; ?></span></p>
						<p><span><?php echo lang('business'); ?></span> : <span><?php echo $order->business; ?></span></p>
						<p><span><?php echo lang('email'); ?></span> : <span><?php echo $order->email; ?></span></p>
						<p><span><?php echo lang('telephone'); ?></span> : <span><?php echo $order->telephone; ?></span></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('primary_plate');?>: </label>
						<div class="col-sm-10">
							<?php echo form_dropdown('primary_plate', $primary, $order->order_type == 'primary' || $order->order_type == 'both' ? $order->menu_id : '', 'class="form-control" '.$disabled.''); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('secondary_plate');?>: </label>
						<div class="col-sm-10">
							<?php echo form_dropdown('secondary_plate', $secondary, $order->order_type == 'secondary' || $order->order_type == 'both' ? $order->menu_id : '', 'class="form-control" '.$disabled.''); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
						<?php echo $this->layout->load_view('layout/header_buttons'); ?>
						</div>
					</div>
			</form>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
});
</script>