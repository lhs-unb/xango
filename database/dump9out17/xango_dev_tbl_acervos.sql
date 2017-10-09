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
-- Table structure for table `tbl_acervos`
--

DROP TABLE IF EXISTS `tbl_acervos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_acervos` (
  `acv_id` int(11) NOT NULL AUTO_INCREMENT,
  `acv_cota` varchar(45) NOT NULL,
  `acv_nome` varchar(255) NOT NULL,
  `acv_descricao` varchar(10000) DEFAULT NULL,
  `acv_tipo_acervo` int(11) NOT NULL,
  `acv_id_pai` int(11) DEFAULT NULL,
  PRIMARY KEY (`acv_id`),
  UNIQUE KEY `cota_UNIQUE` (`acv_cota`),
  KEY `fk_arquivos_arquivos1_idx` (`acv_id_pai`),
  CONSTRAINT `fk_arquivos_arquivos1` FOREIGN KEY (`acv_id_pai`) REFERENCES `tbl_acervos` (`acv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_acervos`
--

LOCK TABLES `tbl_acervos` WRITE;
/*!40000 ALTER TABLE `tbl_acervos` DISABLE KEYS */;
INSERT INTO `tbl_acervos` VALUES (11,'CEDOPE','Centro de Documentação e Pesquisa de História dos Domínios Portugueses','Vinculado ao Departamento de História, da Universidade Federal do Paraná',1,NULL),(12,'AESP','Arquivo Público do Estado de São Paulo','',1,NULL),(13,'FBN','Fundação Biblioteca Nacional','',1,NULL),(14,'AN','Arquivo Nacional','',1,NULL),(15,'CEDOPE TAB','Tabelionatos','Documentação relativas ao tabelionatos do Brasil colonial.',2,11),(16,'CEDOPE TAB 1CTBA','1o. Tabelionato de Notas de Curitiba - Giovanetti','Livros de notas do 1o. Tabelionato de Notas de Curitiba, a partir do início do século XVIII.',3,15);
/*!40000 ALTER TABLE `tbl_acervos` ENABLE KEYS */;
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
