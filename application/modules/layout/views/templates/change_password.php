<?php
$this->load->view('header');
?>
<!-- Top content -->
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-sm-offset-4 form-box">
          <div class="form-top">
            <div class="logo-heading">
              <img src="<?php echo TEMPLATE_PATH; ?>gumen-logo.png" class="img-responsive center-block" alt="" />
            </div>
            <div class="logo-para">
              <h3><?php echo strtoupper(lang('reset_password_page_heading'));?></h3>
            </div>
          </div>
          <div class="form-bottom">
						<?php echo $this->layout->load_view('layout/web_alerts'); ?>
            <form role="form" action="" method="post" class="login-form" data-toggle="validator">
              <div class="form-group">
                <label class="sr-only" for="password"><?php echo lang('password'); ?></label>
                <input type="password" required name="password" placeholder="<?php echo lang('password'); ?>" class="form-username form-control" id="password" data-error="<?php echo lang('password_error'); ?>">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="password"><?php echo lang('confirm_password');?></label>
                <input type="password" required name="confirm_password" placeholder="<?php echo lang('confirm_password'); ?>" class="form-username form-control" id="confirm_password" data-error="<?php echo lang('confirm_password_error'); ?>">
                <div class="help-block with-errors"></div>
              </div>
              <button type="submit" class="btn center-block"><?php echo strtoupper(lang('enter')); ?></button>
            </form>
            <div class="register">
              <P><?php echo lang('already_have_acc');?></p>
              <a href="<?php echo site_url(PAGE_LANGUAGE.'/'); ?>" class="btn btn-link center-block"><?php echo lang('enter');?></a>
            </div>
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
