-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: lfsmdon
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

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
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_the_code` int(11) NOT NULL,
  `act_code` int(11) NOT NULL,
  `act_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47CC8C92773509EB` (`act_the_code`),
  CONSTRAINT `FK_47CC8C92773509EB` FOREIGN KEY (`act_the_code`) REFERENCES `theme` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,1009,'Violence'),(2,2,1012,'NOEL'),(3,2,1212,'Général');
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `civilite`
--

DROP TABLE IF EXISTS `civilite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `civilite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civ_lib_court` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `civ_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `civilite`
--

LOCK TABLES `civilite` WRITE;
/*!40000 ALTER TABLE `civilite` DISABLE KEYS */;
INSERT INTO `civilite` VALUES (1,'M.','Monsieur'),(2,'MME','Madame'),(3,'MLE','Mademoiselle'),(4,'M. ET MME','Monsieur et Madame'),(5,'MISS','Miss'),(6,'LADY','Lady'),(7,'ABBE','Abbé'),(8,'DR','Docteur'),(9,'PR','Professeur'),(10,'SOEUR','Soeur'),(11,'MERE','Mère'),(12,'PERE','Père'),(13,'ME','Maître'),(14,'FRERE','Frère'),(15,'M. OU MME','Monsieur ou Madame'),(16,'DR','Docteur'),(17,'PR','Professeur'),(18,'ME','Maître'),(19,'MRS','Messieurs'),(20,'MMES','Mesdames'),(21,'MLES','Mesdemoiselles');
/*!40000 ALTER TABLE `civilite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_don_filter`
--

DROP TABLE IF EXISTS `contact_don_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_don_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL,
  `annee_debut` int(11) NOT NULL,
  `annee_fin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_don_filter`
--

