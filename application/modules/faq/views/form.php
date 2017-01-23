<form method="post" class="form-horizontal" enctype="multipart/form-data" >

    <div class="headerbar">
        <h1><?php echo lang('faq'); ?></h1>
        
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
				<div class="panel-title">Add <?php echo lang('faq');?></div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('question') . ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="question" name="question" value="<?php echo $this->mdl_faq->form_value('question'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('answer'). ' (EN)'; ?>: </label>
					<div class="col-sm-5">
						<?php echo $this->ckeditor->editor("answer", $this->mdl_faq->form_value('answer'));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('question') . ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<input class="form-control" type="text" id="question_es" name="question_es" value="<?php echo $this->mdl_faq->form_value('question_es'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('answer'). ' (ES)'; ?>: </label>
					<div class="col-sm-5">
						<?php echo $this->ckeditor->editor("answer_es", $this->mdl_faq->form_value('answer_es'));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('category'); ?>: </label>
					<div class="col-sm-5">
						<?php
							$isEN = ($this->mdl_settings->setting('default_language') == 'english') ? true : false;
							$options = array(
								''=>'-- Select --',
								'category1' => $isEN ? 'Before my reservation' : 'Antes de mi reserva',
								'category2' => $isEN ? 'The day of my reservation' : 'El dia de mi reserva',
								'category3' => $isEN ? 'After my booking' : 'Despues de mi reserva',
							);
							echo form_dropdown('category', $options, $this->mdl_faq->form_value('category'), 'class="form-control"');
						?>
					</div>
				</div>
			</div>
		</div>
    </div>
</form>
