<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php  echo lang('contacts'); ?> </h1>
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
							<label class="col-sm-2 pull-left"><?php echo lang('name'); ?>: </label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="name" id="name" value="<?php echo $this->mdl_contacts->form_value('name'); ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 pull-left "><?php echo lang('email'); ?>: </label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="email" id="email" value="<?php echo $this->mdl_contacts->form_value('email'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 pull-left"><?php echo lang('address'); ?>: </label>
							<div class="col-sm-10">
								<textarea class="form-control" name="address" id="address" rows=3><?php echo $this->mdl_contacts->form_value('address'); ?></textarea>
							</div>
						</div>
            <div class="form-group">
							<label class="col-sm-2 pull-left"><?php echo lang('telephone'); ?>: </label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="telephone" id="telephone" value="<?php echo $this->mdl_contacts->form_value('telephone'); ?>">
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