LOCK TABLES `contact_don_filter` WRITE;
/*!40000 ALTER TABLE `contact_don_filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_don_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `date_montant_filter`
--

DROP TABLE IF EXISTS `date_montant_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `date_montant_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `montant_min` int(11) NOT NULL,
  `montant_max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_montant_filter`
--

LOCK TABLES `date_montant_filter` WRITE;
/*!40000 ALTER TABLE `date_montant_filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `date_montant_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `don`
--

DROP TABLE IF EXISTS `don`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `don` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdp_id` int(11) NOT NULL,
  `action_id` int(11) DEFAULT NULL,
  `donateur_id` int(11) NOT NULL,
  `montant` decimal(10,0) NOT NULL,
  `num_cheque` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banque` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_don` date NOT NULL,
  `date_remise_don` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C0BDC7399B25D014` (`mdp_id`),
  KEY `IDX_C0BDC7399D32F035` (`action_id`),
  KEY `IDX_C0BDC739A9C80E3` (`donateur_id`),
  CONSTRAINT `FK_C0BDC7399B25D014` FOREIGN KEY (`mdp_id`) REFERENCES `mdp` (`id`),
  CONSTRAINT `FK_C0BDC7399D32F035` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`),
  CONSTRAINT `FK_C0BDC739A9C80E3` FOREIGN KEY (`donateur_id`) REFERENCES `donateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `don`
--

LOCK TABLES `don` WRITE;
/*!40000 ALTER TABLE `don` DISABLE KEYS */;
INSERT INTO `don` VALUES (1,1,NULL,2,100,'1234567890','Banque 2','0000-00-00','0000-00-00'),(2,1,NULL,1,1000,'1234567890','Banque 1','0000-00-00','0000-00-00'),(3,1,NULL,2,400,'1234567890','Banque 2','0000-00-00','0000-00-00'),(4,1,NULL,2,1000,'1234567890','Banque 2','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `don` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donateur`
--

DROP TABLE IF EXISTS `donateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raison_sociale` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bp` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel_prm` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_sec` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_ptb` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `indice_t` tinyint(1) DEFAULT NULL,
  `promesse` tinyint(1) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `civilite_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `fonction_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  `dernier_don_id` int(11) DEFAULT NULL,
  `date_dernier_don` date DEFAULT NULL,
  `nombre_enfants` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut_social_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CD3DE5039194ABF` (`civilite_id`),
  KEY `IDX_9CD3DE50D5E86FF` (`etat_id`),
  KEY `IDX_9CD3DE5057889920` (`fonction_id`),
  KEY `IDX_9CD3DE50F6203804` (`statut_id`),
  KEY `IDX_9CD3DE5057D567CD` (`dernier_don_id`),
  KEY `donateur_idx` (`birthday`,`date_dernier_don`),
  KEY `IDX_9CD3DE505E45CEE5` (`statut_social_id`),
  CONSTRAINT `FK_9CD3DE5039194ABF` FOREIGN KEY (`civilite_id`) REFERENCES `civilite` (`id`),
  CONSTRAINT `FK_9CD3DE5057889920` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id`),
  CONSTRAINT `FK_9CD3DE5057D567CD` FOREIGN KEY (`dernier_don_id`) REFERENCES `don` (`id`),
  CONSTRAINT `FK_9CD3DE505E45CEE5` FOREIGN KEY (`statut_social_id`) REFERENCES `statut_social` (`id`),
  CONSTRAINT `FK_9CD3DE50D5E86FF` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`),
  CONSTRAINT `FK_9CD3DE50F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donateur`
--

LOCK TABLES `donateur` WRITE;
/*!40000 ALTER TABLE `donateur` DISABLE KEYS */;
INSERT INTO `donateur` VALUES (1,'raison sociale 2','nom 2','prénom 2','adresse 2',NULL,'99999','ville 2',NULL,NULL,NULL,NULL,'1985-12-01',1,1,NULL,4,5,2,2,2,'2013-01-01','4',1),(2,NULL,'nom 1','prénom 1','adresse 1',NULL,'99999','ville 1',NULL,NULL,NULL,NULL,'1985-12-01',0,0,NULL,1,1,1,1,4,'2010-01-01','3',2),(3,NULL,'Nom Donateur 0','Prénom Donateur 0','Adresse Donateur 0',NULL,'93300','Ville Donateur 0',NULL,NULL,NULL,NULL,'1985-12-01',NULL,0,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(4,NULL,'Nom Donateur 1','Prénom Donateur 1','Adresse Donateur 1',NULL,'93300','Ville Donateur 1',NULL,NULL,NULL,NULL,'1985-12-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(6,NULL,'Nom Donateur 3','Prénom Donateur 3','Adresse Donateur 3',NULL,'93300','Ville Donateur 3',NULL,NULL,NULL,NULL,'1985-12-01',0,0,NULL,1,2,2,3,NULL,NULL,NULL,NULL),(7,NULL,'Nom Donateur 4','Prénom Donateur 4','Adresse Donateur 4',NULL,'93300','Ville Donateur 4',NULL,NULL,NULL,NULL,'1985-12-01',NULL,NULL,NULL,1,3,2,3,NULL,NULL,NULL,NULL),(8,NULL,'Nom Donateur 5','Prénom Donateur 5','Adresse Donateur 5',NULL,'93300','Ville Donateur 5',NULL,NULL,NULL,NULL,'1985-12-01',NULL,NULL,NULL,1,4,2,3,NULL,NULL,NULL,NULL),(9,NULL,'Nom Donateur 6','Prénom Donateur 6','Adresse Donateur 6',NULL,'93300','Ville Donateur 6',NULL,NULL,NULL,NULL,'1985-12-01',NULL,NULL,NULL,1,7,2,3,NULL,NULL,NULL,NULL),(10,NULL,'Nom Donateur 7','Prénom Donateur 7','Adresse Donateur 7',NULL,'93300','Ville Donateur 7',NULL,NULL,NULL,NULL,'1985-12-01',NULL,NULL,NULL,1,10,2,3,NULL,NULL,NULL,NULL),(11,NULL,'Nom Donateur 8','Prénom Donateur 8','Adresse Donateur 8',NULL,'93300','Ville Donateur 8',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(12,NULL,'Nom Donateur 9','Prénom Donateur 9','Adresse Donateur 9',NULL,'93300','Ville Donateur 9',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(13,NULL,'Nom Donateur 10','Prénom Donateur 10','Adresse Donateur 10',NULL,'93300','Ville Donateur 10',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(14,NULL,'Nom Donateur 11','Prénom Donateur 11','Adresse Donateur 11',NULL,'93300','Ville Donateur 11',NULL,NULL,NULL,NULL,'1980-05-01',0,0,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(15,NULL,'Nom Donateur 12','Prénom Donateur 12','Adresse Donateur 12',NULL,'93300','Ville Donateur 12',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(16,NULL,'Nom Donateur 13','Prénom Donateur 13','Adresse Donateur 13',NULL,'93300','Ville Donateur 13',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(17,NULL,'Nom Donateur 14','Prénom Donateur 14','Adresse Donateur 14',NULL,'93300','Ville Donateur 14',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(18,NULL,'Nom Donateur 15','Prénom Donateur 15','Adresse Donateur 15',NULL,'93300','Ville Donateur 15',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(19,NULL,'Nom Donateur 16','Prénom Donateur 16','Adresse Donateur 16',NULL,'93300','Ville Donateur 16',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(20,NULL,'Nom Donateur 17','Prénom Donateur 17','Adresse Donateur 17',NULL,'93300','Ville Donateur 17',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(21,NULL,'Nom Donateur 18','Prénom Donateur 18','Adresse Donateur 18',NULL,'93300','Ville Donateur 18',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(22,NULL,'Nom Donateur 19','Prénom Donateur 19','Adresse Donateur 19',NULL,'93300','Ville Donateur 19',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(23,NULL,'Nom Donateur 20','Prénom Donateur 20','Adresse Donateur 20',NULL,'93300','Ville Donateur 20',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(24,NULL,'Nom Donateur 21','Prénom Donateur 21','Adresse Donateur 21',NULL,'93300','Ville Donateur 21',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(25,NULL,'Nom Donateur 22','Prénom Donateur 22','Adresse Donateur 22',NULL,'93300','Ville Donateur 22',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(26,NULL,'Nom Donateur 23','Prénom Donateur 23','Adresse Donateur 23',NULL,'93300','Ville Donateur 23',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(27,NULL,'Nom Donateur 24','Prénom Donateur 24','Adresse Donateur 24',NULL,'93300','Ville Donateur 24',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(28,NULL,'Nom Donateur 25','Prénom Donateur 25','Adresse Donateur 25',NULL,'93300','Ville Donateur 25',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(29,NULL,'Nom Donateur 26','Prénom Donateur 26','Adresse Donateur 26',NULL,'93300','Ville Donateur 26',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(30,NULL,'Nom Donateur 27','Prénom Donateur 27','Adresse Donateur 27',NULL,'93300','Ville Donateur 27',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(31,NULL,'Nom Donateur 28','Prénom Donateur 28','Adresse Donateur 28',NULL,'93300','Ville Donateur 28',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL),(32,NULL,'Nom Donateur 29','Prénom Donateur 29','Adresse Donateur 29',NULL,'93300','Ville Donateur 29',NULL,NULL,NULL,NULL,'1980-05-01',NULL,NULL,NULL,1,1,2,3,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `donateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donateur_filter`
--

DROP TABLE IF EXISTS `donateur_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donateur_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat_id` int(11) DEFAULT NULL,
  `statut_id` int(11) DEFAULT NULL,
  `raison_sociale` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `civilite_id` int(11) NOT NULL,
  `birthday` date DEFAULT NULL,
  `number_of_children` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut_social_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B4D577E3D5E86FF` (`etat_id`),
  KEY `IDX_B4D577E3F6203804` (`statut_id`),
  KEY `IDX_B4D577E339194ABF` (`civilite_id`),
  KEY `IDX_B4D577E35E45CEE5` (`statut_social_id`),
  CONSTRAINT `FK_B4D577E339194ABF` FOREIGN KEY (`civilite_id`) REFERENCES `civilite` (`id`),
  CONSTRAINT `FK_B4D577E35E45CEE5` FOREIGN KEY (`statut_social_id`) REFERENCES `statut_social` (`id`),
  CONSTRAINT `FK_B4D577E3D5E86FF` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`),
  CONSTRAINT `FK_B4D577E3F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donateur_filter`
--

LOCK TABLES `donateur_filter` WRITE;
/*!40000 ALTER TABLE `donateur_filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `donateur_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etat`
--

