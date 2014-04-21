-- MySQL dump 10.13  Distrib 5.5.36, for Linux (x86_64)
--
-- Host: localhost    Database: ciaot1_netex
-- ------------------------------------------------------
-- Server version	5.5.36-cll

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
-- Table structure for table `billing_info`
--

DROP TABLE IF EXISTS `billing_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_info` (
  `ID` int(10) unsigned NOT NULL,
  `cust_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `street` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `cust_ID` (`cust_ID`),
  CONSTRAINT `billing_info_ibfk_1` FOREIGN KEY (`cust_ID`) REFERENCES `customers` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_info`
--

LOCK TABLES `billing_info` WRITE;
/*!40000 ALTER TABLE `billing_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_revenue`
--

DROP TABLE IF EXISTS `customer_revenue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_revenue` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cust_ID` int(10) unsigned NOT NULL,
  `sales_ID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `cust_ID` (`cust_ID`,`sales_ID`),
  KEY `sales_ID` (`sales_ID`),
  CONSTRAINT `customer_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customers` (`ID`),
  CONSTRAINT `customer_revenue_ibfk_1` FOREIGN KEY (`sales_ID`) REFERENCES `sales` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_revenue`
--

LOCK TABLES `customer_revenue` WRITE;
/*!40000 ALTER TABLE `customer_revenue` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_revenue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sponsor_ID` int(10) unsigned DEFAULT NULL,
  `enroller_ID` int(10) unsigned DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referralcode` varchar(255) DEFAULT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `position` text NOT NULL,
  `membership_type` text NOT NULL,
  `weekly_qualification` tinyint(1) NOT NULL,
  `monthly_qualification` tinyint(1) NOT NULL,
  `tree_qualification` tinyint(1) NOT NULL,
  `global_cap` float NOT NULL,
  `binary_cap` float NOT NULL,
  `monthly_expiration` date NOT NULL,
  `yearly_expiration` date NOT NULL,
  `cashbalance` float NOT NULL,
  `creditbalance` float NOT NULL,
  `pointsbalance` int(11) NOT NULL,
  `leftChild` int(11) DEFAULT NULL,
  `rightChild` int(11) DEFAULT NULL,
  `leftpoints` int(10) unsigned DEFAULT '0',
  `rightpoints` int(10) unsigned DEFAULT '0',
  `numberofclicks` int(10) unsigned DEFAULT '0',
  `status` text NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `document_location` text,
  `isPresident` tinyint(1) NOT NULL DEFAULT '0',
  `phone` int(11) unsigned NOT NULL,
  `fulladdress` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `referralcode` (`referralcode`),
  UNIQUE KEY `leftChild` (`leftChild`),
  UNIQUE KEY `rightChild` (`rightChild`),
  KEY `parent_ID` (`sponsor_ID`),
  KEY `enroller_ID` (`enroller_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (9,NULL,NULL,'aldi','aldi123','123','Aldi','Zhupani','aldi@test.com',1,'right','personal',1,1,0,1000,1000,'2014-04-20','2015-04-15',220,366,2000,NULL,126,5,6,8,'',1,'upload/ibiza.jpg',0,0,''),(136,126,9,'','sada','13653528a8e004fd','','','aldizhua@sdaslkdasklasksdsasa.com',1,'right','personal',0,0,0,2500,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,0,''),(137,126,9,'abcd','ae6aeeb6c9cef4a56391cadb1dd4e985efc34beb','137535292d874c87','abc','xyz','tenzin@ciaotelecom.com',1,'right','',0,0,0,0,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,3469292828,''),(139,0,0,'ciaotett','b38a8c928b2549bde379ee4c9ac0696ebf52e1da','139535293d1444ad','tett','ciao','tett@teo.com',1,'right','',0,0,0,0,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,4294967295,''),(140,0,0,'victorciao','96444b604d29e43d98a5be2d0ee36709a8a62c7c','140535294c5ec8e6','vic','choi','vic@ciaotele.com',1,'right','business',0,0,0,10000,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,4294967295,''),(160,126,9,'aldihjshjdsf','c30dd54ec07f6c92a1b5c58c3ac5ddcf174f167c','1605352b2203dfb1','aldi','zhupani','aldi.zhupani@ciaote,ecom.comsadas',1,'left','personal',0,0,0,2500,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,1243243223,''),(161,126,9,'savdhjasv','c30dd54ec07f6c92a1b5c58c3ac5ddcf174f167c','1615352b331a2b15','aldizh','sadfsafas','sdf@klhd.com',1,'right','business',0,0,0,10000,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,324234342,''),(162,126,9,'aldizh','c30dd54ec07f6c92a1b5c58c3ac5ddcf174f167c','1625352b4d8ebe59','aldi','zhupani','aldi.zhsaupani@ciaotsadelecom.com',1,'left','personal',0,0,0,2500,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,39021731,''),(163,126,9,'aldihjsdva','004ab20b269b014120746336febe3f9a8a6c25d8','1635352b6e272084','aldi','zhupani','aldi@gmailsada.com',1,'right','partner',0,0,0,0,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,2431423423,''),(164,126,9,'aldihjsdvawdew','c30dd54ec07f6c92a1b5c58c3ac5ddcf174f167c','1645352b74008309','aldi','zhupani','aldi@gmailsada.comasdsa',1,'left','partner',0,0,0,0,0,'2014-05-17','2015-04-19',0,0,0,NULL,NULL,0,0,0,'pending',NULL,NULL,0,2431423423,'289163921 LHJVSGHCGDH FREEESFDSsadsa');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollees`
--

DROP TABLE IF EXISTS `enrollees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollees` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `expiration_date` date NOT NULL,
  `enroller_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `enroller_ID` (`enroller_ID`),
  CONSTRAINT `enrollees_ibfk_1` FOREIGN KEY (`enroller_ID`) REFERENCES `customers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollees`
--

LOCK TABLES `enrollees` WRITE;
/*!40000 ALTER TABLE `enrollees` DISABLE KEYS */;
INSERT INTO `enrollees` VALUES (3,'business','2014-04-18',9),(4,'business','2014-04-16',9),(5,'president','2014-04-16',9),(6,'president','2014-04-22',9),(7,'president','2014-04-18',9);
/*!40000 ALTER TABLE `enrollees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_types`
--

DROP TABLE IF EXISTS `membership_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_types` (
  `ID` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `qualification_criteria` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_types`
--

LOCK TABLES `membership_types` WRITE;
/*!40000 ALTER TABLE `membership_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `membership_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `money_types`
--

DROP TABLE IF EXISTS `money_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `money_types` (
  `ID` int(11) NOT NULL,
  `credit` float NOT NULL,
  `cash` float NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `money_types`
--

LOCK TABLES `money_types` WRITE;
/*!40000 ALTER TABLE `money_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `money_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_cashpool`
--

DROP TABLE IF EXISTS `monthly_cashpool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monthly_cashpool` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_cashpool`
--

LOCK TABLES `monthly_cashpool` WRITE;
/*!40000 ALTER TABLE `monthly_cashpool` DISABLE KEYS */;
INSERT INTO `monthly_cashpool` VALUES (1,8300);
/*!40000 ALTER TABLE `monthly_cashpool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_commissions`
--

DROP TABLE IF EXISTS `monthly_commissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monthly_commissions` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sales_amount` float NOT NULL,
  `total_commissions` float NOT NULL,
  `month` text NOT NULL,
  `year` int(11) NOT NULL,
  `cust_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `cust_ID` (`cust_ID`),
  CONSTRAINT `customer id` FOREIGN KEY (`cust_ID`) REFERENCES `customers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_commissions`
--

LOCK TABLES `monthly_commissions` WRITE;
/*!40000 ALTER TABLE `monthly_commissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `monthly_commissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Cust_ID` int(10) unsigned NOT NULL,
  `type` text NOT NULL,
  `amount` float NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Cust_ID` (`Cust_ID`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cust_ID` int(10) unsigned NOT NULL,
  `amount` float NOT NULL,
  `sale_date` date NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `cust_ID` (`cust_ID`),
  CONSTRAINT `cust_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weekly_cashpool`
--

DROP TABLE IF EXISTS `weekly_cashpool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weekly_cashpool` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weekly_cashpool`
--

LOCK TABLES `weekly_cashpool` WRITE;
/*!40000 ALTER TABLE `weekly_cashpool` DISABLE KEYS */;
INSERT INTO `weekly_cashpool` VALUES (1,8300);
/*!40000 ALTER TABLE `weekly_cashpool` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-19 13:54:35
