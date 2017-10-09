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
-- Table structure for table `tbl_fontes`
--

DROP TABLE IF EXISTS `tbl_fontes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fontes` (
  `ftn_id` int(11) NOT NULL AUTO_INCREMENT,
  `ftn_nome` varchar(255) NOT NULL,
  `ftn_status` int(11) NOT NULL,
  `ftn_convencao` int(11) NOT NULL DEFAULT '1',
  `ftn_cota` varchar(255) NOT NULL,
  `ftn_descricao` text,
  `gtr_id` int(11) NOT NULL,
  `acv_id` int(11) NOT NULL,
  PRIMARY KEY (`ftn_id`),
  KEY `fk_fontes_grupos_trabalho1_idx` (`gtr_id`),
  KEY `fk_fontes_arquivos1_idx` (`acv_id`),
  CONSTRAINT `fk_fontes_arquivos1` FOREIGN KEY (`acv_id`) REFERENCES `tbl_acervos` (`acv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fontes_grupos_trabalho1` FOREIGN KEY (`gtr_id`) REFERENCES `tbl_grupos_trabalho` (`gtr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fontes`
--

LOCK TABLES `tbl_fontes` WRITE;
/*!40000 ALTER TABLE `tbl_fontes` DISABLE KEYS */;
INSERT INTO `tbl_fontes` VALUES (2,'Livro 2',1,4,'CEDOPE TAB 1CTBA L2','',4,16),(3,'Livro 3',1,4,'CEDOPE TAB 1CTBA L3','',4,16),(4,'Livro 4',1,4,'CEDOPE TAB 1CTBA L4','',4,16),(5,'Livro 8',1,4,'CEDOPE TAB 1CTBA L8','',4,16),(6,'Livro 7',1,4,'CEDOPE TAB 1CTBA L7','',4,16),(7,'Livro 5',1,4,'CEDOPE TAB 1CTBA L5','',4,16),(8,'Livro 6',1,4,'CEDOPE TAB 1CTBA L6','',4,16),(11,'Fonte para teste',1,4,'Teste','',3,12);
/*!40000 ALTER TABLE `tbl_fontes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-09 11:58:15
