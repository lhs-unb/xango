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
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuarios` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(255) NOT NULL,
  `usu_login` varchar(255) NOT NULL,
  `usu_senha` varchar(1000) NOT NULL,
  `usu_email` varchar(255) NOT NULL,
  `usu_lattes` varchar(255) DEFAULT NULL,
  `usu_biografia` varchar(10000) DEFAULT NULL,
  `usu_admin` int(11) NOT NULL DEFAULT '0' COMMENT 'Caso 1, é administrador do sistema,',
  `usu_ativo` int(1) DEFAULT '1',
  `usu_score` int(11) DEFAULT '0',
  `usu_level` int(3) DEFAULT '1',
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `login_UNIQUE` (`usu_login`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'Leonardo Barleta','lbarleta','202cb962ac59075b964b07152d234b70','lbarleta@gmail.com',NULL,NULL,1,1,6004,11),(4,'Tiago Gil','tgil','202cb962ac59075b964b07152d234b70','tgil@gmail.com',NULL,NULL,1,1,0,1),(5,'Cássio Couto','ccouto','202cb962ac59075b964b07152d234b70','ccouto@gmail.com',NULL,NULL,0,0,0,1),(6,'Sebastião José de Carvalho e Mello','pombal','9518fcbed21ea1baa2552302e13c66fe','secretaria@coroaportuguesa.gov.pt',NULL,NULL,1,1,0,1);
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
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
