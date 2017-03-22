<?php
$this->load->view('header');
?>
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
              <p><?php echo lang('registry_header_text'); ?>.</p>
            </div>
          </div>
          <div class="form-bottom">
            <?php echo $this->layout->load_view('layout/web_alerts'); ?>
            <form role="form" action="" method="post" class="login-form" data-toggle="validator">
              <div class="form-group">
                <label class="sr-only" for="form-username"><?php echo lang('name'); ?></label>
                <input type="text" name="name" id = "form-username" placeholder="<?php echo lang('name'); ?>" class="form-username form-control" 
                  data-error="<?php echo lang('name_error'); ?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-surname"><?php echo lang('surname'); ?></label>
                <input type="text" name="surname" id = "form-surname" placeholder="<?php echo lang('surname'); ?>" class="form-username form-control" 
                  data-error="<?php echo lang('surname_error'); ?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-email">Email</label>
                <input type="email" name="email" id="form-email" placeholder="Email" class="form-username form-control" 
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                  data-error="<?php echo lang('invalid_email'); ?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password"><?php echo lang('password');?></label>
                <input type="password" name="password" id="form-password" placeholder="<?php echo lang('password');?>" class="form-password form-control" 
                  data-error="<?php echo lang('password_error');?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-business"><?php echo lang('business');?></label>
                <input type="text" name="client_business_name" id="client_business_name" placeholder="<?php echo lang('reg_business'); ?>" class="form-control" 
                  data-error="<?php echo lang('bussiness_error');?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox" name="terms" value="1" 
                    required 
                    data-error="<?php echo lang('checkbox_error');?>"
                    style="position:relative;top:2px;"> <a href="<?php echo site_url(PAGE_LANGUAGE); ?>/terms" target="_blank" class="btn btn-link"><?php echo lang('accept_terms'); ?></a>
                </label>
                <div class="help-block with-errors"></div>
              </div>
              <button type="submit" class="btn log_in center-block"><?php echo lang('create_account');?></button>
            </form>
            <div class="register">
              <p><?php echo lang('already_have_acc');?></p>
              <a href="<?php echo site_url(PAGE_LANGUAGE); ?>" class="btn btn-link center-block"><?php echo lang('enter'); ?></a>
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
