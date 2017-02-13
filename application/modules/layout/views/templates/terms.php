<?php
$this->load->view('header');
?>
<!-- Top content -->
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-my-offset-2 form-box">
          <div class="form-top">
            <div class="logo-heading">
              <img src="<?php echo TEMPLATE_PATH; ?>gumen-logo.png" class="img-responsive center-block" alt="" />
            </div>
            <div class="logo-para">
              <p><?php echo lang('terms_and_conditions'); ?></p>
            </div>
          </div>
          <div class="form-bottom " id="conditions">
            <?php echo $conditions->conditions; ?>
            <?php if (!isset($user_info['client_name'])) { ?>
            <div class="register">
              <P><?php echo lang('do_not_have_account');?></p>
              <a href="<?php echo site_url(PAGE_LANGUAGE.'/register'); ?>" class="btn btn-link center-block"><?php echo lang('register');?></a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view('footer');
?>
<script>
/*
		Fullscreen background
*/
$.backstretch("<?php echo TEMPLATE_PATH; ?>backgrounds/1.jpg");
</script>