DROP TABLE IF EXISTS `etat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etat`
--

LOCK TABLES `etat` WRITE;
/*!40000 ALTER TABLE `etat` DISABLE KEYS */;
INSERT INTO `etat` VALUES (1,'DCD'),(2,'NPAI'),(3,'PA'),(4,'BLOQUE'),(5,'REFUS'),(7,'UFPA'),(10,'BNI / BI');
/*!40000 ALTER TABLE `etat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fct_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonction`
--

LOCK TABLES `fonction` WRITE;
/*!40000 ALTER TABLE `fonction` DISABLE KEYS */;
INSERT INTO `fonction` VALUES (1,'Président'),(2,'Directeur Général'),(3,'Directeur des ressources humaines');
/*!40000 ALTER TABLE `fonction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'mdib','mdib','dibmichel@gmail.com','dibmichel@gmail.com',1,'l9434sxl0f4kckgcokssks0k8ccwgww','B6XlP89k89dxcWt6kBU/wFZV5oYSeK3s+hgSw2cCzjmvG3TZz9OABCsc8/SdIMI4DXV9UiREp7GpLHRhomeBwQ==','2014-06-10 00:03:38',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liste`
--

DROP TABLE IF EXISTS `liste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `liste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liste`
--

LOCK TABLES `liste` WRITE;
/*!40000 ALTER TABLE `liste` DISABLE KEYS */;
INSERT INTO `liste` VALUES (1,'des exclus'),(2,'des actifs'),(3,'des décédés'),(4,'autres que décédés et refus');
/*!40000 ALTER TABLE `liste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liste_etat`
--

DROP TABLE IF EXISTS `liste_etat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `liste_etat` (
  `liste_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  PRIMARY KEY (`liste_id`,`etat_id`),
  KEY `IDX_749D37B1E85441D8` (`liste_id`),
  KEY `IDX_749D37B1D5E86FF` (`etat_id`),
  CONSTRAINT `FK_749D37B1D5E86FF` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_749D37B1E85441D8` FOREIGN KEY (`liste_id`) REFERENCES `liste` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liste_etat`
--

LOCK TABLES `liste_etat` WRITE;
/*!40000 ALTER TABLE `liste_etat` DISABLE KEYS */;
INSERT INTO `liste_etat` VALUES (1,5),(2,7),(2,10),(3,1),(4,2),(4,3),(4,4),(4,7),(4,10);
/*!40000 ALTER TABLE `liste_etat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mdp`
--

DROP TABLE IF EXISTS `mdp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdp_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mdp`
--

LOCK TABLES `mdp` WRITE;
/*!40000 ALTER TABLE `mdp` DISABLE KEYS */;
INSERT INTO `mdp` VALUES (1,'CHEQUE BANCAIRE'),(2,'CCP'),(3,'MANDAT LETTRE NE'),(4,'MANDAT CARTE NE'),(5,'PAIEMENT SUR JUSTIFICATIF'),(6,'ESPECES'),(7,'LETTRE DE CHANGE'),(8,'BILLET A ORDRE'),(9,'VIREMENT NE'),(10,'VIREMENT'),(11,'MANDAT LETTRE'),(12,'MANDAT CARTE'),(13,'ESPECES NE'),(14,'PAIEMENT EN NATURE'),(15,'CARTE DE CREDIT'),(16,'REGLEMENT DIFFERE'),(17,'PRELEVEMENT'),(18,'PRELEVEMENT NE'),(19,'AVOIR'),(20,'CCP NE'),(21,'CHEQUE NE');
/*!40000 ALTER TABLE `mdp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note_donateur`
--

DROP TABLE IF EXISTS `note_donateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note_donateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donateur_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `corps` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8C8802CEA9C80E3` (`donateur_id`),
  CONSTRAINT `FK_8C8802CEA9C80E3` FOREIGN KEY (`donateur_id`) REFERENCES `donateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note_donateur`
--

LOCK TABLES `note_donateur` WRITE;
/*!40000 ALTER TABLE `note_donateur` DISABLE KEYS */;
INSERT INTO `note_donateur` VALUES (2,1,'2014-05-24 19:23:30','aaaaaaaaa','ccccccccccccccc gfgggggggg\r\ngfdgdfshl goldfhgol holghdf \r\n\r\nturlututu chapeau pointu'),(3,1,'2014-05-24 22:37:42','ppppppp','hjjjjjjjjjjjjjj');
/*!40000 ALTER TABLE `note_donateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_provenance_fichier`
--

DROP TABLE IF EXISTS `ref_provenance_fichier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_provenance_fichier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_provenance_fichier`
--

LOCK TABLES `ref_provenance_fichier` WRITE;
/*!40000 ALTER TABLE `ref_provenance_fichier` DISABLE KEYS */;
INSERT INTO `ref_provenance_fichier` VALUES (1,'LFSM Origine'),(2,'ISF'),(3,'MDib');
/*!40000 ALTER TABLE `ref_provenance_fichier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statut`
--

DROP TABLE IF EXISTS `statut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statut`
--

LOCK TABLES `statut` WRITE;
/*!40000 ALTER TABLE `statut` DISABLE KEYS */;
INSERT INTO `statut` VALUES (1,'Société'),(2,'Particulier'),(3,'Fondation');
/*!40000 ALTER TABLE `statut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statut_social`
--

DROP TABLE IF EXISTS `statut_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statut_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_social_libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statut_social`
--

LOCK TABLES `statut_social` WRITE;
/*!40000 ALTER TABLE `statut_social` DISABLE KEYS */;
INSERT INTO `statut_social` VALUES (1,'Marié(e)'),(2,'Célibataire'),(3,'veuf(ve)'),(4,'Divorcé(e)');
/*!40000 ALTER TABLE `statut_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `the_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES (1,'VL','VIOLENCE'),(2,'NO','NOEL'),(3,'12','NO');
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-10 12:15:09
