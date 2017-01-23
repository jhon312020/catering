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
	<?php
	//print_r($bottom_data);die;
	if(count($top_data) > 0){
		foreach($top_data as $data){
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
	<div class="banner" style="background-image:url(<?php echo $template_path; ?>/images/partner.jpg);">
		<p>Lorem ipsum velatio</p>
		<h1><span>PARTNERS</span></h1>
	</div>
	<?php	
	}
	?>
		<hr>
	</header>	
	<div class="container">
	<?php
	foreach($top_data as $data){
	?>
	<div class="row">
	<div class="col-sm-12 text-justify sub-head"><p><?php echo ($ln == 'en')?$data->content_en:$data->content_es; ?></p></div>
	</div><br>
	<?php } ?>	
	<div class="row partner">
	<?php
	foreach($bottom_data as $data){
	?>
	<div class="col-xs-6 col-sm-4 col-md-3"><a href="<?php echo $data->url; ?>" target="_blank"><img src="<?php echo $template_path; ?>/images/partners/<?php echo $data->logo; ?>" class="img-responsive"></a></div>
	<?php
	}
	?>
	</div>
	
	</div>

<?php $this->load->view('footer');?>