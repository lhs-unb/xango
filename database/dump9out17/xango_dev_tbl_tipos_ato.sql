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
-- Table structure for table `tbl_tipos_ato`
--

DROP TABLE IF EXISTS `tbl_tipos_ato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipos_ato` (
  `tpa_id` varchar(255) NOT NULL,
  `tpa_nome` varchar(255) NOT NULL,
  `tpa_descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tpa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipos_ato`
--

LOCK TABLES `tbl_tipos_ato` WRITE;
/*!40000 ALTER TABLE `tbl_tipos_ato` DISABLE KEYS */;
INSERT INTO `tbl_tipos_ato` VALUES ('auto_posse','Auto de posse',NULL),('avulso','Documento avulso',NULL),('carta','Carta',NULL),('carta_alforria','Carta de alforria',NULL),('certidao','Certidão',NULL),('certidao_posse','Certidão de posse',NULL),('confirmacao_sesmaria','Carta de confirmação de sesmaria',NULL),('credito','Crédito',NULL),('datas_capoes','Datas de capões',NULL),('destrato','Destrato de escritura',NULL),('escritura_atuacao','Escritura de autuação',NULL),('escritura_companhia','Escritura de companhia',NULL),('escritura_desistencia','Escritura de desistência',NULL),('escritura_diversa','Escritura diversa',NULL),('escritura_divida','Escritura de dívida',NULL),('escritura_doacao','Escritura de doação (graça)',NULL),('escritura_dote','Escritura de dote',NULL),('escritura_emprestimo','Escritura de dinheiro a juros (empréstimo)',NULL),('escritura_obrigacao','Escritura de obrigação',NULL),('escritura_perdao','Escritura de perdão',NULL),('escritura_sociedade','Escritura de sociedade',NULL),('escritura_terra','Escritura de terra',NULL),('escritura_venda','Escritura de venda',NULL),('mandado','Mandado',NULL),('peticao','Petição',NULL),('procuracao_bastante','Procuração bastante',NULL),('quitacao','Quitação',NULL),('recibo','Recibo',NULL),('seguro','Seguro',NULL),('sesmaria','Carta de sesmaria',NULL),('termo_arrematacao','Termo de arrematação',NULL),('termo_composicao','Termo de composição',NULL);
/*!40000 ALTER TABLE `tbl_tipos_ato` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-09 11:58:14
