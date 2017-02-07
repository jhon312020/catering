ALTER TABLE `tbl_menus`  ADD `primary_image` VARCHAR(255) NOT NULL  AFTER `description_primary_plate`;
ALTER TABLE `tbl_menus`  ADD `secondary_image` VARCHAR(255) NOT NULL  AFTER `description_secondary_plate`;
ALTER TABLE `tbl_orders`  ADD `menu_id` INT NOT NULL  AFTER `client_id`;
ALTER TABLE `tbl_orders`  ADD `menu_name` VARCHAR(255) NOT NULL  AFTER `menu_id`;
/* by JR */
ALTER TABLE `tbl_clients` CHANGE `business_id` `business_id` INT(11) NULL DEFAULT NULL;

/* 1 February 2017 */
ALTER TABLE `tbl_menus`  ADD `full_price` INT NOT NULL  AFTER `postre`,  ADD `half_price` INT NOT NULL  AFTER `full_price`;
ALTER TABLE `tbl_orders`  ADD `order_type` VARCHAR(255) NOT NULL  AFTER `menu_id`;

/* 2 February 2017 */
ALTER TABLE `tbl_orders`  ADD `reference_no` VARCHAR(255) NOT NULL  AFTER `id`;
ALTER TABLE `tbl_orders` DROP `menu_name`;
ALTER TABLE `tbl_orders`  ADD `payment_method` VARCHAR(255) NOT NULL  AFTER `order_date`;
ALTER TABLE `tbl_orders`  ADD `price` INT NOT NULL  AFTER `payment_method`;


CREATE TABLE IF NOT EXISTS `tbl_temporary_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


/*7-2-2017*/
ALTER TABLE `tbl_clients`  ADD `client_business_name` VARCHAR(255) NOT NULL  AFTER `surname`;
ALTER TABLE `tbl_temporary_orders`  ADD `cool_drinks_array` TEXT NOT NULL  AFTER `order_type`;

CREATE TABLE IF NOT EXISTS `tbl_cool_drinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drinks_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tbl_order_drinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `drinks_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


