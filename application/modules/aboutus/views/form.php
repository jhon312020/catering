<form method="post" class="form-horizontal" enctype="multipart/form-data" >

    <div class="headerbar">
        <h1><?php echo lang('about'); ?></h1>
        
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
				<div class="panel-title">Add <?php echo lang('about');?></div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('title') . ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<textarea class="form-control" type="text" id="title_en" name="title_en"><?php echo $this->mdl_aboutus->form_value('title_en'); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('content'). ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<?php echo $this->ckeditor->editor("content_en", $this->mdl_aboutus->form_value('content_en'));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('title') . ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="title_es" name="title_es" value="<?php echo $this->mdl_aboutus->form_value('title_es'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('content'). ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<?php echo $this->ckeditor->editor("content_es", $this->mdl_aboutus->form_value('content_es'));?>
					</div>
				</div>
			</div>
		</div>
    </div>
</form>
