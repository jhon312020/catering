<div class="headerbar">
	<h1><?php echo lang('bcn_area_address'); ?></h1>
</div>
<form method="post" class="form-horizontal" >
	<div class="row">
		<div class="col-md-6">
			<?php 
			echo $this->layout->load_view('layout/alerts'); 
			foreach($error as $er){
			?>	
				<div class="alert alert-danger"><?php echo $er; ?></div>
			<?php } ?>
			<div class="panel minimal minimal-gray">
				<div class="panel-heading"></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo lang('postal_code'); ?>: </label>
						<div class="col-sm-8">
							<?php echo form_input(array('name'=>'postal_code', 'class'=>'form-control', 'value'=>$this->mdl_bcnareas_address->form_value('postal_code'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo 'Bareclona Area '.lang('name'); ?>: </label>
						<div class="col-sm-8">
							<?php 
								echo form_dropdown('bcnarea_id', $bcn_areas, $this->mdl_bcnareas_address->form_value('bcnarea_id'), 'class="form-control"' ); 
							?>
						</div>
					</div>
					<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</div>
		<div class="col-md-6"></div>
	</div>
</form>