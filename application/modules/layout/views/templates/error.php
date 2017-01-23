<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
?>
<div class="container" id="aboutus">
	<div class="row">
		<div class="col-sm-12 text-justify sub-head" style="text-align:center;">
			<div class="alert alert-danger">Your PayPal transaction has been canceled.</div>
			<a href="<?php echo base_url() . 'index.php/'.$ln; ?>" >Return to home</a>
		</div>
	</div>
</div>	
	
<?php $this->load->view('footer');?>
