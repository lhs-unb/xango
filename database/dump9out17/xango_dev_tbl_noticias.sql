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
-- Table structure for table `tbl_noticias`
--

DROP TABLE IF EXISTS `tbl_noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_noticias` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_titulo` varchar(255) NOT NULL,
  `not_texto` text NOT NULL,
  `not_criacao` datetime NOT NULL,
  `not_alteracao` varchar(45) NOT NULL,
  `usu_id_criacao` int(11) NOT NULL,
  `usu_id_alteracao` int(11) NOT NULL,
  PRIMARY KEY (`not_id`),
  KEY `fk_tbl_noticias_tbl_usuarios1_idx` (`usu_id_criacao`),
  KEY `fk_tbl_noticias_tbl_usuarios2_idx` (`usu_id_alteracao`),
  CONSTRAINT `fk_tbl_noticias_tbl_usuarios1` FOREIGN KEY (`usu_id_criacao`) REFERENCES `tbl_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_noticias_tbl_usuarios2` FOREIGN KEY (`usu_id_alteracao`) REFERENCES `tbl_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_noticias`
--

LOCK TABLES `tbl_noticias` WRITE;
/*!40000 ALTER TABLE `tbl_noticias` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_noticias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-09 11:58:17
