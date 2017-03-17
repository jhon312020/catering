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
				<h3 class="head_2"><?php echo lang('menu'); ?>: <?php 
				setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
				echo ucwords(utf8_encode(strftime('%A %d %B %Y',strtotime($menu_date))));
				//echo date('l d F Y', strtotime($menu_date)) ?></h3>
				<div class="col-sm-12 menuhead">
					<div class="col-sm-8">
						<p>Selecciona tu menú. Puedes elegir un menú completo, medio menú o un menú combinado.<br/> También puedes seleccionar bebidas.</p>
						<?php if ($today_menu_expired) { ?>
						<p class='today_menu_expired'>No es posible solicitar un menú para el día de hoy debido a haber expirado la hora límite</p>
						<?php } ?>
					</div>
					<div class="col-sm-4">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mob-show">
						<?php if($left_time > 0) { ?>
			<h4 id="timer_span" style="color:#8DC73F;">Tienes <span id="time_top"></span> para pedir este menu</h4>
						<?php } else {
							if ($menu_date == date('Y-m-d')) {
								echo lang('order_time_over');
							}
			 } ?>
			
		  </div>
						<button type="button" class="btn btn-menu button-datepicker"><i class="fa fa-calendar" aria-hidden="true"></i>SELECCIONA OTRO DIA</button>
						<form method="post" id="menuListform">
							<input type='hidden' name="menu_date" class="form-control datepicker12" value="<?php echo $menu_date; ?>" />
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<form action="<?php echo site_url('node/addMenu'); ?>" method="post" id="jsMenuForm">
					<input type='hidden' name="order_date" class="form-control" value="<?php echo $menu_date; ?>" />
					<input type="hidden" name="language" value="<?php echo PAGE_LANGUAGE; ?>" />
				<?php
				//print_r($menu_types);
				$menu_list_with_id = [];
				foreach($menu_types as $key => $menu_type) {
					$checkboxClass = '';
					$headerClass = '-green';
					if($key%2 != 0) {
						$checkboxClass = '-brown';
						$headerClass = '';
						$plusColor = '';
						$selectBorderColor = '';
					}else {
						$plusColor = 'text-green';
						$selectBorderColor = 'border-green';
					}
					//print_r($menu_lists[$key]); exit;
					if(isset($menu_lists[$key])) {
					?>
				<div class="clear-pad" style="clear:both">
					<div class="col-sm-12 section-down">
						<div id="ribbon-container<?php echo $headerClass; ?>" class="ribbon-fix">
						   <a href="javascript:;" id="ribbon"> <?php echo lang(strtolower($menu_type)); ?></a>
						</div>
						<div class="menu-bottom jsMenuDiv">
						<?php 
						//if(isset($menu_lists[$key])) {
							foreach($menu_lists[$key] as $menu_list) {
								$menu_list_with_id[$menu_list['id']] = $menu_list;
				if ($key == -1) {
				  $order_key = 'R';
				} else {
				  $order_key = 'N';
				}
						?>
			<div class="row doublemenu jsSubMenu">
			  <?php
				if (isset($show_menus) && $show_menus == false) {
				  echo '<div class="disable_menus"></div>';
				}
			  ?>
				<div class="col-sm-2 col-my-4 dishpad">
					<span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span><img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Guarnicio']]['image']; ?>">
					<br/>
					<span class="dishName"><?php echo $plates[$menu_list['Guarnicio']]['Plat']; ?></span>
				</div>
				
				<div class="col-sm-2 col-my-4 dishpad">
					<span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span><img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Primer']]['image']; ?>">
					<br/>
			  <span class="title-aligned dishName"><?php echo $plates[$menu_list['Primer']]['Plat']; ?></span>
			  <span class="custom-checkbox col-sm-offset-5 dishCheckbox">
			  
			  <span class="box<?php echo $checkboxClass; ?>"><input type="checkbox" data-order-key="<?php echo $order_key.'1'; ?>" class="jsSelectMenu" name="select_food[<?php echo $menu_list['id']; ?>][Primer]" value="<?php echo $menu_list['Primer']; ?>" /><span class="tick"></span></span>
			  </span>
			</div>
			<div class="col-sm-2 col-my-4 dishpad">
			  <span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span><img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Segon']]['image']; ?>">
			  <br>
			  <span class="title-aligned dishName"><?php echo $plates[$menu_list['Segon']]['Plat']; ?></span>
			  <span class="custom-checkbox col-sm-offset-5 dishCheckbox">
			  
			  <span class="box<?php echo $checkboxClass; ?>"><input type="checkbox" data-order-key="<?php echo $order_key.'2'; ?>" class="jsSelectMenu" name="select_food[<?php echo $menu_list['id']; ?>][Segon]" value="<?php echo $menu_list['Segon']; ?>" /><span class="tick"></span></span>
			  </span>
			</div>
			<div class="col-sm-2 col-my-4 dishpad">
			  <span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span><img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Postre']]['image']; ?>">
			  <br>
			  <span class="dishName"><?php echo $plates[$menu_list['Postre']]['Plat']; ?></span>
			</div>
						<div class="col-sm-2 col-my-2 smallpad multi-pad <?php echo 'multi-pad-'.$selectBorderColor; ?> " >
			  <select class="selectpicker select-menu boostrap-multiselect" name="cool_drinks[<?php echo $menu_list['id']; ?>][]" multiple="multiple">
								<?php foreach($cool_drinks as $drinks) { ?>
									<option class="jSelectDrinks" value="<?php echo $drinks->id; ?>"><?php echo $drinks->drinks_name;//.'---'.$drinks->price; ?></option>
								<?php } ?>
							</select>
			</div>
			<div class="col-sm-2 col-my-3 smallpad sencer_fix">
			  <h4><?php echo lang('menu_complete'); ?></h4>
							<?php /* <p><?php echo $menu_list['half_price']; ?></p>
							<p><?php echo $menu_list['full_price']; ?></p> */ ?>
			  	<span class="custom-checkbox col-sm-offset-5">
					<span class="box<?php echo $checkboxClass; ?>">
						<input type="checkbox" data-order-key="<?php echo $order_key; ?>" class="jsSelectOrder" name="select_order[<?php echo $menu_list['id']; ?>]" />
					  	<span class="tick"></span>
				  	</span>
				</span>
			</div>
			</div>
						<?php
								}
							//}
						?>		
		  </div>
		  </div>
	</div>
				<?php
				} }
				if(count($menu_lists) > 0) {
				?>
				<div class="col-sm-12 menubottom add_menu">
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mob-hide">
						<?php if($left_time > 0) { ?>
			<h4 id="timer_span">Tienes <span id="time_bottom"></span> para pedir este menu</h4>
						<?php } else {
							if ($menu_date == date('Y-m-d')) {
								echo lang('order_time_over');
							}
			 } ?>
			
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
			<div class="row">
			  <div class="col-xs-12 col-sm-4 pull-left">
				<span class="menuitemfont">Total: <span id="jsTotalPrice">0.00 &euro;</span></span>
			  </div>
							<div class="col-xs-12 col-sm-2 col-sm-offset-2 res-button-spacing">
				<button type="button" class="btn btn-menu jsAddMenuButton" data-value="1"><?php echo lang('add'); ?></button>
			  </div>
							<div class=" col-xs-12 col-sm-4 pull-right">
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
  var display_top = $('#time_top');
  var display_bottom = $('#time_bottom');
	var $cool_drinks = <?php echo json_encode($cool_drinks); ?>;
	var $menus = <?php echo json_encode($menu_list_with_id); ?>;
  var price_list = <?php echo json_encode($price_list); ?> 
  var availableDates = <?php echo json_encode($available_dates); ?>;
  console.log(price_list);
</script>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/menus.js"></script>
<?php $this->load->view('footer'); ?>
