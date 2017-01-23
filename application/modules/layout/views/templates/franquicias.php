<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
?>
	<style>
	.parajustigy > p {
		text-align:justify;
	}
	.divalign{
		margin-bottom:4px;
	}
	</style>
	<header id="header" class="container text-center">
	<hr class="mob-show mob-hr-line">
	<?php
	//print_r($bottom_data);die;
	if(count($bottom_data) > 0){
		foreach($bottom_data as $data){
	?>
	<div class="banner" style="background-image:url(<?php echo $template_path; ?>/images/captions/<?php echo $data->image; ?>);">
		<p><?php echo ($ln == 'en')?$data->title_en:$data->title_es; ?></p>
		<h1><span><?php echo ($ln == 'en')?$data->subtitle_en:$data->subtitle_es; ?></span></h1>
	</div>
	<?php
		}
	}
	else{
	?>
	<div class="banner" style="background-image:url(<?php echo $template_path; ?>/images/franquicias.jpg);">
		<p>Lorem ipsum velatio</p>
		<h1><span>FRANQUICIAS</span></h1>
	</div>
	<?php	
	}
	?>
		<hr>
	</header>
	<?php
	foreach($bottom_data as $data){
	?>
	<div class="container" id="franqucias">
	<div class="row">
	<div class="col-sm-12 text-justify sub-head"><p><?php echo ($ln == 'en')?$data->content_en:$data->content_es; ?></p></div>
	</div>
	<div class="row">
		<div class="col-sm-6 parajustigy">
		<?php
		$subcontent = ($ln == 'en')?$data->subcontent_en:$data->subcontent_es;
		$result = explode('</p>', $subcontent);
		foreach($result as $key=>$value){
		?>
			<?php echo $value; ?>
		<?php
		}
		?>
		</div>
		<div class="col-sm-6">
		<div class="col-xs-12">
				<div class="row contacto" style="padding-bottom: 20px;">
					<form method="post" name="contact_form">
						<div class="form-group col-sm-12 contacto_title" style="text-align:center;"><?php echo lang('request_more'); ?></div>
						<div class="form-group col-sm-12" style="font-size:16.67px;text-align:center;">
							<?php echo lang('contact_with'); ?>
							<hr style="margin-bottom:5px;">
						</div>
						<div class="form-group col-sm-12 divalign" style="margin-bottom: 4px;">
							<label class="col-sm-4"><?php echo lang('name_and_surname'); ?></label>
							<div class="col-sm-8">
							<input type="text" class="form-control" name="First name" id="first_name" required>
							</div>
						</div>
						<!-- <div class="form-group col-sm-12 divalign">
							<label class="col-sm-4"><?php //echo lang('surname'); ?></label>
							<div class="col-sm-8">
							<input type="text" class="form-control" name="Surname" id="sur_name" required>
							</div>
						</div> -->
						<!-- <div class="form-group col-sm-12 divalign">
							<label class="col-sm-4"><?php //echo lang('zone'); ?></label>
							<div class="col-sm-8">
							<input type="text" class="form-control" name="Area" id="area" required>
							</div>
						</div> -->
						<div class="form-group col-sm-12 divalign">
							<label class="col-sm-4"><?php echo lang('email'); ?></label>
							<div class="col-sm-8">
							<input type="email" class="form-control" name="Mail" id="mail" required>
							</div>
						</div>
						<div class="form-group col-sm-12 divalign">
							<label class="col-sm-4"><?php echo lang('phone'); ?></label>
							<div class="col-sm-8">
							<input type="text" class="form-control" name="Phone" id="phone" required>
							</div>
						</div>
						<div class="form-group col-sm-12 divalign">
							<label class="col-sm-4"><?php echo lang('fran_Comment'); ?></label>
							<div class="col-sm-8">
							<textarea class="form-control" name="Comment" id="comment" required style='height:75px'></textarea>
							<!-- <input type="text" class="form-control" name="Comment" id="comment" required> -->
							</div>
						</div>
						<div class="form-group col-sm-12 divalign">
							<label class="col-sm-4">&nbsp;</label>
							<div clas="col-sm-8" style="margin-right:15px;">
								<button type="submit" id="form-submit" style="width: 143px; font-size: 20px; float: right; right: 23px;" class="btn btn-lg btn-block"><?php echo lang('send'); ?></button>
							</div>
						</div>		
					</form>
		        </div>
				<div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
			</div>
		</div>
	<!--<div class="col-sm-6"><p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>-->
	</div>
	
	</div>
	<?php
	}
	?>
<?php $this->load->view('footer');?>
<script>
$('.parajustigy:first p:first').css('color', '#F49C1F');
</script>
