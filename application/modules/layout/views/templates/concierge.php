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
	<div class="banner" style="background-image:url(<?php echo $template_path; ?>/images/concier.jpg);">
			<p>Lorem ipsum velatio</p>
		<h1><span>CONCIERGE</span></h1>
	</div>
	<?php	
	}
	?>
		<hr>
	</header>
	<?php
	foreach($bottom_data as $data){
	?>
	<div class="container" id="concierge">
	<div class="row">
	<div class="col-sm-12 text-justify sub-head"><p><?php echo ($ln == 'en')?$data->content_en:$data->content_es; ?></p></div>
	</div>
	<div class="row">
		<?php
		$subcontent = ($ln == 'en')?$data->subcontent_en:$data->subcontent_es;
		$result = explode('</p>', $subcontent);
		
		foreach($result as $key=>$value){
		?>
			<div class="col-sm-6 parajustigy"><?php echo $value; ?></div>
		<?php
		}
		?>
	<!--<div class="col-sm-6"><p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>-->
	</div>
	
	</div>
	<?php
	}
	
	?>
<?php $this->load->view('footer');?>
<script>
$('.parajustigy:first p').css('color', '#F49C1F');
</script>