<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
	$matches = array();
	$pattern = '/[A-Za-z0-9_-]+@[A-Za-z0-9_-]+\.([A-Za-z0-9_-][A-Za-z0-9_]+)/';
	preg_match($pattern,$address,$matches);
	if(count($matches) > 0){
		$address = str_replace($matches[0], '<a style="color:#ec7124;" href="mailto:'.$matches[0].'">'.$matches[0].'</a>', $address);
	}
?>
<header id="header" class="container text-center">
	<hr class="mob-show mob-hr-line">
	<?php
	//print_r($bottom_data);die;
	if(count($top_data) > 0){
		foreach($top_data as $data){
	?>
	<div class="banner mob-hide" style="background-image:url(<?php echo $template_path; ?>/images/captions/<?php echo $data->image; ?>);">
		<p><?php echo ($ln == 'en')?$data->title_en:$data->title_es; ?></p>
		<h1><span><?php echo ($ln == 'en')?$data->subtitle_en:$data->subtitle_es; ?></span></h1>
	</div>
	<?php
		}
	}
	else{
	?>
	<div class="banner" style="background-image:url(<?php echo $template_path;?>images/contacto.jpg);">
		<p>Lorem ipsum velatio</p>
		<h1><span>CONTACTO</span></h1>
	</div>
	<?php	
	}
	?>
	<hr class="mob-hide">
</header>
<div class="container" id="contactus">
	<div class="row">
		<div class="col-sm-5 orange">
			<!--<p>Datos de contacto:</p> <p>Calle Font, 16 <br> 08960, Sant Just Desvern, Barcelona<br>Telf. 902 76 67 66</p>-->
			<p class="mob-pad-top"><?php echo lang('contact_details'); ?></p><p><?php echo (isset($address))?$address:''; ?>
			<br>Telf. <?php echo (isset($telephone))?$telephone:''; ?></p>
			<p>&nbsp;</p>
		</div>
		<div class="col-sm-7">
			<div class="col-xs-12">
				<div class="row contacto">
					<form method="post" name="contact_form">
						<div class="form-group col-sm-12 contacto_title"><?php echo lang('send_us_your_suggestion'); ?></div>
						<div class="form-group col-sm-12">
							<?php echo lang('we_will_contact_with_you_as_soon_as_possible'); ?>
							<hr style="margin-bottom:5px;">
						</div>
						<div class="form-group col-sm-6">
							<input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('name_and_surname'); ?>" required>
							<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
							<hr class="mob-hide">
							<button type="submit" id="form-submit" class="btn btn-lg btn-block mob-hide"><?php echo lang('send'); ?></button>
						</div>
						<div class="form-group col-sm-6 con_msg">
							<textarea name="description" id="description" class="form-control" rows="8" placeholder="<?php echo lang('Comment'); ?>" required></textarea>
							<hr class="mob-show">
							<button type="submit" id="form-submit" class="btn btn-lg btn-block mob-show"><?php echo lang('send'); ?></button>
						</div>
					</form>
		        </div>
				<div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer');?>