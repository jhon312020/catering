<script type="text/javascript">

</script>

<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>

<form method="post" role="form" class="form-horizontal form-groups-bordered">

    <div class="headerbar">
        <h1><?php echo lang('user_form'); ?></h1>
    </div>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->layout->load_view('layout/header_buttons'); ?>
		</div>
	</div>
    <div class="content">

        <?php echo $this->layout->load_view('layout/alerts'); ?>

        <div id="userInfo">

            <fieldset>
                <legend><?php echo lang('account_information'); ?></legend>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('first_name'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $this->mdl_users->form_value('first_name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('last_name'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $this->mdl_users->form_value('last_name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('email_address'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $this->mdl_users->form_value('email'); ?>">
                    </div>
                </div>

                <?php if (!$id) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('password'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('verify_password'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="user_passwordv" id="user_passwordv">
                    </div>
                </div>
                <?php } else { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('change_password'); ?>: </label>
                    <div class="col-sm-5">
                    <?php echo anchor('admin/users/change_password/' . $id, lang('change_password')); ?>
                    </div>
                </div>
                <?php } ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('user_type'); ?></label>
                    <div class="col-sm-5">
                        <select class="form-control" name="role" id="role">
                            <option value=""></option>
                            <?php foreach ($user_types as $key => $type) { ?>
                            <option value="<?php echo $key; ?>" <?php if ($this->mdl_users->form_value('role') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </fieldset>

            <!-- <div id="administrator_fields">
                <fieldset>
                    <legend>Address</legend>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('street_address'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_address_1" id="user_address_1" value="<?php echo $this->mdl_users->form_value('user_address_1'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('street_address_2'); ?>: </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="user_address_2" id="user_address_2" value="<?php echo $this->mdl_users->form_value('user_address_2'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('city'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_city" id="user_city" value="<?php echo $this->mdl_users->form_value('user_city'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('state'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_state" id="user_state" value="<?php echo $this->mdl_users->form_value('user_state'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('zip_code'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_zip" id="user_zip" value="<?php echo $this->mdl_users->form_value('user_zip'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('country'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_country" id="user_country" value="<?php echo $this->mdl_users->form_value('user_country'); ?>">
                        </div>
                    </div>
                </fieldset>

                <fieldset>

                    <legend><?php echo lang('contact_information'); ?></legend>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('phone_number'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_phone" id="user_phone" value="<?php echo $this->mdl_users->form_value('user_phone'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('fax_number'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_fax" id="user_fax" value="<?php echo $this->mdl_users->form_value('user_fax'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('mobile_number'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_mobile" id="user_mobile" value="<?php echo $this->mdl_users->form_value('user_mobile'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('web_address'); ?>: </label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="user_web" id="user_web" value="<?php echo $this->mdl_users->form_value('user_web'); ?>">
                        </div>
                    </div>

                </fieldset>

            </div> -->
            
            

        </div>

    </div>

</form>
