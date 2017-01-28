ALTER TABLE `tbl_menus`  ADD `primary_image` VARCHAR(255) NOT NULL  AFTER `description_primary_plate`;
ALTER TABLE `tbl_menus`  ADD `secondary_image` VARCHAR(255) NOT NULL  AFTER `description_secondary_plate`;
ALTER TABLE `tbl_orders`  ADD `menu_id` INT NOT NULL  AFTER `client_id`;
ALTER TABLE `tbl_orders`  ADD `menu_name` VARCHAR(255) NOT NULL  AFTER `menu_id`;
/* by JR */
ALTER TABLE `tbl_clients` CHANGE `business_id` `business_id` INT(11) NULL DEFAULT NULL;
