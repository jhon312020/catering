<?php
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo current_url();die;
	$path = $this->uri->segment(2);
	$title = $this->mdl_settings->setting('site_title');
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gumen Catering</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
		<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/cc/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/cc/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/cc/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/cc/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
	<div class="container">
	<?php echo $this->layout->load_view('layout/alerts'); ?>
	</div>
