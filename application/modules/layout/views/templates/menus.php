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
        <h3 class="head_2">Menu: <?php echo date('l d F Y', strtotime($menu_date)) ?></h3>
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
				<form action="<?php echo site_url('node/addMenu'); ?>" method="post">
				<input type="hidden" name="language" value="<?php echo PAGE_LANGUAGE; ?>">
				<?php
				$menuIds = [];
				foreach($menu_types as $key => $menu_type) {
					$checkboxClass = '';
					$headerClass = '-green';
					if($key%2 == 0) {
						$checkboxClass = '-brown';
						$headerClass = '';
					}
				?>
				<div class="col-sm-12 section-down">
					<div id="ribbon-container<?php echo $headerClass; ?>" class="ribbon-fix">
            <a href="javascript:;" id="ribbon">MENU <?php echo $menu_type['menu_name'] ?></a>
          </div>
          <div class="menu-bottom jsMenuDiv">
						<?php 
						if(isset($menu_lists[$menu_type['id']])) {
							foreach($menu_lists[$menu_type['id']] as $menu_list) {
								$menuIds[] = $menu_list['id'];
								
								$primaryChecked = '';
								$secondaryChecked = '';
								if(isset($todaySelectedMenus[$menu_list['id']])) {
									$type = $todaySelectedMenus[$menu_list['id']]['order_type'];
									
									//check if the slected menus primary or secondary or both
									switch($type) {
										case 'primary':
											$primaryChecked = 'checked';
											break;
										case 'secondary':
											$secondaryChecked = 'checked';
											break;	
										case 'all':
											$secondaryChecked = 'checked';
											break;	
									}
								}
						?>
						<div class="col-sm-2 smallpad">
              <img src="<?php echo TEMPLATE_PATH; ?>dish1.png"><span>+</span>
              <br>
              <span><?php echo $menu_list['complement']; ?></span>
            </div>
            <div class="col-sm-2 dishpad">
              <img src="<?php echo MENU_IMAGE_PATH.$menu_list['primary_image']; ?>"> +
              <br>
              <span><?php echo $menu_list['primary_plate']; ?></span>
              <p style="text-align: left;font-size: 12px;"><?php echo $menu_list['description_primary_plate']; ?></p>
              <span class="custom-checkbox col-sm-offset-5">
              <input type="checkbox" class="jsSelectMenu" <?php echo $primaryChecked; ?> name="select_food[<?php echo $menu_list['id']; ?>][primary]" value="<?php echo $menu_list['half_price']; ?>" />
              <span class="box<?php echo $checkboxClass; ?>"><span class="tick"></span></span>
              </span>
            </div>
            <div class="col-sm-2 dishpad">
              <img src="<?php echo MENU_IMAGE_PATH.$menu_list['secondary_image']; ?>"> +
              <br>
              <span><?php echo $menu_list['secondary_plate']; ?></span>
              <p style="text-align: left;font-size: 12px;"><?php echo $menu_list['description_secondary_plate']; ?></p>
              <span class="custom-checkbox col-sm-offset-5">
              <input type="checkbox" class="jsSelectMenu" <?php echo $secondaryChecked; ?> name="select_food[<?php echo $menu_list['id']; ?>][secondary]" value="<?php echo $menu_list['half_price']; ?>" />
              <span class="box<?php echo $checkboxClass; ?>"><span class="tick"></span></span>
              </span>
            </div>
            <div class="col-sm-1 smallpad">
              <img src="<?php echo TEMPLATE_PATH; ?>dish2.png"> +
              <br>
              <span><?php echo $menu_list['postre']; ?></span>
            </div>
            <div class="col-sm-1 smallpad">
              <img src="<?php echo TEMPLATE_PATH; ?>dish3.png"> +
              <br>
              <span>Pa</span>
            </div>
            <div class="col-sm-1 smallpad">
              <img src="<?php echo TEMPLATE_PATH; ?>dish4.png"> +
              <br>
              <span>Oli i Vinagre</span>
            </div>
            <div class="col-sm-1 smallpad">
              <img src="<?php echo TEMPLATE_PATH; ?>dish5.png">
              <br>
              <span>Coberts</span>
            </div>
            <div class="col-sm-2 smallpad">
              <h4>MENU SENCER</h4>
              <span class="custom-checkbox col-sm-offset-5">
              <input type="checkbox" class="jsSelectOrder" <?php echo $primaryChecked == 'checked' || $secondaryChecked == 'checked' ? 'checked' :'';; ?> value="<?php echo $menu_list['half_price']; ?>" data-half-price="<?php echo $menu_list['half_price']; ?>" data-full-price="<?php echo $menu_list['full_price']; ?>" />
              <span class="box<?php echo $checkboxClass; ?>"><span class="tick"></span></span>
              </span>
            </div>
						<?php
								}
							}
						?>		
          </div>
        </div>
				<?php
				}
				?>
				<div class="col-sm-12 menubottom">
          <div class="col-sm-8">
            <h4>Tienes 01:35h para pedir este menu</h4>
          </div>
          <div class="col-sm-4">
            <div class="row">
              <div class="col-sm-8">
                <span class="menuitemfont">Total: <span id="jsTotalPrice">0&euro;</span></span>
              </div>
              <div class="col-sm-4">
                <button type="submit" class="btn btn-menu">ANADIR</button>
              </div>
            </div>
          </div>
        </div>
				<input type="hidden" name="menu_list_ids" value='<?php echo json_encode($menuIds); ?>'>
				</form>
      </div>
    </div>
  </div>
</div>
<div class="footer-bottom">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="copyright">
          Gumen Catering | Calle cato, 6 bajos. 08206 Sabadell | Tel/Fax. 93 717 8335
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="design">
          <a href="#" class="btn-link">Condiciones legales</a> <i class="fa fa-lg fa-twitter-square"></i> <i class="fa fa-lg fa-facebook-square"></i>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/menus.js"></script>
<?php $this->load->view('footer'); ?>