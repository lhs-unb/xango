-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: xango_dev
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `tbl_vinculos`
--

DROP TABLE IF EXISTS `tbl_vinculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_vinculos` (
  `vnc_id` int(11) NOT NULL AUTO_INCREMENT,
  `vnc_direcao` int(11) NOT NULL DEFAULT '1' COMMENT 'sentido do víncul',
  `tpv_id` varchar(200) NOT NULL,
  `gif_id_vinculante` int(11) NOT NULL,
  `gif_id_vinculado` int(11) NOT NULL,
  PRIMARY KEY (`vnc_id`),
  KEY `fk_vinculos_tipo_vinculo1_idx` (`tpv_id`),
  KEY `fk_vinculos******_tbl_grupos_informacao1_idx` (`gif_id_vinculante`),
  KEY `fk_vinculos******_tbl_grupos_informacao2_idx` (`gif_id_vinculado`),
  CONSTRAINT `fk_vinculos******_tbl_grupos_informacao1` FOREIGN KEY (`gif_id_vinculante`) REFERENCES `tbl_grupos_informacao` (`gif_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vinculos******_tbl_grupos_informacao2` FOREIGN KEY (`gif_id_vinculado`) REFERENCES `tbl_grupos_informacao` (`gif_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vinculos_tipo_vinculo1` FOREIGN KEY (`tpv_id`) REFERENCES `tbl_tipos_vinculo` (`tpv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_vinculos`
--

LOCK TABLES `tbl_vinculos` WRITE;
/*!40000 ALTER TABLE `tbl_vinculos` DISABLE KEYS */;
INSERT INTO `tbl_vinculos` VALUES (3,1,'administrado',534,535),(4,1,'mulher',552,551),(5,1,'mulher',576,577),(6,1,'administrado',578,576),(7,1,'filho',585,579),(8,1,'mulher',609,609),(9,1,'mulher',637,636),(10,1,'mulher',659,658),(11,1,'mulher',686,687),(12,1,'filho',686,688),(13,1,'curador',695,696),(14,1,'tutor',695,696),(15,1,'mulher',742,741),(16,1,'mulher',814,815),(17,1,'irmao',938,937),(18,1,'mulher',945,944),(19,1,'genro',960,944),(20,1,'mulher',982,981),(21,1,'mulher',984,983),(22,1,'mulher',986,985),(23,1,'mulher',988,987),(24,1,'tutor',1244,1250),(25,1,'mulher',1253,1254),(26,1,'viuva',1501,1502),(27,1,'mulher',1556,1555),(28,1,'viuva',1617,1616),(29,1,'pai',1662,1657),(30,1,'tutor',1678,1680),(31,1,'irmao',1721,1720),(32,1,'viuva',1748,1747),(33,1,'tutor',1745,1749),(34,1,'tutor',1745,1750),(35,1,'filho',1749,1747),(36,1,'filho',1750,1747),(37,1,'mulher',1765,1768),(38,1,'mulher',1979,1978),(39,1,'mulher',1982,1981),(40,1,'mulher',1989,1988),(41,1,'mulher',2027,2026),(42,1,'mulher',2035,2034),(43,1,'filho',2036,2035),(44,1,'filho',2037,2035),(45,1,'procurador',2038,2039),(46,1,'filho',2039,2038),(47,1,'mulher',2044,2043),(48,1,'mulher',2051,2050),(49,1,'mulher',2054,2052),(50,1,'genro',2055,2059),(51,1,'mulher',2065,2066),(52,1,'mulher',2072,2070),(53,1,'mulher',2076,2075),(54,1,'genro',2081,2080),(55,1,'mulher',2086,2085),(56,1,'mulher',2095,2094),(57,1,'genro',2101,2100),(58,1,'pai',2105,2100),(59,1,'procurador',2117,2108),(60,1,'mulher',2150,2149),(61,1,'mulher',2157,2156),(62,1,'mulher',2163,2162),(63,1,'mulher',2167,2166),(64,1,'sogra',2172,2171),(65,1,'mulher',2173,2171),(66,1,'filho',2178,2177),(67,1,'procurador',2178,2177),(68,1,'filho',2182,2180),(69,1,'mulher',2182,2181),(70,1,'mulher',2185,2184),(71,1,'procurador',2194,2186),(72,1,'mulher',2196,2197),(73,1,'filho',2195,2196),(74,1,'filho',2195,2197),(75,1,'mulher',2200,2199),(76,1,'filho',2204,2199),(77,1,'proferidor',2206,2205),(78,1,'mulher',2214,2213),(79,1,'procurador',2212,2213),(80,1,'mulher',2229,2230),(81,1,'genro',2233,2230),(82,1,'genro',2233,2229),(83,1,'procurador',2238,2237),(84,1,'mulher',2244,2243),(85,1,'cunhado',2245,2243),(86,1,'cunhado',2247,2243);
/*!40000 ALTER TABLE `tbl_vinculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-09 11:58:18
