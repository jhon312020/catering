<?php
$this->load->view('header');
?>
<style type='text/css'>
@media (max-width: 768px) {
   .backstretch {
    display: block !important;
  }
}
h2 {
  color: white !important; 
  line-height: normal; 
  font-size: 35px; 
  text-align: center;
}
.form-top, .form-bottom {
  background: none !important;
}
p {
  border-top: none !important; 
  color: #fff;
}
.btn-link {
  color: #fff;
}
</style>
<!-- Top content -->
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-sm-offset-4 col-my-offset-4 form-box">
          <div class="form-top">
            <div class="logo-heading">
              <img src="<?php echo TEMPLATE_PATH; ?>gumen-logo.png" class="img-responsive center-block" alt="" />
            </div>
            <div class="logo-para">
            <h2>Hoyo como en la oficina como en casa</h2>
              <p>Rellene sus datos de acceso o regístrese para solicitar acceso a nuestro servicio de catering a empresas.</p>
            </div>
          </div>
          <div class="form-bottom">
						<?php echo $this->layout->load_view('layout/web_alerts'); ?>
            <form role="form" action="" method="post" class="login-form" data-toggle="validator">
              <div class="form-group">
                <label class="sr-only" for="form-username">Username</label>
                <input type="email" required name="email" placeholder="<?php echo lang('username'); ?>" class="form-username form-control" id="form-username" data-error="<?php echo lang('invalid_email'); ?>">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password">Password</label>
                <input type="password" name="password" placeholder="<?php echo lang('password'); ?>" class="form-password form-control" id="form-password" required data-error="<?php echo lang('password_error'); ?>">
                <div class="help-block with-errors"></div>
              </div>
              <div class="forget form-group">
                <a href="<?php echo site_url(PAGE_LANGUAGE.'/forgot_password'); ?>" class="btn btn-link"><?php echo lang('forgot_password');?></a>
              </div>
              <button type="submit" class="btn log_in center-block"><?php echo strtoupper(lang('enter')); ?></button>
            </form>
            <div class="register">
              <p><?php echo lang('do_not_have_account');?></p>
              <a href="<?php echo site_url(PAGE_LANGUAGE.'/register'); ?>" class="btn btn-link center-block"><?php echo lang('register');?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view('footer', array('backstretch'=>true));
?>