<?php
$name = (is_numeric($this->uri->segment(4)))?$this->uri->segment(5):$this->uri->segment(4);
?>
<form method="post" class="form-horizontal" enctype="multipart/form-data" >
	<div class="headerbar">
		<h1><?php echo lang(($name == 'aboutus')?'about_us_title':$name); ?></h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="pull-right">
				<button class="btn btn-primary" name="btn_submit" value="1"><i class="icon-ok icon-white"></i> <?php echo lang('save'); ?></button>
				<?php
				if(!in_array($name, array('franchises', 'aboutus', 'concierge', 'terms_and_conditions'))){
				?>
				<button class="btn btn-danger" name="btn_cancel" value="1"><i class="icon-remove icon-white"></i> <?php echo lang('cancel'); ?></button>
				<?php
				}
				?>
			</div>
		</div>
	</div>
    <div class="content">
        <?php echo $this->layout->load_view('layout/alerts'); ?>
        <div id="userInfo">
			<div class="panel minimal minimal-gray">
				<!--<div class="panel-heading">
					<div class="panel-title">Add <?php echo lang($name);?></div>
				</div>-->
			<div class="panel-body">
				<?php
				if($name != 'faq'){
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('title') . ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="title_en" name="title_en" value="<?php echo $this->mdl_captions->form_value('title_en'); ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('subtitle'). ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="subtitle_en" name="subtitle_en" value="<?php echo $this->mdl_captions->form_value('subtitle_en'); ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('title') . ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="title_es" name="title_es" value="<?php echo $this->mdl_captions->form_value('title_es'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('subtitle'). ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="subtitle_es" name="subtitle_es" value="<?php echo $this->mdl_captions->form_value('subtitle_es'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('image'); ?>: </label>
					<div class="col-sm-5">
						<input name="logo" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
						<?php if($this->mdl_captions->form_value('image')){ ?>
						<img src="<?php echo $path . $this->mdl_captions->form_value('image'); ?>" width="150">
						<?php } ?>
					</div>
				</div>
				<?php
				}
				if($name != 'contacts') {
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('content') . ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<textarea class="form-control" type="text" id="content_en" name="content_en"><?php echo $this->mdl_captions->form_value('content_en'); ?></textarea>
					</div>
				</div>
				<?php if($name != 'partners'){ ?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('subcontent'). ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<?php echo $this->ckeditor->editor("subcontent_en", $this->mdl_captions->form_value('subcontent_en'));?>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('content') . ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<textarea class="form-control" type="text" id="content_es" name="content_es"><?php echo $this->mdl_captions->form_value('content_es'); ?></textarea>
					</div>
				</div>
				<?php if($name != 'partners'){ ?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('subcontent'). ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<?php echo $this->ckeditor->editor("subcontent_es", $this->mdl_captions->form_value('subcontent_es'));?>
					</div>
				</div>
				<?php } ?>
				<?php
				}
				if($name == 'contacts') {
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('address'); ?>: </label>
					<div class="col-sm-5">
						<textarea  class="form-control" name="settings[address]" ><?php echo $this->mdl_settings->setting('address'); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('telephone_no'); ?> : </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="settings[telephone]" class="input-small" value="<?php echo $this->mdl_settings->setting('telephone'); ?>">
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
    </div>
</form>
