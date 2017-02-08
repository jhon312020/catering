<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<style>
.datepicker-days tr {
	height:0px !important;
}
</style>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2"><?php echo lang('menu'); ?>: <?php echo date('l d F Y', strtotime($menu_date)) ?></h3>
        <div class="col-sm-12 menuhead">
          <div class="col-sm-8">
            <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
          </div>
          <div class="col-sm-4">
            <button type="button" class="btn btn-menu button-datepicker"><i class="fa fa-calendar" aria-hidden="true"></i>SELECCIONA OTRO DIA</button>
						<form method="post" id="menuListform">
							<input type='hidden' name="menu_date" class="form-control datepicker12" value="<?php echo $menu_date; ?>" />
						</form>
          </div>
        </div>
				<form action="<?php echo site_url('node/addMenu'); ?>" method="post" id="jsMenuForm">
				<input type="hidden" name="language" value="<?php echo PAGE_LANGUAGE; ?>">
				<?php
        //print_r($menu_types);
				$menu_list_with_id = [];
				foreach($menu_types as $key => $menu_type) {
					$checkboxClass = '';
					$headerClass = '-green';
					if($key%2 == 0) {
						$checkboxClass = '-brown';
						$headerClass = '';
					}
				?>
				<div class="clear-pad" style="clear:both">
				<div class="col-sm-12 section-down">
					<div id="ribbon-container<?php echo $headerClass; ?>" class="ribbon-fix">
            <a href="javascript:;" id="ribbon">MENU <?php echo $menu_type['menu_name'] ?></a>
          </div>
          <div class="menu-bottom jsMenuDiv">
						<?php 
						if(isset($menu_lists[$menu_type['id']])) {
							foreach($menu_lists[$menu_type['id']] as $menu_list) {
								$menu_list_with_id[$menu_list['id']] = $menu_list;
						?>
            <div class="row doublemenu jsSubMenu">
						<div class="col-sm-2 col-my-2 smallpad">
              <span class="menu-plus">+</span><span><img class="img-responsive img-marg" src="<?php echo TEMPLATE_PATH; ?>dish1.png"></span>
              <br>
              <span><?php echo $menu_list['complement']; ?></span>
            </div>
            <div class="col-sm-2 col-my-4 dishpad">
              <span class="menu-plus img-plus">+</span><span><img class="img-responsive menu-img" src="<?php echo MENU_IMAGE_PATH.$menu_list['primary_image']; ?>">
              <br>
              <span><?php echo $menu_list['primary_plate']; ?></span>
              <p class="menu-desc"><?php echo $menu_list['description_primary_plate']; ?></p>
              <span class="custom-checkbox col-sm-offset-5">
              <input type="checkbox" class="jsSelectMenu" name="select_food[<?php echo $menu_list['id']; ?>][]" value="primary" />
              <span class="box<?php echo $checkboxClass; ?>"><span class="tick"></span></span>
              </span>
            </div>
            <div class="col-sm-2 col-my-4 dishpad">
              <span class="menu-plus img-plus">+</span><img class="img-responsive menu-img" src="<?php echo MENU_IMAGE_PATH.$menu_list['secondary_image']; ?>">
              <br>
              <span><?php echo $menu_list['secondary_plate']; ?></span>
              <p class="menu-desc"><?php echo $menu_list['description_secondary_plate']; ?></p>
              <span class="custom-checkbox col-sm-offset-5">
              <input type="checkbox" class="jsSelectMenu" name="select_food[<?php echo $menu_list['id']; ?>][]" value="secondary" />
              <span class="box<?php echo $checkboxClass; ?>"><span class="tick"></span></span>
              </span>
            </div>
            <div class="col-sm-1 col-my-2 smallpad">
              <span class="menu-plus">+</span><img class="img-responsive img-marg" src="<?php echo TEMPLATE_PATH; ?>dish2.png">
              <br>
              <span><?php echo $menu_list['postre']; ?></span>
            </div>
            <div class="col-sm-1 col-my-3 smallpad">
              <span class="menu-plus">+</span><img class="img-responsive img-marg" src="<?php echo TEMPLATE_PATH; ?>dish6.png">
              <br>
              <span>Pa</span>
            </div>
						<div class="col-sm-1 col-my-2 smallpad multi-pad">
              <select class="selectpicker select-menu boostrap-multiselect" name="cool_drinks[<?php echo $menu_list['id']; ?>][]" multiple="multiple">
								<?php foreach($cool_drinks as $drinks) { ?>
									<option value="<?php echo $drinks->id; ?>"><?php echo $drinks->drinks_name;//.'---'.$drinks->price; ?></option>
								<?php } ?>
							</select>
            </div>
            <div class="col-sm-2 col-my-3 smallpad">
              <h4>MENU SENCER</h4>
							<?php /* <p><?php echo $menu_list['half_price']; ?></p>
							<p><?php echo $menu_list['full_price']; ?></p> */ ?>
              <span class="custom-checkbox col-sm-offset-5">
              <input type="checkbox" class="jsSelectOrder" name="select_order[<?php echo $menu_list['id']; ?>]" />
              <span class="box<?php echo $checkboxClass; ?>"><span class="tick"></span></span>
              </span>
            </div>
            </div>
						<?php
								}
							}
						?>		
          </div>
		  </div>
    </div>
				<?php
				}
				if($left_time > 0 || count($menu_lists) > 0) {
				?>
				<div class="col-sm-12 menubottom add_menu">
          <div class="col-sm-6">
						<?php if($left_time > 0) { ?>
            <h4 id="timer_span">Tienes <span id="time"></span> para pedir este menu</h4>
						<?php } ?>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-4">
                <span class="menuitemfont">Total: <span id="jsTotalPrice">0&euro;</span></span>
              </div>
							<div class="col-sm-3">
                <button type="button" class="btn btn-menu jsAddMenuButton" data-value="1"><?php echo lang('add'); ?></button>
              </div>
							<div class="col-sm-1">
							</div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-menu jsAddMenuButton" data-value="0"><?php echo lang('add_checkout'); ?></button>
              </div>
            </div>
          </div>
        </div>
				<?php } ?>
				</form>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer_nav_bar'); ?>
</div>
<script type='text/javascript'>
  var timeLeft = parseInt(<?php echo $left_time; ?>);
  var display = $('#time');
	var $cool_drinks = <?php echo json_encode($cool_drinks); ?>;
	var $menus = <?php echo json_encode($menu_list_with_id); ?>;
</script>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/menus.js"></script>
<?php $this->load->view('footer'); ?>