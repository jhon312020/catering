<!-- Javascript -->
<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap-datepicker.min.js"></script>

		
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/jquery.backstretch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/load-save.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/web_custom.js"></script>
<?php if (isset($backstretch) && $backstretch) { ?>
	<script type='text/javascript'>
		/*
				Fullscreen background for login and register
		*/
		$.backstretch("<?php echo TEMPLATE_PATH; ?>backgrounds/1.jpg");
	</script>
<?php } ?>
<!-- Google Analytics for gumen -->
<script type='text/javascript'>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-365764-37', 'auto');
  ga('send', 'pageview');
</script>
<!-- End of Google Analytics -->
<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->
</div>
</body>
</html>
