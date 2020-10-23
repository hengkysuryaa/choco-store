-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: chocofactory
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `coklat`
--

DROP TABLE IF EXISTS `coklat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coklat` (
  `idcoklat` int NOT NULL AUTO_INCREMENT,
  `choco_name` varchar(50) NOT NULL,
  `price` int NOT NULL,
  `imgpath` varchar(200) NOT NULL,
  `amount` int NOT NULL,
  `amountsold` int NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`idcoklat`),
  UNIQUE KEY `idcoklat_UNIQUE` (`idcoklat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coklat`
--

LOCK TABLES `coklat` WRITE;
/*!40000 ALTER TABLE `coklat` DISABLE KEYS */;
INSERT INTO `coklat` VALUES (1,'Kitkat',5000,'assets/uploads/kitkat.jpg',90,10,'Sustainably sourced cocoa'),(2,'Milo Nougat',1000,'assets/uploads/milo.jpg',50,0,'Milo versi padat (nugget)'),(3,'Ferrero',50000,'assets/uploads/ferrero.jpg',6,8,'Coklat Mahal'),(4,'Rittersport',100000,'assets/uploads/rittersport.jpg',500,0,'Rasa coklat mahal'),(5,'Silverqueen',10000,'assets/uploads/silverqueen.jpg',20,0,'Coklat batang isi 10 kotak'),(6,'Cadbury',11530,'assets/uploads/cadbury.jpg',15,0,'Coklat warna biru bungkusnya'),(7,'Treasure',3000,'assets/uploads/treasure.jpg',1001,21,'Coklat murah tapi tidak murahan');
/*!40000 ALTER TABLE `coklat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cookies`
--

DROP TABLE IF EXISTS `cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cookies` (
  `cookie_auth` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`cookie_auth`),
  KEY `username` (`username`),
  CONSTRAINT `cookies_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookies`
--

LOCK TABLES `cookies` WRITE;
/*!40000 ALTER TABLE `cookies` DISABLE KEYS */;
INSERT INTO `cookies` VALUES ('9e9e2a576ec2458b9fc505321b182b61635789e1','pembeli_coklat');
/*!40000 ALTER TABLE `cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `idtransaksi` int NOT NULL AUTO_INCREMENT,
  `choco_name` varchar(45) NOT NULL,
  `amount` varchar(45) NOT NULL,
  `totalprice` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`idtransaksi`),
  UNIQUE KEY `idtransaksi_UNIQUE` (`idtransaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (1,'Kitkat','10',50000,'2020-10-23','23:51:12','jalan ganesha no. 10, labtek V, lantai 3.','pembeli_coklat'),(2,'Ferrero','5',250000,'2020-10-23','23:53:10','sabuga','pembeli_coklat'),(3,'Treasure','20',60000,'2020-10-23','23:53:55','cisitu','pembeli_coklat'),(4,'Ferrero','3',150000,'2020-10-23','23:57:28','jakarta','pencurry_coklat'),(5,'Treasure','1',3000,'2020-10-23','23:57:51','unpad','pencurry_coklat');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('pembeli_coklat','1@std.stei.itb.ac.id','$2y$10$Pn0/6Svvro9/Fdebi9JlsOT4rmRgXHsT23I75qbFQz2BsdIkz3/5W','user'),('pencurry_coklat','20@std.stei.itb.ac.id','$2y$10$j0taPZn2ll0/KbS6oSjTK.5QjLKvrBzNsMCHek28/NH07FUtRyJWq','user'),('sam','41@std.stei.itb.ac.id','$2y$10$Pn0/6Svvro9/Fdebi9JlsOT4rmRgXHsT23I75qbFQz2BsdIkz3/5W','superuser');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-24  0:18:20
