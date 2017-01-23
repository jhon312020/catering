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
	    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

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
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		    $(".validateForm").validationEngine({
		    	promptPosition : 'bottomLeft'
		    });
		   });
		</script>
		<style type="text/css">
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
		.bannera {
			float: left;
		}
		</style>


	<?php if($this->uri->segment(2) == 'booking_details'){ ?>
	<style>
	.pagination  li{
		list-style:none;
		border-radius:none;
		border:none;
		color:none;
		float:none;
		padding:inherit;
		margin:0px;
		width:30px;
		height:30px;
		text-align:none;
		cursor:pointer;
	}
	</style>	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/css/custom.css">

<!-- data table -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/neon/js/datatables/responsive/css/datatables.responsive.css">
	<script src="<?php echo base_url(); ?>assets/neon/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/neon/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/neon/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/neon/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url(); ?>assets/neon/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/neon/js/datatables/responsive/js/datatables.responsive.js"></script>
		<!--Datatable end-->

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
	<?php if($this->uri->segment(1) != "en") { ?>
	<script src="<?php echo base_url(); ?>assets/neon/js/neon-demo-es.js"></script>
	<?php } else { ?>
	<script src="<?php echo base_url(); ?>assets/neon/js/neon-demo.js"></script>
	<?php } ?>
	<script src="<?php echo base_url(); ?>assets/default/js/combobox.js"></script>

	<?php } ?>
		
	</head>
	<body class="page-body">
	<?php 
	//echo $this->session->userdata('user_name') && $this->session->userdata('user_type') == 2;die;
	if($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2){ ?>
	
	<div class="top_col_menu">
	<div class="container">
		<?php if($this->session->userdata('user_type') == 2) { ?>
		<a class="bannera" href="<?php echo site_url($ln.'/booking_details'); ?>"><span><?php echo lang('book_history'); ?></span></a>
        <span class="top_pipe bannera">|</span>
        <a class="bannera" href="<?php echo site_url($ln.'/changepassword'); ?>"><span><?php echo lang('change_password'); ?></span></a>		
        <!--<span class="top_pipe">|</span>-->
        <?php } ?>
		<?php if(isset($collaborator_details['available_seats']) && $collaborator_details['available_seats'] == 'activate') { ?>
			<span>Available seats / <?php echo $collaborator_details['no_of_available_seats']; ?></span>
            <span class="top_pipe">|</span>
		<?php } ?>
		<?php if(isset($collaborator_details['available_seats'])) { ?>
             <span><?php echo $this->session->userdata('user_name'); ?></span>
        <?php } ?>
             <span class="top_pipe">|</span>
             <a href="<?php echo site_url($ln.'/collaborators_logout'); ?>" class="pad-right-zero">Logout<i class="entypo-logout top_pipe pad-right-zero mar-right-zero"></i></a>
	</div>
	</div>
	<?php } ?>
	<nav class="navbar navbar-default">
        <div class="container">
		<div class="top_icon">
			<?php
			if(!$this->session->userdata('user_name')) { ?>
				<a href="<?php echo site_url($ln.'/collaborators_login'); ?>" class='collaborator_link'><?php echo lang('collaborators_access'); ?></a> <span class="separator hide_sep">|</span> 
				<!--<a href="<?php echo site_url($ln.'/carchannel'); ?>" class='collaborator_link'><?php echo lang('car_channel'); ?></a> <span class="separator hide_sep">|</span> -->
			<?php } ?>
			<a href="<?php echo (isset($social_facebook))?$social_facebook:'#'; ?>" style="display:none;">
			<img src="<?php echo $template_path;?>images/facebook.png" style="width:20px;"></a> <span class="separator" style="display:none;">|</span>
			<a href="<?php echo $full_path_es; ?>" onClick="return checkPage();"><img src="<?php echo $template_path;?>images/spanish.png" style="width:20px;"></a> 
			<span class="separator">|</span> <a href="<?php echo $full_path_en; ?>" onClick="return checkPage();"><img src="<?php echo $template_path;?>images/english.png" style="width:20px;"></a></div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
					<span class="mob-show mob-menu-icon">MENU</span>
                </button>
                <a href="<?php echo site_url('/').$ln;?>" class="navbar-brand page-scroll">
					<img src="<?php echo $template_path;?>images/logo.png" class="img-responsive" style="height:100px;width:100px;margin-top:-57px;">
				</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden active">
                        <a href="#"></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url($ln."/aboutus"); ?>" class="page-scroll"><?php echo lang('about_us'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url($ln."/partners"); ?>" class="page-scroll"><?php echo lang('vip_pass'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url($ln."/franquicias"); ?>" class="page-scroll"><?php echo lang('franchises'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url($ln."/concierge"); ?>" class="page-scroll"><?php echo lang('concierge'); ?></a>
                    </li>
					<li>
                        <a href="<?php echo site_url($ln."/faq"); ?>" class="page-scroll"><?php echo lang('faq'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url($ln."/contacts"); ?>" class="page-scroll"><?php echo lang('contact'); ?></a>
                    </li>
					<li>
                        <a href="<?php echo site_url($ln."/reservation"); ?>" class="btn btn-warning mob-hide"><?php echo lang('book_now'); ?></a>
						<a href="<?php echo site_url($ln."/reservation"); ?>" class="page-scroll mob-show"><?php echo lang('book_now'); ?></a>
                    </li>
					<li class="mob-show">
                        <a href="#" class="page-scroll" style="font-size:30px;">X</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	<!-- Header -->
	<div class="container">
	<?php echo $this->layout->load_view('layout/alerts'); ?>
	</div>
