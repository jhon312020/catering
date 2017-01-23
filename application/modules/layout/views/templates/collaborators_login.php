
<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
?>
	<header id="header" class="container text-center">
	<hr class="mob-show mob-hr-line">
	<div class="banner" style="background-image:url(<?php echo $template_path; ?>/images/collaborators.jpg);">
			<p><?php echo $site_title; ?></p>
		<h1><span><?php echo lang('collaborators'); ?></span></h1>
	</div>
	<hr>
	</header>
		<div class="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width:340px;margin:auto;">
			<div class="modal-dialog" role="document" style="margin-top:1% !important;">
				<div class="modal-content" style="box-shadow:none;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><?php echo lang('login_title'); ?></h4>
					</div>
					<div class="modal-body">
						<div class="col-xs-12">
							<div class="row contacto">
								<form method="POST" class="validateForm">
									<input style="display:none" type="text" name="fakeusernameremembered"/>
									<input style="display:none" type="password" name="password"/>
								<br>
								<div class="form-group col-xs-12">
									<?php echo  form_input(array('name'=>'username', 'id'=>'username', 'type'=>'text', 'placeholder'=>lang('email'), 
														'class'=>'form-control', 'value'=>$this->mdl_users->form_value('user_name'))); ?>
								</div>
								<div class="form-group col-xs-12">
									<?php echo  form_input(array('name'=>'password', 'id'=>'password', 'type'=>'password', 'placeholder'=>lang('password'), 'class'=>'form-control')); ?>
								</div>
								<div id="select_ida" class="form-group col-xs-12" style="text-align:center;">
									<a href="recovery_password/collaborators" style="color:#fff;"><?php echo lang('password_recovery'); ?></a>
								</div>
								<div class="form-group col-xs-12"><hr></div>
								<div class="form-group col-xs-12">
									<button type="submit" class="btn btn-primary btn-lg pickbluebg btn-block" style="font-size:41.67px;font-family:FuturaStdBold;"><?php //echo lang('enter'); ?>Go</button>
								</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer"></div>
				</div>
			</div>
		</div>
		
<?php $this->load->view('footer');?>
