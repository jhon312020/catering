<?php
$this->load->view('header');
$this->load->view('navigation_menu');
$classDisable = '';
$buttonDisabled = '';
if (isset($show_menus) && $show_menus == false) {
	$buttonDisabled ='disabled';
	$classDisable = 'disabled';
}
?>
<style>
.datepicker-days tr {
	height:0px !important;
}
.fa.pull-right { line-height: inherit; }
div.disabled
{
  pointer-events: none;
  /* for "disabled" effect */
  opacity: 0.3;
  background: #CCC;
}
</style>
<div class="top-content">
	<div class="inner-bg">
		<div class="container">
			<div class="row">
				<h3 class="head_2"><span class="mob-hide"><?php echo lang('menu'); ?>: <?php 
				setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
				$todaySpanishDate = ucwords(utf8_encode(strftime('%A %d %B %Y',strtotime($menu_date))));
				echo $todaySpanishDate;
				//echo date('l d F Y', strtotime($menu_date)) ?></span>
				<span class="mob-show">Elige tu menú!</span>
				</h3>
				<div class="col-sm-12 menuhead">
					<div class="col-sm-8">
						<p>Selecciona tu menú. Puedes elegir un menú completo, medio menú o un menú combinado.<br/> También puedes seleccionar bebidas.</p>
						<?php if ($today_menu_expired) { ?>
						<p class='today_menu_expired'>No es posible solicitar un menú para el día de hoy debido a haber expirado la hora límite</p>
						<?php } ?>
						<p>* Todos los medios menús siempre van acompañados de entrante ensalada</p>
					</div>
					<div class="col-sm-4">
						<span class="col-xs-12 mob-show" style="padding-right: 0px">
						<button type="button" class="btn btn-menu button-datepicker-mob mob-show col-xs-12" style="padding-right: 10px;"><span><b> <?php echo lang('menu'); ?>:</b> <?php echo $todaySpanishDate ?> <span class="pull-right fa fa-calendar" aria-hidden="true"></span></span></button>
						<input type='hidden' name="" class="datepicker-mob" />
						<span class="col-xs-12" style="background-color:#f0f0f0;">
							<?php
							if($left_time > 0) {?>
							<span id="timer_span" >*Tienes <span id="time_top"></span> para pedir este menu</span>
							<?php }
							else {
								if ($menu_date == date('Y-m-d')) {
									echo lang('order_time_over');
								}
							}?>
						</span>
						</span>
						<button type="button" class="btn btn-menu button-datepicker mob-hide"><span><span class="fa fa-calendar" aria-hidden="true"></span> SELECCIONA OTRO DIA<span></button>
						<input type='hidden' name="" class="form-control datepicker12" />
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
						$plusColor = 'text-green';
						$selectBorderColor = 'border-green';
					}else {
						$plusColor = 'text-green';
						$selectBorderColor = 'border-green';
					}
					//print_r($menu_lists[$key]); exit;
					if(isset($menu_lists[$key])) {
						foreach($menu_lists[$key] as $menu_list) {
								$menu_list_with_id[$menu_list['id']] = $menu_list;
				if ($key == -1) {
				  $order_key = 'R';
				} else {
				  $order_key = 'N';
				}
					?>
				<div class="clear-pad jsSubMenu <?php echo $classDisable; ?>" style="clear:both">
					<div class="col-sm-12 section-down" style="padding:0;">
						<div id="ribbon-container-menus<?php echo $headerClass; ?>" class="ribbon-fix">
						   <a href="javascript:;" id="ribbon"> <?php echo lang(strtolower($menu_type)); ?></a>
						</div>
						<!--Old code cut out here-->
						<div class="mobile-ribbon col-md-2" id="">
							<a href="javascript:;" id="ribbon"> <?php echo lang(strtolower($menu_type)); ?></a>		
						</div>
						<div class="menuItemsRow">
							<div class="col-md-2 menuItemDiv noCheck" style="margin-bottom: 15px;">
							<img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Guarnicio']]['image']; ?>">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Entrante</div>
									<div class="menuItemName"><?php echo $plates[$menu_list['Guarnicio']]['Plat']; ?></div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span>
							</div>

							<div class="col-md-2 menuItemDiv" style="margin-bottom: 15px;">
								<img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Primer']]['image']; ?>">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Primer plato</div>
									<div class="menuItemName"><?php echo $plates[$menu_list['Primer']]['Plat']; ?></div>
									<div class="checkboxDiv custom-checkbox">
										<span class="box <?php echo $checkboxClass; ?>">
											<input type="checkbox" data-order-key="<?php echo $order_key.'1'; ?>" class="jsSelectMenu" name="select_food[<?php echo $menu_list['id']; ?>][Primer]" value="<?php echo $menu_list['Primer']; ?>" />
											<span class="tick"></span>
										</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span>
							</div>
							
							<div class="col-md-2 menuItemDiv" style="margin-bottom: 15px;">
								<img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Segon']]['image']; ?>">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Segundo plato</div>
									<div class="menuItemName"><?php echo $plates[$menu_list['Segon']]['Plat']; ?></div>
									<div class="checkboxDiv custom-checkbox">
										<span class="box <?php echo $checkboxClass; ?>">
											<input type="checkbox" data-order-key="<?php echo $order_key.'2'; ?>" class="jsSelectMenu" name="select_food[<?php echo $menu_list['id']; ?>][Segon]" value="<?php echo $menu_list['Segon']; ?>" />
											<span class="tick"></span>
										</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span>
							</div>
							
							<div class="col-md-2 menuItemDiv noCheck" style="margin-bottom: 15px;">
								<img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.$plates[$menu_list['Postre']]['image']; ?>">
								<div class="sectionForMobile">
									<div class="menuItemCategoryName">Postre</div>
									<div class="menuItemName"><?php echo $plates[$menu_list['Postre']]['Plat']; ?></div>
								</div>
							</div>
							
							<div class="col-md-1 plusSignDiv">
								<span class="menu-plus img-plus <?php echo $plusColor; ?>">+</span>
							</div>
							
							<div class="col-md-2 menuItemDiv" >
								<img class="img-responsive menu-img" src="<?php echo PLAT_IMAGE_PATH.'imagen-bebida.jpg'; ?>">
								<div class="sectionForMobile" style="padding-top: 10px;">
									<select class="selectpicker select-menu boostrap-multiselect" name="cool_drinks[<?php echo $menu_list['id']; ?>][]" multiple="multiple">
									<?php foreach($cool_drinks as $drinks) { ?>
										<option class="jSelectDrinks" value="<?php echo $drinks->id; ?>"><?php echo $drinks->drinks_name;//.'---'.$drinks->price; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-6 footerNote">
							<span class="">*Aceite, vinagre, pan y cubiertos incluidos en todos los menús</span>
						</div>
						<div class="col-md-6 footerCompletion">
								<span><?php echo lang(strtolower($menu_type)); ?> COMPLETO &nbsp;</span>
								<span class="custom-checkbox">
									<span class="box <?php echo $checkboxClass; ?>">
										<input type="checkbox" data-order-key="<?php echo $order_key; ?>" class="jsSelectOrder" name="select_order[<?php echo $menu_list['id']; ?>]" /><span class="tick"></span>
									</span>
								</span>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php
				 } }
				if(count($menu_lists) > 0) {
				?>
				<div class="col-sm-12 menubottom add_menu">
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 mob-hide">
						<?php if($left_time > 0) { ?>
			<h4 id="timer_span">Tienes <span id="time_bottom"></span> para pedir este menu</h4>
						<?php } else {
							if ($menu_date == date('Y-m-d')) {
								echo lang('order_time_over');
							}
			 } ?>
			
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
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
			//$('.menuItemDiv, .plusSignDiv').matchHeight();
			var byRow = $('body').hasClass('jsSubMenu');
			$('.menuItemsRow').each(function() {
          $(this).children('.menuItemDiv, .plusSignDiv').matchHeight({
              byRow: byRow
          });
      });
			var divHeight = $('.plusSignDiv').height();
			console.log(divHeight);
			var menuItemHeight = divHeight + 50;
			//$('.menuItemsRow').css('height', menuItemHeight + "px");
			$('.menu-plus').css('line-height', divHeight + "px");
			$('.menu-plus').css('font-size', 30 + "px");
		});
	}
	
	window.onresize = function() {
		if( $(window).width() > 990) {
			$(function() {
				//$('.menuItemDiv, .plusSignDiv').matchHeight();
				var byRow = $('body').hasClass('jsSubMenu');
				$('.menuItemsRow').each(function() {
          $(this).children('.menuItemDiv, .plusSignDiv').matchHeight({
              byRow: byRow
          });
      	});
				var divHeight = $('.plusSignDiv').height();
				console.log(divHeight);
				var menuItemHeight = divHeight + 50;
				//$('.menuItemsRow').css('height', menuItemHeight + "px");
				$('.menu-plus').css('font-size', 30 + "px");
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
