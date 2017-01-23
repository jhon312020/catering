<div class="headerbar">
	<h1><?php echo lang('bcn_area'); ?></h1>
</div>
<form method="post" class="form-horizontal" >
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->layout->load_view('layout/alerts'); ?>
			<div class="panel minimal minimal-gray">
				<div class="panel-heading"></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-4 control-label">Zone No: </label>
						<div class="col-sm-8">
							<?php echo form_input(array('name'=>'zone', 'class'=>'form-control', 'value'=>$this->mdl_bcnareas->form_value('zone'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo 'Bareclona Area '.lang('name'); ?>: </label>
						<div class="col-sm-8">
							<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_bcnareas->form_value('name'))); ?>
						</div>
					</div>
					<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</div>
		<div class="col-md-6"></div>
	</div>
</form>