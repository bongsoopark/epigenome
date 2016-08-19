-- MySQL dump 10.13  Distrib 5.5.50, for Linux (x86_64)
--
-- Host: localhost    Database: genome
-- ------------------------------------------------------
-- Server version	5.5.50

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
-- Table structure for table `chromosome`
--

DROP TABLE IF EXISTS `chromosome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chromosome` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `genome_id` int(11) unsigned NOT NULL DEFAULT '0',
  `loc` varchar(40) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `ncbi_accession` varchar(40) DEFAULT NULL,
  `genome_size` varchar(40) DEFAULT NULL,
  `gc_content` varchar(40) DEFAULT NULL,
  `protein` int(11) unsigned NOT NULL DEFAULT '0',
  `rRNA` int(11) unsigned NOT NULL DEFAULT '0',
  `tRNA` int(11) unsigned NOT NULL DEFAULT '0',
  `otherRNA` int(11) unsigned NOT NULL DEFAULT '0',
  `gene` int(11) unsigned NOT NULL DEFAULT '0',
  `pseudogene` int(11) unsigned NOT NULL DEFAULT '0',
  `file_path` varchar(255) DEFAULT NULL,
  `seq` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `genome`
--

DROP TABLE IF EXISTS `genome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genome` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `species_id` int(11) unsigned NOT NULL DEFAULT '0',
  `assembly_id` varchar(40) DEFAULT NULL,
  `db_key` varchar(40) DEFAULT NULL,
  `epigenomedb` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `genome_features`
--

DROP TABLE IF EXISTS `genome_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genome_features` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `genome_id` int(11) unsigned NOT NULL DEFAULT '0',
  `chromosome` varchar(40) DEFAULT NULL,
  `accession` varchar(40) DEFAULT NULL,
  `source` varchar(40) DEFAULT NULL,
  `feature` varchar(40) DEFAULT NULL,
  `start` int(11) unsigned NOT NULL DEFAULT '0',
  `end` int(11) unsigned NOT NULL DEFAULT '0',
  `score` int(11) unsigned NOT NULL DEFAULT '0',
  `strand` varchar(5) DEFAULT NULL,
  `frame` varchar(10) DEFAULT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `genome_id` (`genome_id`),
  KEY `feature` (`feature`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proteome`
--

DROP TABLE IF EXISTS `proteome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proteome` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `locus_name` varchar(40) DEFAULT NULL,
  `gene_name` varchar(40) DEFAULT NULL,
  `genome_id` int(11) unsigned NOT NULL DEFAULT '0',
  `sequence_id` int(11) unsigned NOT NULL DEFAULT '0',
  `species_complex` varchar(255) DEFAULT NULL,
  `interpro_term` varchar(255) DEFAULT NULL,
  `go_term` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sequence`
--

DROP TABLE IF EXISTS `sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sequence` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `genome_id` int(11) unsigned NOT NULL DEFAULT '0',
  `seq_type` varchar(40) DEFAULT NULL,
  `ncbi_accession` varchar(40) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `seq` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=256963 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `species`
--

DROP TABLE IF EXISTS `species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `species` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `genus_name` varchar(40) DEFAULT NULL,
  `species_name` varchar(40) DEFAULT NULL,
  `strain_name` varchar(40) DEFAULT NULL,
  `ncbi_txid` varchar(40) DEFAULT NULL,
  `lineage` varchar(255) DEFAULT NULL,
  `frequency` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-19 10:11:26
