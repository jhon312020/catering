
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
		<h1><span><?php echo ($this->uri->segment(3) == 'clients')?lang('clients'):lang('collaborators'); ?></span></h1>
	</div>
	<hr>
	</header>
		<div class="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width:340px;margin:auto;">
			<div class="modal-dialog" role="document" style="margin-top:1% !important;">
				<div class="modal-content" style="box-shadow:none;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><?php echo lang('change_password'); ?></h4>
					</div>
					<div class="modal-body" style="background-color: unset;">
						<div class="col-xs-12">
							<div class="row contacto" style="background-color: unset;">
								<form method="POST" class="validateForm">
									<input style="display:none" type="text" name="fakeusernameremembered"/>
									<input style="display:none" type="password" name="password"/>
								<br>
								<!--<div class="form-group col-xs-12">
									<?php echo  form_input(array('name'=>'oldpassword', 'id'=>'oldpassword', 'type'=>'password', 'placeholder'=>lang('oldpassword'), 'class'=>'form-control')); ?>
								</div>-->
								<div class="form-group col-xs-12">
									<?php echo  form_input(array('name'=>'newpassword', 'id'=>'newpassword', 'type'=>'password', 'placeholder'=>lang('newpassword'), 'class'=>'form-control')); ?>
								</div>
								<div class="form-group col-xs-12">
									<?php echo  form_input(array('name'=>'user_passwordv', 'id'=>'user_passwordv', 'type'=>'password', 'placeholder'=>lang('repeatpassword'), 'class'=>'form-control')); ?>
								</div>
								<div class="form-group col-xs-12"><hr></div>
								<div class="form-group col-xs-12">
									<button type="submit" class="btn btn-primary btn-lg pickbluebg btn-block" style="font-size:30px;font-family:FuturaStdBold;white-space: normal;"><?php echo lang('change_password'); ?></button>
								</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer" style="background-color: unset;"></div>
				</div>
			</div>
		</div>
		
<?php $this->load->view('footer');?>
