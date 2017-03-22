<!-- Javascript -->
<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap-datepicker.min.js"></script>

		
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/jquery.backstretch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/load-save.js"></script>
<?php if (isset($backstretch) && $backstretch) { ?>
	<script type='text/javascript'>
		/*
				Fullscreen background for login and register
		*/
		$.backstretch("<?php echo TEMPLATE_PATH; ?>backgrounds/1.jpg");
	</script>
<?php } ?>
<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->
</div>
</body>
</html>
