<form method="post" class="form-horizontal" enctype="multipart/form-data" >

    <div class="headerbar">
        <div class="clearfix">
        	<h1 class="pull-left"><?php echo lang('partners'); ?></h1>
			<?php echo $this->layout->load_view('layout/header_buttons'); ?>
		</div>
    </div>
    <div class="content">
        <?php echo $this->layout->load_view('layout/alerts'); ?>
        <div id="userInfo">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading">
				<!--<div class="panel-title">Add Partner</div> -->
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('name'); ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="name" name="name" value="<?php echo $this->mdl_partners->form_value('name'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('logo'); ?>: </label>
					<div class="col-sm-5">
						<input name="logo" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
						<?php if($this->mdl_partners->form_value('logo')){?>
						<img src="<?php echo $path . $this->mdl_partners->form_value('logo'); ?>" width="150">
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('url'); ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="url" name="url" value="<?php echo $this->mdl_partners->form_value('url'); ?>">
					</div>
				</div>
			</div>
		</div>
    </div>
</form>
