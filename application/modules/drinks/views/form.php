<style type="text/css">

</style>
<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('cool_drinks'); ?></h1>
	</div>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
	<div class="row">
		<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	} ?>
	</div>	
	<div class="row" id="business">
		<div class="col-md-12">
			<div class="form-content">
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('drinks_name');?>: </label>
				<div class="col-sm-10">
					<?php echo form_input(array('name'=>'drinks_name', 'class'=>'form-control', 'value'=>$this->mdl_drinks->form_value('drinks_name'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
				<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">

</script>