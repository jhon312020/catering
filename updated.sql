
/* 26- May-2017 */
ALTER TABLE `tbl_business` ADD `paid_by` ENUM('user','company') NOT NULL DEFAULT 'user' AFTER `contact_person`;

ALTER TABLE `tbl_business` ADD `card` BOOLEAN NOT NULL DEFAULT FALSE AFTER `paid_by`, ADD `draft` BOOLEAN NOT NULL DEFAULT FALSE AFTER `card`, ADD `ticket` BOOLEAN NOT NULL DEFAULT FALSE AFTER `draft`, ADD `cash` BOOLEAN NOT NULL DEFAULT FALSE AFTER `ticket`;

CREATE TABLE `tbl_promotional_codes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
 `discount_type` enum('percentage','price') COLLATE utf8_unicode_ci DEFAULT NULL,
 `price_or_percentage` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
 `is_active` tinyint(1) NOT NULL DEFAULT '1',
 `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_discount_applied` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(255) NOT NULL,
  `promotional_code_id` int(11) NOT NULL,
  `original_total_price` double NOT NULL,
  `discount` double NOT NULL,
  `total_price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


/* 30-May-2017 */
ALTER TABLE `tbl_business`
  DROP `paid_by`;


/* 28-June-2017 */
ALTER TABLE `tbl_promotional_codes` ADD `expired_at` DATE NULL DEFAULT NULL AFTER `price_or_percentage`;

ALTER TABLE `tbl_promotional_codes` ADD `company_ids` TEXT NULL AFTER `expired_at`;