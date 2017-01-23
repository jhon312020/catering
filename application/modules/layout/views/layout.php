<?php
$user_name = $this->session->userdata('user_name');
$title = $this->mdl_settings->setting('site_title') . " | Admin Panel";
$cms_lang = $this->session->userdata('cms_lang');
//$language = array('english'=>'en', 'spanish'=>'es');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $title; ?>" />
	<meta name="author" content="" />
	
	<!--<title><?php echo $title; ?></title>-->
	
	<?php
	if($cms_lang == 'english'){
	?>
	<TITLE><?php echo $title; ?>  -  Low Cost Barcelona - Airport Shuttle</TITLE>
	<META NAME="description" CONTENT="Pick´n Go is a premium and low cost shuttle transfer (door to door) between Barcelona´s airport and your hostel/hotel. With numerous advantages like free Internet, Welcome Pack, Discounts, etc.">
	<META NAME="keywords" CONTENT="barcelona, low cost, premium, shuttle, car, bus, trip, airport, city, travel, trip, hotel, hostel, free internet, discounts, transfers, booking.">
	<META NAME="robot" CONTENT="index,follow">
	<META NAME="copyright" CONTENT="Copyright © Pick\'n Go">
	<META NAME="author" CONTENT="Grupo Visualiza - www.grupovisualiza.com">
	<META NAME="generator" CONTENT="www.onlinemetatag.com">
	<META NAME="language" CONTENT="EN">
	<?php
	}
	else{
	?>
	<TITLE><?php echo $title; ?>  -  Transporte Low Cost Barcelona Aeropuerto</TITLE>
	<META NAME="description" CONTENT="Pick´n Go es un servicio Premium y low cost de transporte (shuttle puerta a puerta) entre el aeropuerto de Barcelona y vuestro hotel/hostal. Un servicio hecho a medida y con numerosas ventajas como Internet gratis, pack de bienvenida, etc.">
	<META NAME="keywords" CONTENT="barcelona, low cost, premium, shuttle, coche, bus, viaje, aeropuerto, ciudad, viajar, transporte, hotel, hostal, internet gratis, descuentos.">
	<META NAME="robot" CONTENT="index,follow">
	<META NAME="copyright" CONTENT="Copyright © Pick\'n Go">
	<META NAME="author" CONTENT="Grupo Visualiza - www.grupovisualiza.com">
	<META NAME="generator" CONTENT="www.onlinemetatag.com">
	<META NAME="language" CONTENT="ES">
	<?php	
	}
	?>



	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/font-icons/entypo/css/entypo.css">
	<!--link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/bootstrap.css">
	<!--<link rel="stylesheet" href="//demo.neontheme.com/assets/css/neon-core.css">-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/cc/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/bootstrap-datetimepicker.min.css">
	<script src="<?php echo base_url(); ?>assets/neon/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap.js"></script>
	<link href="<?php echo base_url(); ?>assets/cc/css/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
	<script>
		$(document).ready( 
			function () {
				//debugger;
				if (typeof $().datepicker === 'function') {
					$('.datepicker').datepicker();
				}
				if (typeof $().datetimepicker === 'function') {
					//http://www.malot.fr/bootstrap-datetimepicker/
					$('.timepicker').datetimepicker({
						startView : 1,
						startDate : new Date(),
						format: 'hh:ii',
						showMeridian:true,
						autoclose:true,
						weekStart: 1
					});
					$('.datepicker1').datetimepicker({
						minView:2,
						format: 'dd/mm/yyyy',
						autoclose:true,
						weekStart: 1
					}).on('changeDate', function(e){
						var $field = $(e.target);
						if (typeof $field.data('formid') !== undefined){
							var form = $field.data('formid');
							$(form).submit();
						}
					});
				}
				/*$( "#date" ).change(function() {
					$( "#date .datepicker" ).datepicker( "option", "dateFormat", "dd.mm.yyyy" );
				});*/
				if(typeof $().combobox === 'function'){
					$( ".combobox" ).combobox();
				}
				$('.dropdown-toggle').dropdown();
			});
	</script>
	
	<!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/neon/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>
