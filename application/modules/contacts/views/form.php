<form method="post" class="form-horizontal" enctype="multipart/form-data" >

    <div class="headerbar">
        <h1><?php echo lang('contacts'); ?></h1>
        
    </div>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->layout->load_view('layout/header_buttons'); ?>
		</div>
	</div>
    <div class="content">

        <?php echo $this->layout->load_view('layout/alerts'); ?>

        <div id="userInfo">

			<div class="panel minimal minimal-gray">
				<div class="panel-heading">
				<div class="panel-title"></div>
				<div class="panel-options">

				</div>
			</div>
			
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active" idd="profile-1">
						<?php /*<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('address') . " 1"; ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="address_line1" id="address_line1" value="<?php echo $this->mdl_contacts->form_value('address_line1'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('address') . " 2"; ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="address_2" id="address_2" value="<?php echo $this->mdl_contacts->form_value('address_line2'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('city'); ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="city" id="city" value="<?php echo $this->mdl_contacts->form_value('city'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('country'); ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="country" id="country" value="<?php echo $this->mdl_contacts->form_value('country'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('phone') . " 1"; ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="phone_1" id="phone_1" value="<?php echo $this->mdl_contacts->form_value('phone_1'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('phone')  . " 2"; ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="phone_2" id="phone_2" value="<?php echo $this->mdl_contacts->form_value('phone_2'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('fax'); ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="fax" id="fax" value="<?php echo $this->mdl_contacts->form_value('fax'); ?>">
							</div>
						</div> */ ?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('email'); ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="email" id="email" value="<?php echo $this->mdl_contacts->form_value('email'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('name'); ?>: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="name" id="name" value="<?php echo $this->mdl_contacts->form_value('name'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('description'); ?>: </label>
							<div class="col-sm-5">
								<textarea class="form-control" name="description" id="description" style=""><?php echo $this->mdl_contacts->form_value('description'); ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</form>
