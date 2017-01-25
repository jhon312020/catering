<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('legal_condition'); ?> </h1>
	</div>
</div>
<div class="row">
	<?php 
	echo $this->layout->load_view('layout/alerts'); 
	?>	
</div>	
<div class="row" id="business">
	<div class="col-md-12 martop">
		<div class="form-content">
			<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
				<div class="form-group">
					<div class="col-sm-12">
						<?php echo $this->ckeditor->editor("conditions", $this->mdl_conditions->form_value('conditions'));?>
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