<body class="page-body  page-left-in" data-url="">
	<style>
	.autosizejs {
		position:relative !important;
	}
	</style>
	<div class="page-container">
		<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
		<div class="sidebar-menu">
			<header class="logo-env">
				<input type="hidden" name="site_url" id="site_url" value="<?php echo site_url('ajax/build_datatable/'.$this->uri->segment(2)); ?>">
				<!-- logo -->
				<div class="logo">
					<a href="<?php echo site_url('/admin/dashboard'); ?>">
						<img src="<?php echo base_url(); ?>assets/cc/images/common/logo-gvadmin.jpg" width="120" alt="" />
					</a>
				</div>
				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>
			</header>
			<!--<div class="sidebar-user-info">
				<div class="sui-normal">
					<a href="#" class="user-link">
						<img src="<?php echo base_url(); ?>assets/neon/images/thumb-1.png" alt="" class="img-circle" />
						
						<span>Welcome,</span>
						<strong><?php echo $user_name;?></strong>
					</a>
				</div>
				<div class="sui-hover inline-links animate-in">			
					<span class="close-sui-popup">&times;</span>
				</div>
			</div>-->			
			<?php echo $this->load->view("admin_menu");?>
		</div>	
		<div class="main-content">		
			<div class="row">
				<!-- Profile Info and Notifications -->
				<div class="col-md-6 col-sm-8 clearfix">
					<ul class="user-info pull-left pull-none-xsm">
						<!-- Profile Info -->
						<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php if($this->mdl_settings->setting('media_admin_logo') != ""){?>
								<img src="<?php echo $this->mdl_settings->setting('media_admin_logo'); ?>" alt="" class="img-circle" width="44">
							<?php }else{?>
								<img src="<?php echo base_url(); ?>assets/neon/images/thumb-1.png" alt="" class="img-circle" width="44" />
							<?php }?>
							<?php echo $this->mdl_settings->setting('site_title'); ?>
							</a>
							<ul class="dropdown-menu">
								<!-- Reverse Caret -->
								<li class="caret"></li>
								<!-- Profile sub-links -->
									<li>
									<a href="<?php echo site_url('admin/settings'); ?>">
										<i class="entypo-cog"></i>
										<?php echo lang('settings'); ?>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- Raw Links -->
				<div class="col-md-6 col-sm-4 clearfix hidden-xs">		
					<ul class="list-inline links-list pull-right">
						<li><?php echo date('l jS \of F Y ');?></li>
						<li class="sep"></li>
						<!-- Language Selector -->
						<li class="dropdown language-selector">
						<?php
							if(!($cms_lang) || $cms_lang == ""){
								$cms_lang = "english";
							}
						?>
						<?php echo lang('language'); ?>: &nbsp;
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
								<?php if ($cms_lang == "english"){?>
								<img src="<?php echo base_url(); ?>assets/neon/images/flag-uk.png" />
								<?php }else{?>
								<img src="<?php echo base_url(); ?>assets/neon/images/flag-es.png" />
								<?php }?>
							</a>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="<?php echo site_url('admin/dashboard/set_lang/')."/".$cms_lang; ?>">
										<?php if ($cms_lang == "english"){?>
										<img src="<?php echo base_url(); ?>assets/neon/images/flag-es.png" />
										<span>Español</span>
										<?php }else{?>
										
										<img src="<?php echo base_url(); ?>assets/neon/images/flag-uk.png" />
										<span>English</span>
										<?php }?>
									</a>
								</li>
							</ul>
						</li>
						<li class="sep"></li>
						<li>
							<a href="<?php echo site_url('sessions/logout'); ?>"><?php echo lang('logout'); ?> <i class="entypo-logout right"></i></a>
						</li>
					</ul>
				</div>	
			</div>
			<hr />
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<?php echo $content; ?>
				</div>
			</div>
			<footer class="main" style="border:0;"></footer>
		</div>
		<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">	
			<div class="chat-inner">
				<h2 class="chat-header">
					<a href="#" class="chat-close" data-animate="1"><i class="entypo-cancel"></i></a>
					<i class="entypo-users"></i>
					Chat
					<span class="badge badge-success is-hidden">0</span>
				</h2>
				<div class="chat-group" id="group-1">
					<strong>Favorites</strong>
					<a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
					<a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
					<a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
					<a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
					<a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
				</div>
				<div class="chat-group" id="group-2">
					<strong>Work</strong>
					<a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
					<a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
					<a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
				</div>
				<div class="chat-group" id="group-3">
					<strong>Social</strong>
					<a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
					<a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
					<a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
					<a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
				</div>	
			</div>
			<!-- conversation template -->
			<div class="chat-conversation">
				<div class="conversation-header">
					<a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>
					<span class="user-status"></span>
					<span class="display-name"></span> 
					<small></small>
				</div>
				<ul class="conversation-body">	
				</ul>
				<div class="chat-textarea">
					<textarea class="form-control autogrow" placeholder="Type your message"></textarea>
				</div>		
			</div>
		</div>
		<!-- Sample Modal (Default skin) -->
		<div class="modal fade" id="sample-modal-dialog-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Widget Options - Default Modal</h4>
					</div>			
					<div class="modal-body">
						<p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Sample Modal (Skin inverted) -->
		<div class="modal invert fade" id="sample-modal-dialog-2">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
					</div>
					<div class="modal-body">
						<p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Sample Modal (Skin gray) -->
		<div class="modal gray fade" id="sample-modal-dialog-3">
			<div class="modal-dialog">
				<div class="modal-content">	
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
					</div>
					<div class="modal-body">
						<p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/jvectormap/jquery-jvectormap-1.2.2.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/rickshaw/rickshaw.min.css">
		<!-- data table -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/datatables/responsive/css/datatables.responsive.css">
		<script src="<?php echo base_url(); ?>assets/neon/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/cc/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datetimepicker.min.js"></script>
		

			
		<script src="<?php echo base_url(); ?>assets/neon/js/datatables/dataTables.buttons.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/neon/js/dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/datatables/jquery.dataTables.columnFilter.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/datatables/lodash.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/datatables/responsive/js/datatables.responsive.js"></script>
		<!-- data table -->
		<!-- select -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/select2/select2-bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/select2/select2.css">
		<script src="<?php echo base_url(); ?>assets/neon/js/select2/select2.min.js"></script>
		<!-- end select -->

		<!-- Bottom Scripts -->
		<script src="<?php echo base_url(); ?>assets/neon/js/gsap/main-gsap.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/jquery-ui/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/joinable.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/resizeable.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/neon-api.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/rickshaw/vendor/d3.v3.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/rickshaw/rickshaw.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/neon-chat.js"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/neon-custom.js"></script>
		<?php if($cms_lang != "english") { ?>
		<script src="<?php echo base_url(); ?>assets/neon/js/neon-demo-es.js"></script>
		<?php } else { ?>
		<script src="<?php echo base_url(); ?>assets/neon/js/neon-demo.js"></script>
		<?php } ?>
		<script src="<?php echo base_url(); ?>assets/default/js/combobox.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/cc/js/bootstrap-tokenfield.min.js" charset="UTF-8"></script>

		 
		<script src="<?php echo base_url(); ?>assets/neon/js/raphael-min.js" id="script-resource-10"></script>
		<script src="<?php echo base_url(); ?>assets/neon/js/morris.min.js" id="script-resource-11"></script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		 
		  ga('create', 'UA-365764-35', 'auto');
		  ga('send', 'pageview');
		 
		</script>	
	</div>	
</body>
</html>
