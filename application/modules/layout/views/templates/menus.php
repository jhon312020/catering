<?php
$this->load->view('header');
$this->load->view('navigation_menu');
$buttonDisabled = '';
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
							<?php
							if($left_time > 0) {?>
							<h4 id="timer_span" style="color:#8DC73F;">Tienes <span id="time_top"></span> para pedir este menu</h4>
							<?php }
							else {
								if ($menu_date == date('Y-m-d')) {
									echo lang('order_time_over');
								}
							}?>
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
					<div class="col-sm-12 section-down" style="padding:0;">
						<div id="ribbon-container<?php echo $headerClass; ?>" class="ribbon-fix">
						   <a href="javascript:;" id="ribbon"> <?php echo lang(strtolower($menu_type)); ?></a>
						</div>
						<!--Old code cut out here-->
						<div class="mobile-ribbon col-md-2" id="ribbon-container<?php echo $headerClass; ?>">
							<a href="javascript:;" id="ribbon"> <?php echo lang(strtolower($menu_type)); ?></a>		
						</div>
						<div class="menuItemsRow">
							<div class="col-md-2 menuItemDiv noCheck">
								<img class="img-responsive menu-img" src="http://localhost:8888/assets/cc/images/plats/imagen-ensalada2.jpg" />
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Entrante</div>
									<div class="menuItemName">Ensalada</div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus">+</span>
							</div>

							<div class="col-md-2 menuItemDiv">
								<img class="img-responsive menu-img" src="http://localhost:8888/assets/cc/images/plats/imagen-plato1.jpg">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Primer plato</div>
									<div class="menuItemName">Espaguetti boloñesa con cebolla</div>
									<div class="checkboxDiv custom-checkbox">
										<span class="box">
											<input type="checkbox" data-order-key="N1" class="jsSelectMenu" name="select_food[755][Primer]" value="238">
											<span class="tick"></span>
										</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus">+</span>
							</div>
							
							<div class="col-md-2 menuItemDiv">
								<img class="img-responsive menu-img" src="http://localhost:8888/assets/cc/images/plats/imagen-plato2.jpg">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Segundo plato</div>
									<div class="menuItemName">Croquetas caseras</div>
									<div class="checkboxDiv custom-checkbox">
										<span class="box">
											<input type="checkbox" data-order-key="N1" class="jsSelectMenu" name="select_food[755][Primer]" value="238">
											<span class="tick"></span>
										</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus">+</span>
							</div>
							
							<div class="col-md-2 menuItemDiv noCheck">
								<img class="img-responsive menu-img" src="http://localhost:8888/assets/cc/images/plats/imagen-postre2.jpg">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Postre</div>
									<div class="menuItemName">Fruta de proximidad</div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus">+</span>
							</div>
							
							<div class="col-md-2 menuItemDiv">
								<img class="img-responsive menu-img" src="http://localhost:8888/assets/cc/images/plats/imagen-postre2.jpg">
								<div class="sectionForMobile">
									<select class="selectpicker select-menu boostrap-multiselect" name="cool_drinks[<?php echo $menu_list['id']; ?>][]" multiple="multiple">
									<?php foreach($cool_drinks as $drinks) { ?>
										<option class="jSelectDrinks" value="<?php echo $drinks->id; ?>"><?php echo $drinks->drinks_name;//.'---'.$drinks->price; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-6 footerNote">
							<span class="footerNote">*Aceite, vinagre, pan y cubiertos incluidos en todos los menús</span>
						</div>
						<div class="col-md-6 footerCompletion">
								<span>MENÚ COMPLETO &nbsp;</span>
								<span class="custom-checkbox">
									<span class="box">
										<input type="checkbox" data-order-key="N" class="jsSelectOrder" name="select_order[755]"><span class="tick"></span>
									</span>
								</span>
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

				<button type="button" class="<?php echo $buttonDisabled; ?> btn btn-menu jsAddMenuButton" data-value="1"><?php echo lang('add'); ?></button>
			  </div>
							<div class=" col-xs-12 col-sm-4 pull-right">
				<button type="button" class="<?php echo $buttonDisabled; ?> btn btn-menu jsAddMenuButton" data-value="0"><?php echo lang('add_checkout'); ?></button>
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
	
	if( $(window).width() > 990) {
		$(function() {
			$('.menuItemDiv, .plusSignDiv').matchHeight();
			var divHeight = $('.plusSignDiv').height();
			$('.menuItemsRow').css('height', divHeight + "px");
			$('.menu-plus').css('line-height', divHeight + "px");
		});
	}
	
	window.onresize = function() {
		if( $(window).width() > 990) {
			$(function() {
				$('.menuItemDiv, .plusSignDiv').matchHeight();
				var divHeight = $('.plusSignDiv').height();
				$('.menuItemsRow').css('height', divHeight + "px");
				$('.menu-plus').css('line-height', divHeight + "px");
			});
		}
		else {
			$(function() {
				$('.menuItemsRow').css('height', "");
			});
		}
	}
	
	
</script>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/menus.js"></script>
<?php $this->load->view('footer'); ?>
