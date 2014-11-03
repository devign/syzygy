-- MySQL dump 10.13  Distrib 5.5.39, for Linux (i686)
--
-- Host: localhost    Database: syzygy
-- ------------------------------------------------------
-- Server version	5.5.39-cll-lve

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_date` timestamp NULL DEFAULT NULL,
  `session_id` varchar(80) DEFAULT NULL,
  `cart_saved` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (5,'2014-10-17 23:37:19','diecjm9sigtsla0877f313ija0',NULL);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_line_items`
--

DROP TABLE IF EXISTS `cart_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_line_items` (
  `cart_id` int(10) unsigned NOT NULL,
  `line_no` tinyint(3) unsigned NOT NULL,
  `sku` varchar(25) DEFAULT NULL,
  `quantity` smallint(5) unsigned DEFAULT NULL,
  `personalization` text,
  `customizations` text,
  PRIMARY KEY (`cart_id`,`line_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_line_items`
--

LOCK TABLES `cart_line_items` WRITE;
/*!40000 ALTER TABLE `cart_line_items` DISABLE KEYS */;
INSERT INTO `cart_line_items` VALUES (5,1,'UP-0002',1,NULL,NULL);
/*!40000 ALTER TABLE `cart_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_menu`
--

DROP TABLE IF EXISTS `cms_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_menu` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_menu`
--

LOCK TABLES `cms_menu` WRITE;
/*!40000 ALTER TABLE `cms_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_pages`
--

DROP TABLE IF EXISTS `cms_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_pages` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(45) DEFAULT NULL,
  `page_title` varchar(70) DEFAULT NULL,
  `page_description` varchar(125) DEFAULT NULL,
  `page_keywords` varchar(125) DEFAULT NULL,
  `page_content` text,
  `root_page` tinyint(4) NOT NULL DEFAULT '1',
  `parent_page_id` tinyint(4) NOT NULL DEFAULT '0',
  `menu_id` tinyint(4) DEFAULT NULL,
  `store_id` int(10) unsigned DEFAULT NULL,
  `page_url` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_pages`
--

LOCK TABLES `cms_pages` WRITE;
/*!40000 ALTER TABLE `cms_pages` DISABLE KEYS */;
INSERT INTO `cms_pages` VALUES (1,'About Us','About Us','About Us Page','','<p>Owner and Floral Artist, Julie Lloyd, has been around the floral industry in several capacities, producing designs professionally for 30 years. </p> \r\n<p>Julie uses her Bachelor of Arts degree in Theatre Arts, from Minnesota State University-Moorhead, as well as her experience growing up in a florist family business and learning floral design from an early age.   Julie approaches each wedding or event as a production that is successful through thoughtful planning, meaningful choices, and collaboration.</p>\r\n',1,0,1,3,'about-us'),(2,'Home','Uptown Florist Home Page','Home Page',NULL,'Uptown Florist is Glenwood Minnesota’s newest full service florist shop, creating beautiful fresh floral arrangements for any occasion.   We carry fresh flowers, green and blooming plants, as well as a variety of unique gift items.   We deliver flowers and plants to Glenwood, Starbuck, Villard, Lowry, Alexandria, and the surrounding area.   ',1,0,0,3,'home'),(3,'Contact Us','Contact Uptown Florist','Contact us page.',NULL,NULL,1,0,1,3,'contact-us');
/*!40000 ALTER TABLE `cms_pages` ENABLE KEYS */;
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
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `payment_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
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
-- Table structure for table `product_brands`
--

DROP TABLE IF EXISTS `product_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_brands` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) DEFAULT NULL,
  `manufacturer` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`brand_id`),
  UNIQUE KEY `brand_id_UNIQUE` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_brands`
--

LOCK TABLES `product_brands` WRITE;
/*!40000 ALTER TABLE `product_brands` DISABLE KEYS */;
INSERT INTO `product_brands` VALUES (1,'UPTOWN FLORAL',NULL),(2,'FANNY FARMER',NULL);
/*!40000 ALTER TABLE `product_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `category_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `root_category` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `parent_category_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category_name` varchar(50) DEFAULT NULL,
  `category_descp` text,
  `category_image` varchar(50) DEFAULT NULL,
  `category_sort_order` smallint(6) NOT NULL DEFAULT '0',
  `category_heading` varchar(50) DEFAULT NULL,
  `category_subheading` varchar(50) DEFAULT NULL,
  `category_alt_descp` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,1,0,'Flowers','Flowers have traditionally conveyed a special meaning. They have been and continue to be used in many cultures to let the person know that you care about him. In addition, flowers can symbolize many things. For example, red roses symbolize love, passion and respect while white roses represent innocence, reverence and truth. Violets represent faithfulness, lilies symbolize majesty, and mimosa stands for sensitivity. You can add an additional meaning to the flowers if you write something on the card sent with them.','',1,'Flowers','Flowers Category Sub-Heading','The pink peony lures me in, along with a lonely ant crawling toward the vortex of petals, sucked in like the prey of a Venus Flytrap. I think of a page from May Sarton’s journal—Journal of a Solitude, the entry from June 23rd. Summer in New Hampshire could be Summer in Minnesota. The humidity feels heavy. The world has gone mad. Too much happens these days. But the peony rises every year from buried piles of January snow, from the trampling of the mailman over her Winter stalks, from under the tire tracks of the neighbor’s SUV the night it drifted off the pitched driveway and on to the muddy grass.'),(2,1,0,'Plants','Most plants have several names--minimally an English common name and a scientific name, but possibly several common names in each of several languages. Thus, the same plant is called: dandelion (English common name), Taraxacum officinale (scientific name)  dent-de-lion, (French common name), achicoria silvestre (Spanish common name) and maskros (Swedish common name). Of course it also has a Dutch, Flemish, German, Italian--you get the picture--',NULL,2,NULL,NULL,NULL),(3,1,0,'Occasions',NULL,NULL,0,NULL,NULL,NULL),(5,1,0,'Holiday',NULL,NULL,0,NULL,NULL,NULL),(6,1,0,'Gifts',NULL,NULL,0,NULL,NULL,NULL),(7,0,3,'Sympathy',NULL,NULL,0,NULL,NULL,NULL),(8,0,3,'Birthday',NULL,NULL,0,NULL,NULL,NULL),(9,0,3,'Anniversary',NULL,NULL,0,NULL,NULL,NULL),(10,0,3,'New Baby',NULL,NULL,0,NULL,NULL,NULL),(11,0,3,'Just Because',NULL,NULL,0,NULL,NULL,NULL);
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
  `product_media_num` tinyint(3) unsigned NOT NULL,
  `product_media_type` set('IMAGE','VIDEO','PDF') DEFAULT NULL,
  `product_media_name` varchar(45) DEFAULT NULL,
  `product_media_filepath` varchar(125) DEFAULT NULL,
  `product_media_url` varchar(150) DEFAULT NULL,
  `product_media_alt` varchar(45) DEFAULT NULL,
  `product_media_descp` text,
  PRIMARY KEY (`sku`,`product_media_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_media`
--

LOCK TABLES `product_media` WRITE;
/*!40000 ALTER TABLE `product_media` DISABLE KEYS */;
INSERT INTO `product_media` VALUES ('UP-0001',1,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL),('UP-0002',1,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL),('UP-0002',2,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL),('UP-0002',3,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL),('UP-0003',1,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL),('UP-0004',1,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL),('UP-0034',1,'IMAGE','expressions-of-love.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Expressions of Love',''),('UP-0035',1,'IMAGE','fresh-fall.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Fresh Fall',NULL),('UP-0036',1,'IMAGE','timeless-tribute.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Timeless Tribute',NULL),('UP-0037',1,'IMAGE','a-symmetry.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1',NULL,NULL),('UP-0041',1,'IMAGE','great-thoughts.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Great Thoughts',''),('UP-0044',1,'IMAGE','golden-memories.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Golden Memories',NULL),('UP-0046',1,'IMAGE','peaceful-times.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1/peaceful-times.jpg','media/IMAGE/1','Peaceful Times',NULL),('UP-0047',1,'IMAGE','sunny-days.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1/sunny-days.jpg','media/IMAGE/1','Sunny Days',NULL),('UP-0048',1,'IMAGE','natures-beauty.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1/natures-beauty.jpg','media/IMAGE/1','Natures Beauty',NULL),('UP-033',1,'IMAGE','purple-bokay.jpg','/home/data/devign-llc/dev/syzygy/media/IMAGE/1','media/IMAGE/1','Purple Bokay',NULL);
/*!40000 ALTER TABLE `product_media` ENABLE KEYS */;
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
INSERT INTO `product_to_category` VALUES ('',1),('UP-0001',1),('UP-0002',1),('UP-0002',9),('UP-0003',1),('UP-0003',2),('UP-0004',1),('UP-0034',1),('UP-0034',9),('UP-0035',1),('UP-0035',7),('UP-0036',1),('UP-0036',3),('UP-0036',7),('UP-0037',1),('UP-0037',3),('UP-0037',11),('UP-0038',3),('UP-0038',7),('UP-0039',3),('UP-0039',11),('UP-0040',3),('UP-0040',7),('UP-0041',1),('UP-0041',3),('UP-0041',7),('UP-0042',3),('UP-0042',7),('UP-0043',3),('UP-0043',7),('UP-0044',1),('UP-0044',3),('UP-0044',7),('UP-0044',11),('UP-0045',1),('UP-0045',3),('UP-0045',7),('UP-0046',1),('UP-0046',3),('UP-0046',11),('UP-0047',1),('UP-0048',1),('UP-0048',3),('UP-0048',9),('UP-033',1),('UP-033',2);
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
INSERT INTO `product_to_store` VALUES ('',3),('UP-0001',3),('UP-0002',3),('UP-0003',3),('UP-0004',3),('UP-0034',3),('UP-0035',3),('UP-0036',3),('UP-0037',3),('UP-0038',3),('UP-0039',3),('UP-0040',3),('UP-0041',3),('UP-0042',3),('UP-0043',3),('UP-0044',3),('UP-0045',3),('UP-0046',3),('UP-0047',3),('UP-0048',3),('UP-033',3);
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
  `vendor_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`sku`,`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_vendor`
--

LOCK TABLES `product_to_vendor` WRITE;
/*!40000 ALTER TABLE `product_to_vendor` DISABLE KEYS */;
INSERT INTO `product_to_vendor` VALUES ('',3),('UP-0001',3),('UP-0002',1),('UP-0002',3),('UP-0003',3),('UP-0004',3),('UP-0034',3),('UP-0035',3),('UP-0036',3),('UP-0041',3),('UP-0046',3),('UP-033',3);
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
  `variation_group` tinyint(4) DEFAULT NULL,
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
  `brand_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(5,2) unsigned DEFAULT NULL,
  `weight` decimal(4,2) unsigned DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `product_type` set('SIMPLE','VARIABLE','VIRTUAL','CUSTOMIZABLE') NOT NULL DEFAULT 'SIMPLE',
  `short_description` text,
  `features` text,
  `featured` tinyint(3) unsigned DEFAULT '0',
  `onsale` tinyint(3) unsigned DEFAULT '0',
  `sale_price` decimal(5,2) DEFAULT NULL,
  `product_url` varchar(50) DEFAULT NULL,
  `page_title` varchar(70) DEFAULT NULL,
  `keywords` text,
  PRIMARY KEY (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('UP-0001',1,'Rose Trio','Three beautiful hybrid roses, arranged in a clear bud vase, with lush greenery and filler flowers of the day.  Rose color and varieties vary depending on market availability.',17.95,3.00,1,'SIMPLE','','',1,1,15.00,'rose-trio','Rose Trio',NULL),('UP-0002',1,'1/2 Dozen Roses','Six hybrid roses, arranged in a vase, with lush greenery and filler flowers of the day.  Rose color and varieties vary depending on market availability.  ',37.50,2.50,1,'SIMPLE','','',0,0,0.00,'half-dozen-roses','1/2 Dozen Roses',NULL),('UP-0003',1,'Basket full of Posies','A mixed assortment of long-lasting flowers in a handled basket.  Perfect for everyday occasions.  Flower assortment and basket style vary according to availability.  ',40.00,2.00,1,'SIMPLE','','',0,0,0.00,'basket-full-of-posies','Basket full of Posies',NULL),('UP-0004',1,'Wildflower Vase','A natural, free style vase bouquet, reminiscent of the wild prairie.  Flower assortment and vase style vary according to availability.  ',49.99,3.00,1,'SIMPLE','','',0,0,0.00,'wildflower-vase','Wildflower Vase',NULL),('UP-0034',1,'Expressions of Love','A simple way to offer your condolences in a most memorable way. Four roses in your choice of colors with white filler flower and greenery. Standard color choice is red.  Please note if you would like alternate color. ',24.99,3.00,1,'SIMPLE','A simple way to offer your condolences in a most memorable way. Four roses in your choice of colors with white filler flower and greenery','',1,0,0.00,'expressions-of-love','Expressions of Love',NULL),('UP-0035',1,'Fresh Fall','Fresh fall colors in a colored ginger vase.',44.99,2.50,1,'SIMPLE','Fresh fall colors in a colored ginger vase.','',0,1,39.95,'fresh-fall','Fresh Fall',NULL),('UP-0036',1,'Timeless Tribute','Memories of a loved one will last forever. This arrangement offers comfort and serenity with the large gerbera daiseys accented with colorful berries and woodsy fillers in a decorative tin; a truley timeless Northern tribute.',34.99,2.50,1,'SIMPLE','Memories of a loved one will last forever. ',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0037',1,'A Symmetry','A modern, lush design of all white flowers and select greenery in a low decorative tin. Highly stylish and unique.',39.99,3.00,1,'SIMPLE','A modern, lush design of all white flowers and select greenery in a low decorative tin.',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0038',1,'Spring Pastels','Large arrangement of spring colors such as lavender, yellow, white, and pink flowers in a unique container.  This one will surely brighten someone\'s day.',64.99,5.00,1,'SIMPLE','Large arrangement of spring colors such as lavender, yellow, white, and pink flowers in a unique container.  ',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0039',1,'Touching Expression','Celebrate a life well lived with this bright and beautiful vase arrangement filled with roses, snapdragons, and other seasonally colored flowers.',49.99,4.00,1,'SIMPLE','',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0040',1,'Rustic Blossoms','A collection of fall colored flowers, cattails, leaves and grasses arranged in a keepsake container. ',59.99,3.00,1,'SIMPLE','A collection of fall colored flowers, cattails, leaves and grasses arranged in a keepsake container. ',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0041',1,'Great Thoughts','One blooming 6\'\' plant and a \"Great Thoughts\" stone placed in a double peanut basket. ',39.99,2.56,1,'SIMPLE','','',0,0,0.00,'great-thoughts','Great Thoughts',NULL),('UP-0042',1,'Always Remembered','Honor a beautiful person with a beautiful white bouquet. This abundant arrangement of  all white flowers gives the message of peace.',69.99,5.00,1,'SIMPLE','Honor a beautiful person with a beautiful white bouquet.',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0043',1,'Plentiful Blooms','Send your condolences with the fragrant beauty of a fresh arrangment along with the lasting beauty of a houseplant.  ',49.99,3.50,1,'SIMPLE','',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0044',1,'Golden Memories ','Basket bouquet of all bright yellow, long lasting flowers.  ',49.99,3.60,1,'SIMPLE','',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0045',1,'Happy Memories','This tasteful, inspiring mix of sympathy flowers for the family is bursting with color. The arrangement features an array of seasonally colored flowers that will touch everyone\'s hearts, artistically arranged in designers choice container',74.99,3.20,1,'SIMPLE','This tasteful, inspiring mix of sympathy flowers for the family is bursting with color. ',NULL,0,0,NULL,NULL,NULL,NULL),('UP-0046',1,'Peaceful Times','',99.95,0.00,1,'SIMPLE','','',0,1,89.95,'peaceful-times','Peaceful Times',NULL),('UP-0047',1,'Sunny Days','Bright and colorful garden mixture of fresh flowers will brighten anyones day!  ',49.99,5.00,1,'SIMPLE','','Bright and sunny\r\nVariety of flowers\r\nPretty colorful',0,0,0.00,'sunny-days','Sunny Days',NULL),('UP-0048',1,'Natures Beauty','Naturally arranged in a vintage tin with delphinium, gerbera daisys, and snapdragons. ',64.99,3.50,1,'SIMPLE','','',0,1,59.69,'natures-beauty','Natures Beauty',NULL),('UP-033',1,'Big Old Piece of Shit','This thing is a big piece of shit. We shit all over it and put it in a vase but it still smells like roses.',29.95,3.50,1,'SIMPLE','Stinky piece of shit. Brown as Toby\'s ass.',NULL,0,0,NULL,NULL,NULL,NULL);
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
  `vendor_id` smallint(5) unsigned NOT NULL,
  `trans_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_status` set('NEW','SUBMITTED','BACKORDERED','SHIPPED','PARTIAL-SHIPPED','CANCELED') DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`)
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
  `order_id` int(10) unsigned NOT NULL,
  `tracking_id` tinyint(3) unsigned NOT NULL,
  `carrier_id` int(10) unsigned DEFAULT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`tracking_id`)
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
-- Table structure for table `shipping_carriers`
--

DROP TABLE IF EXISTS `shipping_carriers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_carriers` (
  `carrier_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `carrier_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`carrier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_carriers`
--

LOCK TABLES `shipping_carriers` WRITE;
/*!40000 ALTER TABLE `shipping_carriers` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping_carriers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_methods`
--

DROP TABLE IF EXISTS `shipping_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_methods` (
  `method_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `carrier_id` tinyint(3) unsigned NOT NULL,
  `method_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`method_id`,`carrier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_methods`
--

LOCK TABLES `shipping_methods` WRITE;
/*!40000 ALTER TABLE `shipping_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping_methods` ENABLE KEYS */;
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
  `domain` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,'Sweet Fantasee','',NULL,'','','',NULL,NULL,NULL,'info@sweetfantasee.com',NULL,'','sweetfantasee.com'),(2,'Aroma Cents','',NULL,'','','',NULL,NULL,NULL,NULL,NULL,'','aromacents.com'),(3,'Uptown Florist','','','','','','','','','',0.0000,'','myuptownflorist.com'),(4,'Saddles n Spurs','',NULL,'','','',NULL,NULL,NULL,NULL,NULL,'','saddlesnspurs.com');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores_users`
--

DROP TABLE IF EXISTS `stores_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores_users` (
  `store_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`store_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores_users`
--

LOCK TABLES `stores_users` WRITE;
/*!40000 ALTER TABLE `stores_users` DISABLE KEYS */;
INSERT INTO `stores_users` VALUES (3,1),(3,2);
/*!40000 ALTER TABLE `stores_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `phone_extension` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` text NOT NULL COMMENT 'SHA1',
  `admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'YES/NO',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'YES/NO',
  `avatar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jon','Raugutt','7013882491','100',NULL,'jon@raugutt.com','oldgregg','005439513f9e80d4a03abe91de0c3965d4882466',1,1,'user-portrait-jon-raugutt.png'),(2,'Tyson','Irby',NULL,NULL,NULL,NULL,'tyson','c7504353d6cbda55a8c284193405530580438aee',1,1,'user-portrait-tyson-irby.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_contacts`
--

DROP TABLE IF EXISTS `vendor_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_contacts` (
  `vendor_contact_id` int(11) NOT NULL,
  `vendor_id` smallint(5) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) NOT NULL,
  `ext` tinyint(4) DEFAULT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `contact_type` set('PURCHASING','SALES','ACCOUNTING','GENERAL') NOT NULL DEFAULT 'GENERAL',
  PRIMARY KEY (`vendor_contact_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'231346595','FANNY FARMER','1223 FIRST ST',NULL,NULL,'JONESWTOWN','KY','23162','','87754623316',NULL,NULL,'www.fannyfarmer.com','uptown',NULL),(2,'13245648','EARLS WHOLESALE VASES','2465 EASY STREET',NULL,NULL,'JIMTOWN','IN','41562','','8884251656',NULL,'earlsvases@gmail.com','www.wholesalevases.com','upflorist','12345'),(3,'100','Uptown Florist','39 Uptown Avenue',NULL,NULL,'Glenwood','MN','56123','','8889495645',NULL,'sales@myuptownflorist.com','www.myuptownflorist.com',NULL,NULL);
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

-- Dump completed on 2014-11-03 16:40:43
