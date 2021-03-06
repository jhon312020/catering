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

/*8-2-2017*/
ALTER TABLE `tbl_menus` CHANGE `full_price` `full_price` FLOAT NOT NULL, CHANGE `half_price` `half_price` FLOAT NOT NULL;
ALTER TABLE `tbl_cool_drinks`  ADD `price` FLOAT NOT NULL  AFTER `drinks_name`;
ALTER TABLE `tbl_temporary_orders`  ADD `price` FLOAT NOT NULL  AFTER `order_date`;
ALTER TABLE `tbl_orders` CHANGE `price` `price` FLOAT NOT NULL;
ALTER TABLE `tbl_temporary_orders` CHANGE `price` `price` FLOAT(10,2) NOT NULL;
ALTER TABLE `tbl_orders` CHANGE `price` `price` FLOAT(10,2) NOT NULL;
ALTER TABLE `tbl_menus` CHANGE `full_price` `full_price` FLOAT(10,2) NOT NULL;
ALTER TABLE `tbl_menus` CHANGE `half_price` `half_price` FLOAT(10,2) NOT NULL;
ALTER TABLE `tbl_cool_drinks` CHANGE `price` `price` FLOAT(10,2) NOT NULL;

/* 16-2-2017 */
ALTER TABLE `tbl_plats` ADD `image` VARCHAR(50) NOT NULL , ADD `is_active` INT NOT NULL DEFAULT '1' , ADD `created_at` TIMESTAMP NOT NULL , ADD `updated_at` DATETIME NULL ;

/* 21-Feb-2017 */

ALTER TABLE `tbl_business` DROP `time_limit`;
ALTER TABLE `tbl_business` DROP `direction`;
ALTER TABLE `tbl_centres` ADD `time_limit` TIME NULL DEFAULT NULL AFTER `Poblacio`;
ALTER TABLE `tbl_centres` ADD `is_active` INT NOT NULL DEFAULT '1' , ADD `created_at` TIMESTAMP NOT NULL , ADD `updated_at` DATETIME NULL ;
ALTER TABLE `tbl_business` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

/* 01-Mar-2017 */

ALTER TABLE `tbl_temporary_orders` ADD `Total` FLOAT(10,2) NOT NULL AFTER `price`, ADD `drink1_id` INT NOT NULL AFTER `Total`, ADD `drink2_id` INT NOT NULL AFTER `drink1_id`, ADD `priced1` FLOAT(10,2) NOT NULL AFTER `drink2_id`, ADD `priced2` FLOAT(10,2) NOT NULL AFTER `priced1`;