-- MySQL dump 10.13  Distrib 5.1.60, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: syzygy
-- ------------------------------------------------------
-- Server version	5.1.60

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `associates`
--

DROP TABLE IF EXISTS `associates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `associates` (
  `associate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'FK_STORES',
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `phone_extension` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL COMMENT 'SHA1',
  `admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'BOOLEAN',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'YES/NO',
  PRIMARY KEY (`associate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associates`
--

LOCK TABLES `associates` WRITE;
/*!40000 ALTER TABLE `associates` DISABLE KEYS */;
/*!40000 ALTER TABLE `associates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(5) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `coupon_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(45) DEFAULT NULL,
  `coupon_expiration` datetime DEFAULT NULL,
  `coupon_type` set('AMOUNT','PERCENT') DEFAULT NULL,
  `coupon_amount` decimal(5,2) DEFAULT NULL,
  `coupon_percent` decimal(2,2) DEFAULT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_contacts`
--

DROP TABLE IF EXISTS `customer_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_contacts` (
  `contact_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,
  `contact_type` set('GENERAL','A/R','A/P','SALES','PURCHASING') NOT NULL DEFAULT 'GENERAL',
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `phone_extension` varchar(6) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_contacts`
--

LOCK TABLES `customer_contacts` WRITE;
/*!40000 ALTER TABLE `customer_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_ship_addresses`
--

DROP TABLE IF EXISTS `customer_ship_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_ship_addresses` (
  `ship_address_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `attn` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` set('AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','PR','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AB','BC','MB','NB','NF','NS','NT','ON','PE','QC','SK','YT') DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ship_address_id`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_ship_addresses`
--

LOCK TABLES `customer_ship_addresses` WRITE;
/*!40000 ALTER TABLE `customer_ship_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_ship_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_number` int(11) NOT NULL,
  `account_status` set('ACTIVE','INACTIVE','SUSPENDED') NOT NULL DEFAULT 'ACTIVE',
  `company_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address1` varchar(75) NOT NULL,
  `address2` varchar(75) DEFAULT NULL,
  `city` varchar(75) NOT NULL,
  `state` set('AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','PR','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AB','BC','MB','NB','NF','NS','NT','ON','PE','QC','SK','YT') NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `country` varchar(45) NOT NULL DEFAULT 'us',
  `default_ship_method` set('PICKUP','USPS','UPS GROUND','UPS 3 DAY','UPS 2ND DAY','UPS NEXTDAY','FEDEX GROUND','FEDEX EXPRESS') NOT NULL DEFAULT 'PICKUP',
  `phone` varchar(10) NOT NULL,
  `phone_ext` tinyint(4) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `payment_terms` set('PREPAY','COD','NET 10','NET 15','NET 20','NET 30','NET 45','NET 60','NET 90') NOT NULL DEFAULT 'PREPAY',
  `credit_limit` decimal(7,2) DEFAULT NULL,
  `tax_exemption` varchar(45) DEFAULT NULL,
  `shipper_number` varchar(45) DEFAULT NULL,
  `billing_email` varchar(45) DEFAULT NULL,
  `sales_rep` varchar(45) DEFAULT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_line_items`
--

DROP TABLE IF EXISTS `invoice_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_line_items` (
  `invoice_id` int(11) unsigned NOT NULL COMMENT 'References invoice_id in invoices table',
  `line_no` tinyint(4) unsigned NOT NULL,
  `quantity` tinyint(4) unsigned NOT NULL,
  `sku` int(10) unsigned NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `ext_price` decimal(9,2) NOT NULL,
  PRIMARY KEY (`invoice_id`,`line_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_line_items`
--

LOCK TABLES `invoice_line_items` WRITE;
/*!40000 ALTER TABLE `invoice_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `invoice_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned NOT NULL,
  `invoice_date` datetime NOT NULL,
  `sales_tax` decimal(5,2) DEFAULT NULL,
  `shipping` decimal(5,2) DEFAULT NULL,
  `handling` decimal(5,2) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_line_items`
--

DROP TABLE IF EXISTS `order_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_line_items` (
  `order_id` int(11) unsigned NOT NULL,
  `line_no` tinyint(3) unsigned NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  `sku` varchar(25) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `ext_price` decimal(7,2) NOT NULL,
  `item_options` varchar(45) DEFAULT NULL,
  `personalization` text,
  `production_details` text,
  `line_notes` text,
  PRIMARY KEY (`order_id`,`line_no`),
  KEY `fk_order_id_oli` (`order_id`),
  KEY `fk_line_no_oli` (`line_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_line_items`
--

LOCK TABLES `order_line_items` WRITE;
/*!40000 ALTER TABLE `order_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,
  `order_type` set('QUOTE','ORDER') NOT NULL,
  `ship_method` varchar(45) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_date_promised` datetime DEFAULT NULL,
  `order_date_scheduled` datetime DEFAULT NULL,
  `order_date_event` datetime DEFAULT NULL,
  `order_date_completed` datetime DEFAULT NULL,
  `order_date_shipped` datetime DEFAULT NULL,
  `order_status` set('NEW','PROCESSING','PENDING','BACKORDERED','PARTIAL-SHIPPED','SHIPPED','CANCELED') NOT NULL DEFAULT 'NEW',
  `order_associate_notes` text,
  `order_customer_notes` text,
  `purchase_order_id` int(10) unsigned DEFAULT NULL,
  `order_subtotal` decimal(9,2) DEFAULT '0.00',
  `order_ship_total` decimal(7,2) DEFAULT '0.00',
  `order_discount` decimal(5,2) DEFAULT '0.00',
  `order_total_taxable` decimal(9,2) DEFAULT '0.00',
  `order_total_nontaxable` decimal(9,2) DEFAULT '0.00',
  `order_sales_tax` decimal(5,2) DEFAULT '0.00',
  `order_payment` decimal(9,2) DEFAULT '0.00',
  `order_balance_due` decimal(9,2) DEFAULT '0.00',
  `order_received_by` varchar(50) DEFAULT NULL,
  `order_description` text,
  `ship_address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_line_items`
--

DROP TABLE IF EXISTS `po_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po_line_items` (
  `purchase_order_id` int(10) unsigned NOT NULL,
  `line_no` tinyint(3) unsigned NOT NULL,
  `vendor_id` smallint(5) unsigned NOT NULL,
  `sku` varchar(25) DEFAULT NULL,
  `vendor_sku` varchar(25) DEFAULT NULL,
  `qty_ordered` tinyint(3) unsigned DEFAULT NULL,
  `qty_shipped` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`,`line_no`,`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_line_items`
--

LOCK TABLES `po_line_items` WRITE;
/*!40000 ALTER TABLE `po_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `po_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postal_codes`
--

DROP TABLE IF EXISTS `postal_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postal_codes` (
  `postal_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postal_code` varchar(45) DEFAULT NULL,
  `region_name` varchar(255) DEFAULT NULL,
  `region_abbreviation` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`postal_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postal_codes`
--

LOCK TABLES `postal_codes` WRITE;
/*!40000 ALTER TABLE `postal_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `postal_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `category_id` smallint(5) unsigned NOT NULL,
  `root_category` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `parent_category_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category_name` varchar(50) DEFAULT NULL,
  `category_descp` text,
  `category_image` varchar(50) DEFAULT NULL,
  `category_sort_id` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_cross_up_sell`
--

DROP TABLE IF EXISTS `product_cross_up_sell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_cross_up_sell` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pcus_type` varchar(15) DEFAULT NULL,
  `base_sku` varchar(25) DEFAULT NULL,
  `link_sku` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_cross_up_sell`
--

LOCK TABLES `product_cross_up_sell` WRITE;
/*!40000 ALTER TABLE `product_cross_up_sell` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_cross_up_sell` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_features`
--

DROP TABLE IF EXISTS `product_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_features` (
  `sku` varchar(25) NOT NULL,
  `feature_id` int(10) unsigned NOT NULL,
  `feature` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sku`,`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_features`
--

LOCK TABLES `product_features` WRITE;
/*!40000 ALTER TABLE `product_features` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_media`
--

DROP TABLE IF EXISTS `product_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_media` (
  `sku` varchar(25) NOT NULL,
  `product_media_type` tinyint(3) unsigned NOT NULL,
  `product_media_num` tinyint(3) unsigned NOT NULL,
  `product_media_name` varchar(45) DEFAULT NULL,
  `product_media_location` varchar(75) DEFAULT NULL,
  `product_media_alt` varchar(45) DEFAULT NULL,
  `product_media_descp` text,
  PRIMARY KEY (`sku`,`product_media_type`,`product_media_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_media`
--

LOCK TABLES `product_media` WRITE;
/*!40000 ALTER TABLE `product_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_media_types`
--

DROP TABLE IF EXISTS `product_media_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_media_types` (
  `type_id` int(10) unsigned NOT NULL,
  `type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_media_types`
--

LOCK TABLES `product_media_types` WRITE;
/*!40000 ALTER TABLE `product_media_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_media_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_metadata`
--

DROP TABLE IF EXISTS `product_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_metadata` (
  `product_metadata_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(25) NOT NULL,
  `page_url` varchar(50) DEFAULT NULL,
  `page_title` varchar(50) DEFAULT NULL,
  `keywords` text,
  PRIMARY KEY (`product_metadata_id`),
  UNIQUE KEY `product_metadata_id_UNIQUE` (`product_metadata_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_metadata`
--

LOCK TABLES `product_metadata` WRITE;
/*!40000 ALTER TABLE `product_metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_reviews` (
  `review_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `sku` varchar(25) DEFAULT NULL,
  `review_date` date DEFAULT NULL,
  `review_rating` tinyint(4) DEFAULT NULL,
  `review_text` text,
  PRIMARY KEY (`review_id`),
  UNIQUE KEY `review_id_UNIQUE` (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_to_category`
--

DROP TABLE IF EXISTS `product_to_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_to_category` (
  `sku` varchar(25) NOT NULL,
  `category_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`sku`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_category`
--

LOCK TABLES `product_to_category` WRITE;
/*!40000 ALTER TABLE `product_to_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_to_store`
--

DROP TABLE IF EXISTS `product_to_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_to_store` (
  `sku` varchar(25) NOT NULL,
  `store_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`sku`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_store`
--

LOCK TABLES `product_to_store` WRITE;
/*!40000 ALTER TABLE `product_to_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_to_variation`
--

DROP TABLE IF EXISTS `product_to_variation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_to_variation` (
  `ptv_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(25) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `parent_sku` varchar(25) DEFAULT NULL,
  `vendor_sku` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ptv_id`),
  UNIQUE KEY `ptv_id_UNIQUE` (`ptv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_variation`
--

LOCK TABLES `product_to_variation` WRITE;
/*!40000 ALTER TABLE `product_to_variation` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_variation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_to_vendor`
--

DROP TABLE IF EXISTS `product_to_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_to_vendor` (
  `sku` varchar(25) NOT NULL,
  `vend_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sku`,`vend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_vendor`
--

LOCK TABLES `product_to_vendor` WRITE;
/*!40000 ALTER TABLE `product_to_vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variations`
--

DROP TABLE IF EXISTS `product_variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variations` (
  `variation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `variation_name` varchar(40) NOT NULL,
  `variation_values` text,
  PRIMARY KEY (`variation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variations`
--

LOCK TABLES `product_variations` WRITE;
/*!40000 ALTER TABLE `product_variations` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `sku` varchar(25) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(5,2) unsigned DEFAULT NULL,
  `weight` decimal(4,2) unsigned DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sku`),
  UNIQUE KEY `sku_UNIQUE` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('UP-0001','Rose Trio','Three beautiful hybrid roses, arranged in a clear bud vase, with lush greenery and filler flowers of the day.  Rose color and varieties vary depending on market availability.','17.95','3.00',1,100),('UP-0002','1/2 Dozen Roses','Six hybrid roses, arranged in a vase, with lush greenery and filler flowers of the day.  Rose color and varieties vary depending on market availability.  ','37.50','2.50',1,100);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_orders` (
  `purchase_order_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned DEFAULT NULL,
  `trans_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_status` set('NEW','SUBMITTED','BACKORDERED','SHIPPED','PARTIAL-SHIPPED','CANCELED') DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`),
  UNIQUE KEY `purchase_order_id_UNIQUE` (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_main`
--

DROP TABLE IF EXISTS `return_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_main` (
  `return_rma` varchar(10) NOT NULL,
  PRIMARY KEY (`return_rma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_main`
--

LOCK TABLES `return_main` WRITE;
/*!40000 ALTER TABLE `return_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_tracking`
--

DROP TABLE IF EXISTS `shipment_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment_tracking` (
  `shipment_tracking_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carrier_id` int(10) unsigned DEFAULT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`shipment_tracking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_tracking`
--

LOCK TABLES `shipment_tracking` WRITE;
/*!40000 ALTER TABLE `shipment_tracking` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states_provinces`
--

DROP TABLE IF EXISTS `states_provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states_provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(5) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states_provinces`
--

LOCK TABLES `states_provinces` WRITE;
/*!40000 ALTER TABLE `states_provinces` DISABLE KEYS */;
/*!40000 ALTER TABLE `states_provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `store_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(45) NOT NULL,
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `country` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `store_email` varchar(45) DEFAULT NULL,
  `sales_tax_rate` decimal(4,4) DEFAULT NULL,
  `logo` varchar(45) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores_associates`
--

DROP TABLE IF EXISTS `stores_associates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores_associates` (
  `store_id` int(11) unsigned NOT NULL,
  `associate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`store_id`,`associate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores_associates`
--

LOCK TABLES `stores_associates` WRITE;
/*!40000 ALTER TABLE `stores_associates` DISABLE KEYS */;
/*!40000 ALTER TABLE `stores_associates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_contacts`
--

DROP TABLE IF EXISTS `vendor_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_contacts` (
  `vendor_contact_id` int(11) NOT NULL,
  `vendor_id` smallint(6) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) NOT NULL,
  `ext` tinyint(4) DEFAULT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `contact_type` set('PURCHASING','SALES','ACCOUNTING','GENERAL') NOT NULL DEFAULT 'GENERAL',
  `vendors_vendor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`vendor_contact_id`,`vendors_vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_contacts`
--

LOCK TABLES `vendor_contacts` WRITE;
/*!40000 ALTER TABLE `vendor_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `vendor_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account_number` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL COMMENT 'DISPLAY_ON_SELECT',
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `address3` varchar(45) DEFAULT NULL,
  `city` varchar(45) NOT NULL,
  `state` set('AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','PR','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AB','BC','MB','NB','NF','NS','NT','ON','PE','QC','SK','YT') NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `phone_tollfree` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `web_user` varchar(45) DEFAULT NULL,
  `web_password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-30 13:08:42
