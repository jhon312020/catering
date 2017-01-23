<?php
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo current_url();die;
	$path = $this->uri->segment(2);
	if($ln=='en'){
		$actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$full_path_es = str_replace('/en', '/es', $actual_link);
		$full_path_en = $actual_link;
	}
	else{
		$actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$full_path_en = str_replace('/es', '/en', $actual_link);
		$full_path_es = $actual_link;
	}
	//echo $full_path_en;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$title = $this->mdl_settings->setting('site_title');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<?php header("X-UA-Compatible: IE=Edge"); ?>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
		
	    <!--<title><?php echo $title. ' | ' . strtoupper(lang('home')); ?></title>-->
		<?php
		if($ln == 'en'){
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
	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="<?php echo $template_path;?>css/bootstrap.css">
	    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	    <!-- Custom CSS -->
	    <link rel="stylesheet" href="<?php echo $template_path;?>css/style.css">
		<link rel="stylesheet" href="<?php echo $template_path;?>css/homeslider.css">
		<link rel="shortcut icon" href="<?php echo $template_path;?>images/common/fav.png">

		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
		<!--style>
		@font-face {
			font-family: "Calibri";
			src: url("<?php echo $template_path;?>fonts/calibri.ttf");
		}
		</style-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<style type="text/css">
		@media (max-width: 600px) {
			.top_col_menu .top_pipe {
				padding-right: 5px;
				padding-left: 5px;
			}  
		}
		.topnav ul li a{
			color:#fff !important;
		}
		.navbar-nav li span{
			padding:5px 20px;
			color:#fff;
			position:relative;
			top:5px;
		}
		.ui-autocomplete {
		    max-height: 300px;
		    overflow-y: auto;   /* prevent horizontal scrollbar */
		    overflow-x: hidden; /* add padding to account for vertical scrollbar */
		    z-index:1000 !important;
		}
		</style>
	</head>
	<body class="page-body">
	<?php if($this->session->userdata('user_name') &&	$this->session->userdata('user_type') == 5) { ?>	
	<div class="top_col_menu" style="display: flex; align-items: center;height:100px;">
	<div class="container" style="display: flex; align-items: center;">
			<a href="<?php echo site_url($ln); ?>" class="">
					<img src="<?php echo $template_path;?>images/logo.png" style="height:50px;width:50px;float:left;">
			</a>
			<div style="float: right; text-align: right; width: 100%;">
			<span id="top_date"><?php echo Date('l d F Y'); ?></span>
			<span class="top_pipe">|</span>
        	<!--<a href="<?php echo site_url($ln.'/route_details'); ?>"><span>Car Details</span></a>
        	<span class="top_pipe">|</span>-->
        	<a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $car_details['car_name']; ?>"><span id="top_car"><?php echo $car_details['car_name']; ?></span></a>
             <span class="top_pipe">|</span>
             <a href="<?php echo site_url($ln.'/drivers_logout'); ?>" class="pad-right-zero">Logout<i class="fa fa-sign-out" style="padding-left: 9px;"></i></a>
             </div>
	</div>
	</div>
	<?php } ?>
	<!-- Header -->
	<div class="container">
	<script>
	$(document).ready(function(){
		if($(window).width() <= 1000) {
			$('.route_content').removeClass('col-sm-4');
			$('.route_content').addClass('col-sm-6');
		}
		if($(window).width() <= 600) {
			$('#top_car').text($('#top_car').text().substring(0,5)+'...');
			$('#top_date').text('<?php echo Date('D d M Y'); ?>');
		}
	    $('[data-toggle="tooltip"]').tooltip(); 
	});
	</script>
