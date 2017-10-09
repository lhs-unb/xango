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
-- Table structure for table `tbl_tipos_funcao`
--

DROP TABLE IF EXISTS `tbl_tipos_funcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipos_funcao` (
  `tpf_id` varchar(255) NOT NULL,
  `tpf_nome` varchar(255) NOT NULL,
  `tpf_descricao` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`tpf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipos_funcao`
--

LOCK TABLES `tbl_tipos_funcao` WRITE;
/*!40000 ALTER TABLE `tbl_tipos_funcao` DISABLE KEYS */;
INSERT INTO `tbl_tipos_funcao` VALUES ('beneficiario','Beneficiário',''),('comprador','Comprador',''),('concessao','Concessão',''),('defunto','Defunto',NULL),('doacao','Doação',''),('doador','Doador','Doador'),('escrivao','Escrivão','Autor do ato formal do documento'),('legislacao','Legislação','Legislação que a fonte se embassa'),('mencionado','Mencionado','Sujeito mencionado no documento sem função específica'),('objeto','Objeto',''),('outorgado','Outorgado','Pessoa que recebe os direitos concedidos por outrem'),('outorgante','Outorgante','Quem outorga direitos a outra pessoa'),('procurador','Procurador',''),('sentenca_judicial','Sentença Judicial',''),('sesmeiro','Sesmeiro','Beneficiários da doação de uma sesmaria'),('signatario','Signatário',''),('suplicante','Suplicante',''),('tabeliao','Tabelião','Tabelião que faz o assento das escrituras'),('terras','Terras',''),('vendedor','Vendedor',''),('vizinho','Vizinho','');
/*!40000 ALTER TABLE `tbl_tipos_funcao` ENABLE KEYS */;
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
