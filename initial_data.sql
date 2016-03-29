-- MySQL dump 10.13  Distrib 5.6.12, for Linux (x86_64)
--
-- Host: localhost    Database: coisa1
-- ------------------------------------------------------
-- Server version	5.6.12

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
-- Table structure for table `campo`
--

DROP TABLE IF EXISTS `campo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `objeto_id` bigint(20) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campo_objeto_idx` (`objeto_id`),
  CONSTRAINT `fk_campo_objeto` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campo`
--

LOCK TABLES `campo` WRITE;
/*!40000 ALTER TABLE `campo` DISABLE KEYS */;
INSERT INTO `campo` VALUES (1,1,'Nome',1,1),(2,1,'Email',1,2),(3,3,'Numero',1,1),(4,2,'Nome',1,0),(5,6,'Nome',1,0),(6,3,'Nome',1,0),(7,3,'EndereÃ§o',1,0),(8,7,'SKU',1,0),(9,4,'Titulo',1,0),(10,4,'Descricao',1,0),(11,8,'Nome',1,0),(12,8,'Telefone',1,0),(13,8,'Email',1,0),(14,8,'EndereÃ§o',1,0),(15,10,'Logradouro',1,0),(16,10,'NÃºmero',2,0);
/*!40000 ALTER TABLE `campo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chave`
--

DROP TABLE IF EXISTS `chave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chave` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `objeto_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chave_objeto_idx` (`objeto_id`),
  CONSTRAINT `fk_chave_objeto` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chave`
--

LOCK TABLES `chave` WRITE;
/*!40000 ALTER TABLE `chave` DISABLE KEYS */;
INSERT INTO `chave` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,4),(12,4),(13,8),(14,8),(15,8),(16,8),(17,10),(18,10);
/*!40000 ALTER TABLE `chave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mashup`
--

DROP TABLE IF EXISTS `mashup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mashup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `layout` int(11) NOT NULL DEFAULT '0',
  `style` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mashup`
--

LOCK TABLES `mashup` WRITE;
/*!40000 ALTER TABLE `mashup` DISABLE KEYS */;
INSERT INTO `mashup` VALUES (1,'Tarefas',1,3);
/*!40000 ALTER TABLE `mashup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mashup_widget_xref`
--

DROP TABLE IF EXISTS `mashup_widget_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mashup_widget_xref` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mashup_id` bigint(20) NOT NULL,
  `widget_id` bigint(20) NOT NULL,
  `zona` int(11) NOT NULL DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_mashup_widget_xref_mashup_idx` (`mashup_id`),
  KEY `fk_mashup_widget_xref_widget_idx` (`widget_id`),
  CONSTRAINT `fk_mashup_widget_xref_mashup` FOREIGN KEY (`mashup_id`) REFERENCES `mashup` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_mashup_widget_xref_widget` FOREIGN KEY (`widget_id`) REFERENCES `widget` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mashup_widget_xref`
--

LOCK TABLES `mashup_widget_xref` WRITE;
/*!40000 ALTER TABLE `mashup_widget_xref` DISABLE KEYS */;
INSERT INTO `mashup_widget_xref` VALUES (1,1,5,1,1),(2,1,3,1,2);
/*!40000 ALTER TABLE `mashup_widget_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objeto`
--

DROP TABLE IF EXISTS `objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objeto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objeto`
--

LOCK TABLES `objeto` WRITE;
/*!40000 ALTER TABLE `objeto` DISABLE KEYS */;
INSERT INTO `objeto` VALUES (1,'Cliente'),(2,'Fornecedor'),(3,'Empresa'),(4,'Tarefa'),(5,'Tarefa'),(6,'Projeto'),(7,'Produto'),(8,'Contato'),(9,'Lista de Compras'),(10,'EndereÃ§o');
/*!40000 ALTER TABLE `objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valor`
--

DROP TABLE IF EXISTS `valor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campo_id` bigint(20) NOT NULL,
  `valor_campo` text,
  `chave_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_valor_campo_idx` (`campo_id`),
  KEY `fk_valor_chave_idx` (`chave_id`),
  CONSTRAINT `fk_valor_campo` FOREIGN KEY (`campo_id`) REFERENCES `campo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_valor_chave` FOREIGN KEY (`chave_id`) REFERENCES `chave` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valor`
--

LOCK TABLES `valor` WRITE;
/*!40000 ALTER TABLE `valor` DISABLE KEYS */;
INSERT INTO `valor` VALUES (1,1,'Fulano',1),(2,1,'Foo',2),(3,2,'fulano@gmail.com',1),(7,1,'afww',10),(8,2,'ewfaw',10),(9,9,'Testar api',11),(10,10,'vniowernjfripowe gwproh',11),(11,9,'Testar api',12),(12,10,'vniowernjfripowe gwproh',12),(13,12,'132465789',13),(14,11,'AndrÃ©',13),(15,13,'andre@gmail.com',13),(16,11,'Cristian',14),(17,12,'456789456',14),(18,13,'cristian@gmail.com',14),(19,12,'4646897',15),(20,11,'Davi',15),(21,13,'davi@gmail.com',15),(22,12,'879456789',16),(23,11,'Diego',16),(24,13,'diego@gmail.com',16),(25,14,'vrnljkajklvnhreÃ§wjkvn egragwer g',16),(26,15,'hdryhdyrhdrhdry',17),(27,16,'123',17),(28,15,'Yrerege',18),(29,16,'654',18);
/*!40000 ALTER TABLE `valor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widget` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `objeto_id` bigint(20) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_widget_objeto_idx` (`objeto_id`),
  CONSTRAINT `fk_widget_objeto` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget`
--

LOCK TABLES `widget` WRITE;
/*!40000 ALTER TABLE `widget` DISABLE KEYS */;
INSERT INTO `widget` VALUES (1,'Lista de Clientes',1,1),(2,'Novo Cliente',1,2),(3,'Tarefas',4,1),(5,'Nova tarefa',4,2),(6,'Lista de Contatos',8,1),(7,'Novo Contato',8,2),(8,'Lista',10,1),(9,'Form',10,2);
/*!40000 ALTER TABLE `widget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-25 13:16:56
