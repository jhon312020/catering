-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 05:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business`
--

CREATE TABLE IF NOT EXISTS `tbl_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direction` text NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `time_limit` time NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_business`
--

INSERT INTO `tbl_business` (`id`, `name`, `email`, `direction`, `telephone`, `contact_person`, `time_limit`, `is_active`, `updated_at`, `created_at`) VALUES
(4, 'test', 'test@mail.com', 'Test direction', '90909', 'Bright', '02:30:00', 1, '0000-00-00 00:00:00', '2017-01-24 13:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE IF NOT EXISTS `tbl_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intolerances` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bill` tinyint(1) NOT NULL DEFAULT '1',
  `billing_data` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`id`, `client_code`, `name`, `surname`, `business_id`, `email`, `password`, `password_key`, `telephone`, `dni`, `intolerances`, `iban`, `bill`, `billing_data`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test', 'Bright', 'saharia', 4, 'bright@proisc.com', 'test', '', '9090', 'asdf', 'asdf', 'asdf', 1, 'sdf', 1, '2017-01-25 08:25:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_conditions`
--

CREATE TABLE IF NOT EXISTS `tbl_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conditions` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_conditions`
--

INSERT INTO `tbl_conditions` (`id`, `conditions`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '<p>Test name123</p>\r\n', 1, '2017-01-25 15:08:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE IF NOT EXISTS `tbl_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `tbl_contacts`
--

INSERT INTO `tbl_contacts` (`id`, `email`, `name`, `description`, `is_active`, `created`) VALUES
(229, 'jgasso88@gmail.com', 'Jordana', 'Hola! Quiero saber si paso mi booking porque no me ha llegado mi ticket y no me deja hacerlo otra vez dice que estoy "double booking"', 1, '2016-12-20 15:05:03'),
(230, 'r12w4n@hotmail.com', 'Rizwan alam', 'I am extremely disappointed and upset with the service I have received from pick and go. I had a booking with yourselves which I received a confirmation email with the booking times. \n\nTo my dissappontment, on our arrival date the driver took us to Barcelona (our destination) and dropped us off nowhere near our hotel. This resulted in us getting lost and took us over 30 minutes to find our hotel.\n\nOn our return date, my email confirmation said 7:30am for pick up from the hotel.\n\nMy wife and I waited from 7:20am, as it was requested to be ready 10mins prior to the allocated slot, untill 8:00am and nobody arrived. Can I also add that to make it easier for the driver we were stood outside on the main road so he could pick us up without having to turn in to the hotel.\n\nWhen i called the pick n go number, i was told that our pick up was at 6:15am\n\nI spoke to the advisor and expained that i had a confirmation email, the advisor said he couldnt do anything and that he didn''t care.\n\nI then had to call a taxi which ended up costing me 40euros. Bearing in mind we had a flight to catch and our schedule was tight.\n\nWe woke up early and on time, we even missed having breakfast at our hotel so that we could be ready on time.\n\nAbsolutely awful service.\n\nI have a copy of the email confirmation that i was sent.\n\nMy booking reference is: MOZ315912\n\nAs a result of this terrible service i would like a full refund and some form of compensation as the service was not provided and as advertised and i feel like the end of the holiday was ruined thanks to yourselves. \n\nI await your reply. \n\nRizwan Alam', 1, '2016-12-21 14:21:07'),
(231, 'seo@waytostay.com', 'Waytostay', 'Hola,\n\nSoy Sarah de Waytostay Korea. No hemos recibido nuestra comisión las últimas 4 reservas. La última era de Sunyoung Park (PNG-06092016-3 F 3-13580).\nTe aviso que la segunda reserva para Inja Choi (PNG-19112016-3 F 1-17230) no había realizado porque el conductor no fue al apartamento. \nSerá 11.40€. \n\nEspero tu respuesta.\n\nSaludos,\n\nSarah Tae\n', 1, '2016-12-21 16:16:31'),
(232, 'mglynn@advsol.com', 'Mark glynn', 'Hello\nWe due arrive at 1730 and are hoping to book a shuttle for two people to Midtown Luxury Apartments, 08009. But your system won''t allow us to book as it''s less than four hours away.\nIs this still possible to arrange when we land? At the moment we believe our flight is approx 30-45 mins late departing London.\nI look forward to hearing back from you\nThanks\nMark\n', 1, '2016-12-22 15:17:38'),
(233, 'shturmantour@gmail.com', 'Yuliya Shturman', 'Hello. We booked a room in Novotel Barcelona City from the 28/12. How much does it cost to get from Airport in Barcelona to Novotel Barcelona City (Avenida Diagonal 201), and 01/01 back to Airport? We are two adults and two children.\nHow can we book your transfer? Is it possible to pay by credit card? What do we get after paying? Can we sign our flight number? What can we do if our flight is delayed? And till what day it''s not too late to book your transfer? \nWe''d like to get this important information.\nBest Regards,\nSHTURMAN Family.', 1, '2016-12-23 07:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE IF NOT EXISTS `tbl_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type_id` int(11) NOT NULL,
  `menu_date` date NOT NULL,
  `complement` varchar(255) NOT NULL,
  `primary_plate` varchar(255) NOT NULL,
  `description_primary_plate` text NOT NULL,
  `secondary_plate` varchar(255) NOT NULL,
  `description_secondary_plate` text NOT NULL,
  `postre` varchar(255) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`id`, `menu_type_id`, `menu_date`, `complement`, `primary_plate`, `description_primary_plate`, `secondary_plate`, `description_secondary_plate`, `postre`, `disabled`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-01-25', 'asdf', 'sadf', 'sdf', 'sf', 'swfr', 'swef', 0, 1, '2017-01-25 10:47:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_types`
--

CREATE TABLE IF NOT EXISTS `tbl_menu_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_menu_types`
--

INSERT INTO `tbl_menu_types` (`id`, `menu_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 1, '2017-01-25 10:06:20', '2017-01-25 10:06:20'),
(2, 'Diet', 1, '2017-01-25 10:06:20', '2017-01-25 10:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` longtext NOT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`setting_id`, `setting_key`, `setting_value`) VALUES
(1, 'default_language', 'english'),
(2, 'date_format', 'd/m/Y'),
(3, 'todays_month', '10'),
(4, 'site_name', '.:: CMS ::.'),
(5, 'extra_scripts', '<script></script>'),
(6, 'google_scripts', ''),
(7, 'theme', 'aps'),
(8, 'block1', ''),
(9, 'block2', ''),
(10, 'currency_symbol', '$'),
(11, 'currency_symbol_placement', 'before'),
(12, 'invoices_due_after', ''),
(13, 'default_invoice_group', ''),
(14, 'default_invoice_template', ''),
(15, 'default_invoice_tax_rate', ''),
(16, 'default_include_item_tax', ''),
(17, 'default_item_tax_rate', ''),
(18, 'default_invoice_terms', ''),
(19, 'quotes_expire_after', ''),
(20, 'default_quote_group', ''),
(21, 'default_quote_template', ''),
(22, 'smtp_server_address', ''),
(23, 'smtp_authentication', '0'),
(24, 'smtp_username', ''),
(25, 'smtp_password', ''),
(26, 'smtp_port', ''),
(27, 'smtp_security', ''),
(28, 'default_email_template', ''),
(29, 'merchant_enabled', '0'),
(30, 'merchant_driver', ''),
(31, 'merchant_test_mode', '0'),
(32, 'merchant_username', ''),
(33, 'merchant_password', ''),
(34, 'merchant_signature', ''),
(35, 'menu', '<ul class="nav pull-right">\n	<li><a class="menu-a" href="<?php echo site_url(''/'');?>">Home </a></li>\n	<li><a class="menu-a" href="<?php echo site_url(''page/enquiry'');?>">Enquiry</a></li>\n	<li><a class="menu-a" href="<?php echo site_url(''page/about-us'');?>">About Us</a></li>\n	<li><a class="menu-a" href="portfolio.html">Portfolio</a></li>\n	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Legal</a>\n	<ul class="dropdown-menu">\n		<li><a class="menu-a" href="<?php echo site_url(''page/enquiry'');?>">Copyright</a></li>\n		<li><a class="menu-a" href="<?php echo site_url(''page/enquiry'');?>">Disclaimer</a></li>\n		<li><a class="menu-a" href="<?php echo site_url(''page/privacy-policy'');?>">Privacy Policy</a></li>\n	</ul>\n	</li>\n	<li><a class="menu-a" href="<?php echo site_url(''page/suggestion'');?>">Suggestion</a></li>\n	<li><a class="menu-a" href="<?php echo site_url(''page/helpers'');?>">Helpers</a></li>\n</ul>\n'),
(36, 'slider', '<div class="item active" style="text-align:center">\n<div class="wrapper"><img alt="business webebsite template" src="<?php echo $template_path;?>themes/images/carousel/business_website_templates_1.jpg" />\n<div class="carousel-caption">\n<h2>What we do?</h2>\n\n<p>We specialise in web design, web development and graphic design for different Desktop, Mobiles and Tablets. We recently introduce cheapest and best mobile web design packages in our services.</p>\n<a class="btn btn-large btn-success" href="services.html">Read more</a></div>\n</div>\n</div>\n\n<div class="item" style="text-align:center">\n<div class="wrapper"><img alt="business themes" src="<?php echo $template_path;?>themes/images/carousel/business_website_templates_2.jpg" />\n<div class="carousel-caption">\n<h2>Who we are?</h2>\n\n<p>We specialise in web design, web development and graphic design for different Desktop, Mobiles and Tablets. We recently introduce cheapest and best mobile web design packages in our services.</p>\n<a class="btn btn-large btn-success" href="about_us.html">Read more</a></div>\n</div>\n</div>\n\n<div class="item" style="text-align:center">\n<div class="wrapper"><img alt="business themes" src="<?php echo $template_path;?>themes/images/carousel/business_website_templates_3.jpg" />\n<div class="carousel-caption">\n<h2>What we have done?</h2>\n\n<p>We specialise in web design, web development and graphic design for different Desktop, Mobiles and Tablets. We recently introduce cheapest and best mobile web design packages in our services.</p>\n<a class="btn btn-large btn-success" href="portfolio.html">Our Portfolio</a></div>\n</div>\n</div>\n\n<div class="item" style="text-align:center">\n<div class="wrapper"><img alt="business themes" src="<?php echo $template_path;?>themes/images/carousel/business_website_templates_4.jpg" />\n<div class="carousel-caption">\n<h2>Blog</h2>\n\n<p>We specialise in web design, web development and graphic design for different Desktop, Mobiles and Tablets. We recently introduce cheapest and best mobile web design packages in our services.</p>\n<a class="btn btn-large btn-success" href="blog.html">Recent NEWS</a></div>\n</div>\n</div>\n\n<div class="item" style="text-align:center">\n<div class="wrapper"><img alt="business themes" src="<?php echo $template_path;?>themes/images/carousel/business_website_templates_5.jpg" />\n<div class="carousel-caption">\n<h2>Need help?</h2>\n\n<p>We specialise in web design, web development and graphic design for different Desktop, Mobiles and Tablets. We recently introduce cheapest and best mobile web design packages in our services.</p>\n<a class="btn btn-large btn-success" href="contact.html">Contact us</a></div>\n</div>\n</div>\n'),
(37, 'footer', '<div class="row-fluid">\n<div class="span4">\n<h4>Newsletter and Subscription</h4>\n\n<h5>Our aim</h5>\n<em>&quot;To provide affordable web design and development services for different devices is our aim, that fully meet your requirements.&quot; </em><br />\n&nbsp;\n<h5>What our client say?</h5>\n<em> &quot; I can confirm, bougth the theme a couple of days afo and it is really fantastic. Very flexible, very good support. I really like it.&quot; </em><br />\n&nbsp;\n<h5>Subscription</h5>\n</div>\n\n<div class="span5">\n<h4>Latest news</h4>\n\n<ul class="media-list">\n	<li class="media"><a class="pull-left" href="blog_details.html"><img alt="bootstrap business template" class="media-object" src="themes/images/img64x64.png" /> </a>\n\n	<div class="media-body">\n	<h5 class="media-heading">Why our customers satisfied?</h5>\n	&quot;To provide affordable web design and...&quot;<br />\n	<small><em>November 14, 2012</em> <a href="blog_details.html"> More</a></small></div>\n	</li>\n	<li class="media"><a class="pull-left" href="blog_details.html"><img alt="bootstrap business template" class="media-object" src="themes/images/img64x64.png" /> </a>\n	<div class="media-body">\n	<h5 class="media-heading">Why our customers satisfied?</h5>\n	&quot;To provide affordable web design and...&quot;<br />\n	<small><em>November 14, 2012</em> <a href="blog_details.html"> More</a></small></div>\n	</li>\n	<li class="media"><a class="pull-left" href="blog_details.html"><img alt="bootstrap business template" class="media-object" src="themes/images/img64x64.png" /> </a>\n	<div class="media-body">\n	<h5 class="media-heading">Why our customers satisfied?</h5>\n	&quot;To provide affordable web design and...&quot;<br />\n	<small><em>November 14, 2012</em> <a href="blog_details.html"> More</a></small></div>\n	</li>\n	<li class="media"><a class="pull-left" href="blog_details.html"><img alt="bootstrap business template" class="media-object" src="themes/images/img64x64.png" /> </a>\n	<div class="media-body">\n	<h5 class="media-heading">Why our customers satisfied?</h5>\n	&quot;To provide affordable web design and...&quot;<br />\n	<small><em>November 14, 2012</em> <a href="blog_details.html"> More</a></small></div>\n	</li>\n</ul>\n</div>\n\n<div class="span3">\n<h4>Visit us</h4>\n\n<address style="margin-bottom:15px;"><strong><a href="index.html" title="business">Business (p.) Ltd. </a></strong><br />\n194, Vectoria Street, Newwork<br />\nnw 488, USA</address>\nPhone: &nbsp; 00123 456 000 789<br />\nEmail: <a href="contact.html" title="contact"> info@companyltd.com</a><br />\nLink: <a href="index.html" title="Business ltd"> www.businessltd.com</a><br />\n&nbsp;\n<h5>Quick Links</h5>\n<a href="services.html" title="services"> Services </a><br />\n<a href="about.html" title="">About us </a><br />\n<a href="portfolio.html" title="portfolio">Portfolio </a>\n\n<h5>Find us on</h5>\n\n<div style="font-size:2.5em;"><!-- Facebook -->\n<div aria-hidden="true" aria-labelledby="facebook" class="modal hide fade" id="facebook" role="dialog" tabindex="-1">\n<div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>\n\n<h3>Facebook Header</h3>\n</div>\n\n<div class="modal-body">\n<p>&quot;Our aim is simple - to provide affordable web design and development services for Mobile and Computer by creating websites that fully meet your requirements a professional look that inspire confidence in your customer.&quot;</p>\n</div>\n\n<div class="modal-footer"><button aria-hidden="true" class="btn" data-dismiss="modal">Close</button><button class="btn btn-primary">Save changes</button></div>\n</div>\n<!-- Twitter -->\n\n<div aria-hidden="true" aria-labelledby="twitter" class="modal hide fade" id="twitter" role="dialog" tabindex="-1">\n<div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>\n\n<h3>Twitter Header</h3>\n</div>\n\n<div class="modal-body">\n<p>&quot;Our aim is simple - to provide affordable web design and development services for Mobile and Computer by creating websites that fully meet your requirements a professional look that inspire confidence in your customer.&quot;</p>\n</div>\n\n<div class="modal-footer"><button aria-hidden="true" class="btn" data-dismiss="modal">Close</button><button class="btn btn-primary">Save changes</button></div>\n</div>\n<!-- Rss feed -->\n\n<div aria-hidden="true" aria-labelledby="rss" class="modal hide fade" id="rss" role="dialog" tabindex="-1">\n<div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>\n\n<h3>RSS fed header</h3>\n</div>\n\n<div class="modal-body">\n<p>&quot;Our aim is simple - to provide affordable web design and development services for Mobile and Computer by creating websites that fully meet your requirements a professional look that inspire confidence in your customer.&quot;</p>\n</div>\n\n<div class="modal-footer"><button aria-hidden="true" class="btn" data-dismiss="modal">Close</button><button class="btn btn-primary">Save changes</button></div>\n</div>\n<!-- Youtube -->\n\n<div aria-hidden="true" aria-labelledby="youtube" class="modal hide fade" id="youtube" role="dialog" tabindex="-1">\n<div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>\n\n<h3>Youtube Vedio</h3>\n</div>\n\n<div class="modal-body">Vedios here</div>\n\n<div class="modal-footer"><button aria-hidden="true" class="btn" data-dismiss="modal">Close</button><button class="btn btn-primary">Save changes</button></div>\n</div>\n</div>\n</div>\n</div>\n\n<p style="padding:18px 0 44px">&copy; 2012, allright reserved</p>\n'),
(38, 'site_title', 'Catering'),
(39, 'site_email', 'catering@test.com'),
(40, 'site_footer', ''),
(41, 'front_id', '6'),
(42, 'site_url', 'http://www.pickngo.com/'),
(43, 'upload_folder', 'assets/cc/'),
(44, 'media_admin_logo', 'http://www.pickngo.com/./assets/cc/images/dossier1_(dragged)_5.jpg'),
(45, 'social_instagram', ''),
(46, 'social_facebook', ''),
(47, 'social_pinterest', ''),
(48, 'social_twitter', ''),
(49, 'social_youtube', ''),
(50, 'social_soundcloud', ''),
(51, 'def_lang', 'es'),
(52, 'address', 'hello@pickngo.com\n'),
(53, 'telephone', '+34 935 227 445');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(400) NOT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `role`, `first_name`, `last_name`, `email`, `password`, `secret_key`, `is_active`, `created`) VALUES
(1, 1, 'First', 'Admin', 'hello@pickngo.com', '07ab242311dbad887fb03e4a25092781', 'Y2F0ZXJpbmdfcGlja25nbw==', 1, '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
