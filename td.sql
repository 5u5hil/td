-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 03:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `td`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE IF NOT EXISTS `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `attr_type` bigint(20) NOT NULL,
  `is_filterable` tinyint(4) NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attr`, `attr_type`, `is_filterable`, `desc`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Shoe Size', 1, 0, '', 'shoe-size', '2015-09-22 06:39:38', '2015-09-22 06:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_sets`
--

CREATE TABLE IF NOT EXISTS `attribute_sets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attr_set` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attribute_sets`
--

INSERT INTO `attribute_sets` (`id`, `attr_set`, `created_at`, `updated_at`) VALUES
(1, 'Default', '2015-09-16 00:22:06', '2015-09-16 00:22:06'),
(2, 'Shoe', '2015-09-22 06:37:52', '2015-09-22 06:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_types`
--

CREATE TABLE IF NOT EXISTS `attribute_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attr_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attribute_types`
--

INSERT INTO `attribute_types` (`id`, `attr_type`, `created_at`, `updated_at`) VALUES
(1, 'Select', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `attr_id` bigint(20) NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` varchar(200) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attr_id`, `option_name`, `option_value`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '5', '5', 1, 1, '2015-09-22 12:09:38', '2015-09-22 12:09:38'),
(2, 1, '6', '6', 1, 2, '2015-09-22 12:09:38', '2015-09-22 12:09:38'),
(3, 1, '7', '7', 1, 3, '2015-09-22 12:09:38', '2015-09-22 12:09:38'),
(4, 1, '8', '8', 1, 4, '2015-09-22 12:09:38', '2015-09-22 12:09:38'),
(5, 1, '9', '9', 1, 5, '2015-09-22 12:09:39', '2015-09-22 12:09:39'),
(6, 1, '10', '10', 1, 6, '2015-09-22 12:09:39', '2015-09-22 12:09:39'),
(7, 1, '11', '11', 1, 7, '2015-09-22 12:09:39', '2015-09-22 12:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_images`
--

CREATE TABLE IF NOT EXISTS `catalog_images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL,
  `alt_text` varchar(100) NOT NULL,
  `image_type` tinyint(4) NOT NULL,
  `image_mode` int(50) NOT NULL,
  `catalog_id` bigint(20) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `catalog_images`
--

INSERT INTO `catalog_images` (`id`, `filename`, `alt_text`, `image_type`, `image_mode`, `catalog_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'prod-020150916103357.jpg', 'asdasd', 1, 0, 4, 1, '2015-09-16 10:33:57', '2015-09-16 10:33:57'),
(2, 'prod-020150916103526.png', 'asdasd', 1, 1, 1, 1, '2015-09-16 10:35:26', '2015-09-16 10:35:26'),
(3, 'prod-020150916103743.png', 'fgdfgdfg', 1, 3, 7, 1, '2015-09-16 10:37:43', '2015-09-16 10:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `folder` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci NOT NULL,
  `is_home` tinyint(1) NOT NULL,
  `is_nav` tinyint(1) NOT NULL,
  `is_filterable` tinyint(4) NOT NULL,
  `url_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keys` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `base_price` decimal(10,0) NOT NULL,
  `vat` float NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_lft_index` (`lft`),
  KEY `categories_rgt_index` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `short_desc`, `folder`, `images`, `is_home`, `is_nav`, `is_filterable`, `url_key`, `meta_title`, `meta_keys`, `meta_desc`, `sort_order`, `parent_id`, `base_price`, `vat`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'Shoes', '', '', '[]', 0, 0, 1, 'shoes', '', '', '', 0, NULL, '3000', 0, 1, 14, 0, '2015-09-21 03:57:24', '2015-09-21 04:11:44'),
(2, 'Ballet Flats', '', 'Ballet Flats', '["20150921104128-1.jpg"]', 1, 0, 0, 'ballet-flats', '', '', '', 1, 12, '3000', 0, 2, 3, 1, '2015-09-21 03:59:53', '2015-09-21 07:15:11'),
(3, 'Kitten Heels', '', '', '["20150921104627-1.jpg"]', 1, 0, 0, 'kitten-heels', '', '', '', 2, 12, '3000', 0, 4, 5, 1, '2015-09-21 04:00:28', '2015-09-21 05:16:27'),
(4, 'Mid Heels (3 Inches)', '', '', '["20150921104703-1.jpg"]', 1, 0, 0, 'mid-heels-3-inches', '', '', '', 3, 12, '3000', 0, 6, 7, 1, '2015-09-21 04:02:39', '2015-09-21 05:17:03'),
(5, 'Mid Heels (4 Inches)', '', '', '["20150921104719-1.jpg"]', 1, 0, 0, 'mid-heels-4-inches', '', '', '', 4, 12, '3000', 0, 8, 9, 1, '2015-09-21 04:03:33', '2015-09-21 05:17:20'),
(6, 'High Heels (4.5 Inches)', '', '', '["20150921104738-1.jpg"]', 1, 0, 0, 'high-heels', '', '', '', 5, 12, '3000', 0, 12, 13, 1, '2015-09-21 04:04:24', '2015-09-21 05:17:38'),
(7, 'Very High Heels (5.5 Inches)', '', '', '["20150921104804-1.jpg"]', 1, 0, 0, 'very-high-heels-5-5-', '', '', '', 6, 12, '3000', 0, 10, 11, 1, '2015-09-21 04:11:44', '2015-09-21 06:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `has_addresses`
--

CREATE TABLE IF NOT EXISTS `has_addresses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `has_attributes`
--

CREATE TABLE IF NOT EXISTS `has_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attr_id` bigint(20) NOT NULL,
  `attr_set` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `has_attributes`
--

INSERT INTO `has_attributes` (`id`, `attr_id`, `attr_set`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `has_categories`
--

CREATE TABLE IF NOT EXISTS `has_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cat_id` bigint(20) NOT NULL,
  `prod_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `has_combo_prods`
--

CREATE TABLE IF NOT EXISTS `has_combo_prods` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_id` bigint(20) NOT NULL,
  `combo_prod_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `has_options`
--

CREATE TABLE IF NOT EXISTS `has_options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_id` bigint(20) NOT NULL,
  `attr_id` bigint(20) NOT NULL,
  `attr_val` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `has_products`
--

CREATE TABLE IF NOT EXISTS `has_products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `prod_id` bigint(20) NOT NULL,
  `allocated` bigint(20) NOT NULL,
  `sub_prod_id` bigint(20) NOT NULL,
  `proforma_invoice_id` bigint(20) NOT NULL,
  `consignment_id` bigint(20) NOT NULL,
  `forwarder_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `finish_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `potential_completion_date` date NOT NULL,
  `ready_date` date NOT NULL,
  `pickup_req_date` date NOT NULL,
  `picked_up_date` date NOT NULL,
  `warehouse_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `no_qty_delivered` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `min` double NOT NULL,
  `max` double NOT NULL,
  `finish` text NOT NULL,
  `list` double NOT NULL,
  `curr` varchar(10) NOT NULL,
  `add` int(11) NOT NULL,
  `disc` double NOT NULL,
  `net` double NOT NULL,
  `landed` float NOT NULL,
  `del` int(11) NOT NULL,
  `uom` varchar(20) NOT NULL,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `breadth` float NOT NULL,
  `return_damage_date` date NOT NULL,
  `return_damage_remarks` text NOT NULL,
  `delivery_challan` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `upholstery` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `has_related_prods`
--

CREATE TABLE IF NOT EXISTS `has_related_prods` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_id` bigint(20) NOT NULL,
  `related_prod_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `has_upsell_prods`
--

CREATE TABLE IF NOT EXISTS `has_upsell_prods` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_id` bigint(20) NOT NULL,
  `upsell_prod_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `project_name` text NOT NULL,
  `subtotal` float NOT NULL,
  `discount` float NOT NULL,
  `total` float NOT NULL,
  `eta` date NOT NULL,
  `budget` double NOT NULL,
  `remarks` text NOT NULL,
  `client` int(11) NOT NULL,
  `architect` int(11) NOT NULL,
  `associate` int(11) NOT NULL,
  `cordinator` int(11) NOT NULL,
  `order_amt` double NOT NULL,
  `pay_amt` double NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cart` text NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address1` varchar(35) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `is_project` int(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=223 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin.dashboard', 'Dashboard', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(2, 'admin.category.view', 'Category View', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(3, 'admin.category.add', 'Category Add', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(4, 'admin.category.save', 'Category Save', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(5, 'admin.category.edit', 'Category Edit', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(6, 'admin.attribute.set.view', 'Attribute Set View', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(7, 'admin.attribute.set.add', 'Attribute Set Add', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(8, 'admin.attribute.set.save', 'Attribute Set Save', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(9, 'admin.attribute.set.edit', 'Attribute Set Edit', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(10, 'admin.attribute.set.delete', 'Attribute Set Delete', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(11, 'admin.attributes.view', 'Attributes View', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(12, 'admin.attributes.add', 'Attributes Add', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(13, 'admin.attributes.save', 'Attributes Save', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(14, 'admin.attributes.edit', 'Attributes Edit', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(15, 'admin.products.view', 'Products View', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(16, 'admin.products.add', 'Products Add', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(17, 'admin.products.delete', 'Products Delete', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(18, 'admin.products.save', 'Products Save', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(19, 'admin.products.general.info', 'Products General Info', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(20, 'admin.products.update', 'Products Update', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(21, 'admin.products.edit.category', 'Products Edit Category', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(22, 'admin.products.update.category', 'Products Update Category', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(23, 'admin.products.duplicate', 'Products Duplicate', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(24, 'admin.products.update.combo', 'Products Update Combo', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(25, 'admin.products.update.combo.attach', 'Products Update Combo Attach', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(26, 'admin.products.update.combo.detach', 'Products Update Combo Detach', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(27, 'admin.products.images', 'Products Images', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(28, 'admin.products.images.save', 'Products Images Save', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(29, 'admin.products.images.delete', 'Products Images Delete', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(30, 'admin.products.attributes.update', 'Products Attributes Update', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(31, 'admin.products.configurable.attributes', 'Products Configurable Attributes', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(32, 'admin.products.configurable.update', 'Products Configurable Update', NULL, '2015-09-12 03:11:15', '2015-09-12 03:11:15'),
(33, 'admin.combo.products.view', 'Combo Products View', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(34, 'admin.products.variant.update', 'Products Variant Update', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(36, 'admin.products.upsell', 'Products Upsell', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(37, 'admin.products.upsell.related', 'Products Upsell Related', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(38, 'admin.products.related.attach', 'Products Related Attach', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(39, 'admin.products.related.detach', 'Products Related Detach', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(40, 'admin.products.upsell.attach', 'Products Upsell Attach', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(41, 'admin.products.upsell.detach', 'Products Upsell Detach', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(42, 'admin.roles.view', 'Roles View', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(43, 'admin.roles.add', 'Roles Add', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(44, 'admin.roles.save', 'Roles Save', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(45, 'admin.roles.edit', 'Roles Edit', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(46, 'admin.systemusers.view', 'Systemusers View', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(47, 'admin.systemusers.add', 'Systemusers Add', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(48, 'admin.systemusers.save', 'Systemusers Save', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(49, 'admin.systemusers.edit', 'Systemusers Edit', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(50, 'admin.systemusers.update', 'Systemusers Update', NULL, '2015-09-12 03:11:16', '2015-09-12 03:11:16'),
(83, 'admin.products.configurable.update.without.stock', 'Products Configurable Update Without Stock', NULL, '2015-09-15 04:56:32', '2015-09-15 04:56:32'),
(84, 'admin.products.configurable.without.stock.attributes', 'Products Configurable Without Stock Attributes', NULL, '2015-09-15 04:56:32', '2015-09-15 04:56:32'),
(98, 'admin.miscellaneous.view', 'Miscellaneous View', NULL, '2015-09-15 04:56:33', '2015-09-15 04:56:33'),
(99, 'admin.miscellaneous.add', 'Miscellaneous Add', NULL, '2015-09-15 04:56:33', '2015-09-15 04:56:33'),
(100, 'admin.miscellaneous.edit', 'Miscellaneous Edit', NULL, '2015-09-15 04:56:33', '2015-09-15 04:56:33'),
(101, 'admin.miscellaneous.save', 'Miscellaneous Save', NULL, '2015-09-15 04:56:33', '2015-09-15 04:56:33'),
(102, 'admin.miscellaneous.delete', 'Miscellaneous Delete', NULL, '2015-09-15 04:56:33', '2015-09-15 04:56:33'),
(108, 'admin.category.delete', 'Category Delete', NULL, '2015-09-16 03:01:30', '2015-09-16 03:01:30'),
(118, 'admin.attributes.delete', 'Attributes Delete', NULL, '2015-09-16 03:01:30', '2015-09-16 03:01:30'),
(211, 'admin.roles.delete', 'Roles Delete', NULL, '2015-09-16 03:57:44', '2015-09-16 03:57:44'),
(222, 'admin.systemusers.delete', 'Systemusers Delete', NULL, '2015-09-16 03:57:44', '2015-09-16 03:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(83, 1),
(84, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(108, 1),
(118, 1),
(211, 1),
(222, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` text COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `short_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `long_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `add_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_type` bigint(20) NOT NULL,
  `attr_set` bigint(20) NOT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_avail` tinyint(1) NOT NULL,
  `stock` float NOT NULL,
  `cur` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `max_price` float NOT NULL,
  `min_price` float NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `unit_measure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width_cm` float NOT NULL,
  `breadth_cm` float NOT NULL,
  `height_cm` float NOT NULL,
  `width_inches` float NOT NULL,
  `breadth_inches` float NOT NULL,
  `height_inches` float NOT NULL,
  `width_feet` float NOT NULL,
  `breadth_feet` float NOT NULL,
  `height_feet` float NOT NULL,
  `spl_price` decimal(8,2) NOT NULL,
  `is_crowd_funded` tinyint(1) NOT NULL,
  `target_date` datetime NOT NULL,
  `target_qty` bigint(20) NOT NULL,
  `parent_prod_id` bigint(20) NOT NULL,
  `meta_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keys` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `art_cut` float NOT NULL,
  `is_cod` tinyint(1) NOT NULL DEFAULT '1',
  `added_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_individual` tinyint(1) NOT NULL,
  `sort_order` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE IF NOT EXISTS `product_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `type`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Simple', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Combo', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Configurable with Stock Management', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Configurable without Stock Management', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prod_status`
--

CREATE TABLE IF NOT EXISTS `prod_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin', '2015-09-12 04:41:38', '2015-09-12 04:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `saved_list`
--

CREATE TABLE IF NOT EXISTS `saved_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` varchar(255) NOT NULL,
  `url_key` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `url_key`, `created_at`, `updated_at`) VALUES
(3, 'ACL', 'No', 'acl', '2015-09-15 08:18:56', '2015-09-15 10:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `tagging_tagged`
--

CREATE TABLE IF NOT EXISTS `tagging_tagged` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taggable_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tagged_taggable_id_index` (`taggable_id`),
  KEY `tagging_tagged_taggable_type_index` (`taggable_type`),
  KEY `tagging_tagged_tag_slug_index` (`tag_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagging_tags`
--

CREATE TABLE IF NOT EXISTS `tagging_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tagging_tags_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `avatar`, `provider`, `provider_id`, `first_name`, `last_name`, `email`, `password`, `company_name`, `address`, `contact_no`, `alternate_no`, `remember_token`, `user_type`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', '', 'Admin', '', 'admin@inficart.com', '$2y$10$qCsLyjKyb/J3gg2aast27.N.xLzQgCqHMozQrW0mQmesSgdIUZp9q', '', '', '', '', '5rmfT8XEBPnpvZ2wbC1CmEOwNN1WRZlSVmmKN3ASd5irFX6yLkFXjjSZdpOe', 1, '2015-09-12 04:56:51', '2015-09-21 03:05:41'),
(4, 'Sushil S', '5ushiL', 'http://pbs.twimg.com/profile_images/3547971997/251f35817ff446732813602918c5afac_normal.jpeg', 'twitter', '46624931', '', '', NULL, '', '', '', '', '', 'rcf0SvFkubGsEzfBPT76HnVblTLx5wTvbs1iB8Iu9bpZA7QCPeN753ChtKUJ', 0, '2015-09-22 03:14:31', '2015-09-22 03:14:31'),
(5, 'Sushil Sudhakaran', NULL, 'https://lh4.googleusercontent.com/-AWCPSu72WkM/AAAAAAAAAAI/AAAAAAAAALg/__tEuwisw5M/photo.jpg?sz=50', 'google', '103008556078831699651', '', '', 'sushilcs111@gmail.com', '', '', '', '', '', 'lILJ40oTkagbp8nlCBFDc7nguvN5DlVtUrgERVcncoTVpeButSUi3Z5J8wth', 0, '2015-09-22 03:54:16', '2015-09-22 03:54:17'),
(6, 'Sushil Sudhakaran', NULL, 'https://media.licdn.com/mpr/mprx/0_bIomh7sWzYoMHF8zbaeAhD0kcOOqekAzLWOAh2pUHZoXBh6vIDVCmuevJ1YII_rJQ', 'linkedin', 'Vpig5NNLIo', '', '', 'sushilcs111@gmail.com', '', '', '', '', '', 'FGrQHHlH70EvBBMqb5jMtLNAlybHivHcOBUdez2zMAq3HgvCKIMHfusdnHHY', 0, '2015-09-22 04:18:30', '2015-09-22 04:18:30'),
(7, 'Sushil Sudhakaran', NULL, 'https://graph.facebook.com/v2.4/10207512354756682/picture?type=normal', 'facebook', '10207512354756682', '', '', 'sushilcs111@gmail.com', '', '', '', '', '', 'srBwzpk9qd6PkThI08sPr1lioWMCviZV1JuiOKErWot9hBfaZSmh0g7PBrsc', 0, '2015-09-22 04:19:30', '2015-09-22 04:19:30');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
