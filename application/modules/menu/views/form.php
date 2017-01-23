<script type="text/javascript">

</script>

<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>

<form method="post" class="form-horizontal">

    <div class="headerbar">
        <h1>Menu</h1>
        <?php echo $this->layout->load_view('layout/header_buttons'); ?>
    </div>

    <div class="content">

        <?php echo $this->layout->load_view('layout/alerts'); ?>

        <div id="userInfo">

            <fieldset>
                <legend>Description</legend>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Title: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $this->mdl_menu->form_value('title'); ?>">
                    </div>
                </div>
                                
				<div class="form-group">
                    <label class="col-sm-3 control-label">Url: </label>
                    <div class="col-sm-5">
                        <?php echo site_url('page')."/" ;?><input class="form-control" type="text" name="url" id="url" value="<?php echo $this->mdl_menu->form_value('url'); ?>">
                    </div>
                </div>
            </fieldset>


        </div>

    </div>

</form>
