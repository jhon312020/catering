<?php
$this->load->view('header');
$this->load->view('navigation_menu');
$password = $this->mdl_clients->form_value('password');
if($this->mdl_clients->form_value('password') && !$this->input->post()) {
	$password = base64_decode($this->mdl_clients->form_value('password_key'));
	$password = substr($password, 0, -9);
}
//echo $password.'----------';die;
?>    
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
			<div class="row">
				<?php echo $this->layout->load_view('layout/alerts'); ?>
			</div>
      <div class="row">
        <h2 class="head_2"><?php echo lang('profile'); ?></h2>
        <div class="col-sm-12">
          <div class="col-sm-4 pad-R">
            <div class="form-bottom">
              <p><span><?php echo lang('name').' y '.lang('surname'); ?>:</span><span> <?php echo $this->mdl_clients->form_value('name').' '.$this->mdl_clients->form_value('surname'); ?></span></p>
              <p><span class="F-bold"><?php echo lang('business'); ?></span>:<span> <?php echo $this->mdl_clients->form_value('business_name'); ?></span></p>
              <p><span class="F-bold"><?php echo lang('client_code'); ?>:</span><span> <?php echo $this->mdl_clients->form_value('client_code'); ?></span></p>
            </div>
          </div>
					<form role="form" action="" method="post" class="login-form">
						<div class="col-sm-4 pad-R">
							<div class="form-bottom ribbon-down">
								<div id="ribbon-container">
									<a href="javascript:;" id="ribbon"><?php echo strtoupper(lang('personal_information')); ?></a>
								</div>
								<div class="form-group">
									<label for="form-username"><?php echo lang('email'); ?></label>
									<input type="email" name="email" placeholder="" class="form-email form-control" id="form-email" value="<?php echo $this->mdl_clients->form_value('email'); ?>">
								</div>
								<div class="form-group">
									<label for="form-password"><?php echo lang('password'); ?>(cambiar contrasena)</label>
									<input type="password" name="password" value="<?php echo $password; ?>" placeholder="" class="form-password form-control" id="form-password">
								</div>
								<div class="form-group">
									<label for="form-number"><?php echo lang('dni'); ?></label>
									<input type="text" name="dni" placeholder="" class="form-number form-control" id="form-number" value="<?php echo $this->mdl_clients->form_value('dni'); ?>">
								</div>
								<div class="form-group">
									<label for="form-number"><?php echo lang('telephone'); ?></label>
									<input type="text" name="telephone" placeholder="" class="form-number form-control" id="form-number" value="<?php echo $this->mdl_clients->form_value('telephone'); ?>">
								</div>
								<div class="form-group">
									<label for="form-text"><?php echo lang('intolerances'); ?></label>
									<input type="text" name="intolerances" placeholder="" class="form-text form-control" id="form-text" value="<?php echo $this->mdl_clients->form_value('intolerances'); ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div id="ribbon-container-green">
								<a class="ribbon_2" href="javascript:;" id="ribbon"><?php echo strtoupper(lang('payment_details')); ?></a>
							</div>
							<div class="form-bottom ribbon-down">
								<div class="form-group">
									<label for="form-username"><?php echo lang('iban'); ?></label>
									<input type="text" name="iban" placeholder="" class="form-username form-control" id="form-username" value="<?php echo $this->mdl_clients->form_value('iban'); ?>">
								</div>
								<div class="form-group">
									<label for="form-username"><?php echo lang('is_invoice'); ?></label>
									<br>
									<input class="checkbox-inline" name="bill" <?php echo $this->mdl_clients->form_value('bill') == 1?'checked':''; ?> type="checkbox" value="1"> <?php echo lang('yes'); ?>
									<input class="checkbox-inline" name="bill" <?php echo $this->mdl_clients->form_value('bill') == 0?'checked':''; ?> type="checkbox" value="0"> <?php echo lang('no'); ?>
								</div>
								<div class="form-group">
									<label for="form-message"><?php echo lang('billing_data'); ?>:</label>
									<textarea type="text" name="billing_data" id="billing_data" name="form-message" <?php echo $this->mdl_clients->form_value('bill') == 0?'disabled':''; ?> placeholder="" class="form-message form-control" id="form-message"><?php echo $this->mdl_clients->form_value('bill') == 1?$this->mdl_clients->form_value('billing_data'):'';; ?></textarea>
								</div>
							</div>
							<div class="form-group btn-update">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/profile.js"></script>
<?php
  $this->load->view('footer_nav_bar');
  $this->load->view('footer');
?>
