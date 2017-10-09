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
-- Table structure for table `tbl_tipos_atributo`
--

DROP TABLE IF EXISTS `tbl_tipos_atributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipos_atributo` (
  `ttr_id` varchar(255) NOT NULL,
  `ttr_nome` varchar(255) NOT NULL,
  `ttr_tipo` int(11) NOT NULL DEFAULT '1',
  `ttr_descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ttr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipos_atributo`
--

LOCK TABLES `tbl_tipos_atributo` WRITE;
/*!40000 ALTER TABLE `tbl_tipos_atributo` DISABLE KEYS */;
INSERT INTO `tbl_tipos_atributo` VALUES ('cargo','Cargo',1,NULL),('condicao','Condição',1,''),('data','Data',2,NULL),('despacho','Despacho',1,''),('dimensao','Dimensão',1,''),('estado','Estado',1,NULL),('legibilidade','Legibilidade',1,NULL),('local','Local',1,NULL),('local_assinatura','Local de Assinatura',1,NULL),('motivo','Motivo/Alegação',1,NULL),('nome','Nome',1,NULL),('objeto','Objeto',1,''),('observacao','Observação',1,NULL),('patente','Patente',1,NULL),('profissao','Profissão',1,''),('qualificacao','Qualificação',1,NULL),('residencia','Residência',1,NULL),('restricao','Restrição',1,''),('titulo','Título',1,NULL),('titulo_doc','Título do Documento',1,NULL),('valor','Valor',1,'');
/*!40000 ALTER TABLE `tbl_tipos_atributo` ENABLE KEYS */;
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
