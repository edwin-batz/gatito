CREATE DATABASE  IF NOT EXISTS `gatito` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gatito`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: gatito
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.14-MariaDB

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
-- Table structure for table `carta`
--

DROP TABLE IF EXISTS `carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `carta_tipo_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `uso_inmediato` tinyint(1) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `turno` int(11) NOT NULL DEFAULT 1,
  `tomar` int(11) NOT NULL DEFAULT 1,
  `robar` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_carta1_idx` (`carta_tipo_id`),
  KEY `idx_carta_1` (`activo`),
  KEY `idx_carta_2` (`turno`),
  KEY `idx_carta_3` (`tomar`),
  KEY `idx_carta_4` (`robar`),
  CONSTRAINT `fk_carta1` FOREIGN KEY (`carta_tipo_id`) REFERENCES `carta_tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carta`
--

LOCK TABLES `carta` WRITE;
/*!40000 ALTER TABLE `carta` DISABLE KEYS */;
INSERT INTO `carta` VALUES (1,'Bomba','Usa esta carta de inmediato',1,1,NULL,1,1,1,1,0),(2,'Desactivar','Devuelve a la baraja la carta que has tomado',1,2,NULL,0,1,1,1,0),(3,'Ataque','Termina tu turno sin robar y el contrincante tiene dos turnos',1,NULL,NULL,0,1,2,0,0),(4,'Robo','Elige una carta del contrincante',1,NULL,NULL,0,1,1,1,1),(5,'Paso','Termina tu turno sin robar',1,NULL,NULL,0,1,1,0,0),(6,'Visionario','Puedes ver las tres primeras cartas de la baraja',1,2,NULL,0,1,1,1,0),(7,'Barajar','Reordena las cartas de la baraja',1,NULL,NULL,0,1,1,1,0),(8,'Bloqueo','Cancela la acción del contrincante',1,NULL,NULL,0,1,0,1,0),(9,'UNO','No sirve de nada, juega dos cartas para robar una carta al contrincante',2,NULL,NULL,0,1,1,1,0),(10,'DOS','No sirve de nada, juega dos cartas para robar una carta al contrincante',2,NULL,NULL,0,1,1,1,0),(11,'TRES','No sirve de nada, juega dos cartas para robar una carta al contrincante',2,NULL,NULL,0,1,1,1,0),(12,'CUATRO','No sirve de nada, juega dos cartas para robar una carta al contrincante',2,NULL,NULL,0,1,1,1,0),(13,'CINCO','No sirve de nada, juega dos cartas para robar una carta al contrincante',2,NULL,NULL,0,1,1,1,0);
/*!40000 ALTER TABLE `carta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carta_tipo`
--

DROP TABLE IF EXISTS `carta_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carta_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carta_tipo`
--

LOCK TABLES `carta_tipo` WRITE;
/*!40000 ALTER TABLE `carta_tipo` DISABLE KEYS */;
INSERT INTO `carta_tipo` VALUES (1,'Común',1),(2,'Especial',2);
/*!40000 ALTER TABLE `carta_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida`
--

DROP TABLE IF EXISTS `partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_sys` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo` varchar(8) NOT NULL,
  `privada` tinyint(1) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `turno` int(11) DEFAULT NULL,
  `doble_turno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_partida_1` (`codigo`),
  KEY `idx_partida_2` (`privada`),
  KEY `idx_partida_3` (`activo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
INSERT INTO `partida` VALUES (1,'2024-10-23 05:48:35','mg7w#4DP',1,0,NULL,NULL),(2,'2024-10-24 03:42:26','mRZ#JWkI',0,0,NULL,NULL),(3,'2024-10-24 06:38:09','vJWkGf6q',0,0,NULL,NULL),(4,'2024-10-24 06:41:06','sDzM0sam',0,0,NULL,NULL),(5,'2024-10-24 06:48:17','I6771zFs',0,0,NULL,NULL),(6,'2024-10-24 06:50:14','qOzdhBXL',0,1,2,NULL);
/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `gatito`.`partida_BEFORE_INSERT` BEFORE INSERT ON `partida` FOR EACH ROW
BEGIN
	SET NEW.codigo = codigo_partida();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `partida_carta`
--

DROP TABLE IF EXISTS `partida_carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida_carta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida_id` int(11) NOT NULL,
  `carta_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `jugado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_partida_carta1_idx` (`partida_id`),
  KEY `fk_partida_carta2_idx` (`carta_id`),
  KEY `idx_partida_carta3` (`orden`),
  CONSTRAINT `fk_partida_carta1` FOREIGN KEY (`partida_id`) REFERENCES `partida` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_carta2` FOREIGN KEY (`carta_id`) REFERENCES `carta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida_carta`
--

LOCK TABLES `partida_carta` WRITE;
/*!40000 ALTER TABLE `partida_carta` DISABLE KEYS */;
INSERT INTO `partida_carta` VALUES (1,1,1,19,NULL,0),(2,1,2,36,NULL,0),(3,1,2,10,2,0),(4,1,3,15,NULL,0),(5,1,3,1,1,0),(6,1,3,7,2,0),(7,1,4,35,NULL,0),(8,1,4,33,NULL,0),(9,1,4,21,NULL,0),(10,1,5,17,NULL,0),(11,1,5,16,NULL,0),(12,1,5,32,NULL,0),(13,1,6,39,NULL,0),(14,1,6,9,2,0),(15,1,7,11,NULL,0),(16,1,7,23,NULL,0),(17,1,7,20,NULL,0),(18,1,8,27,NULL,0),(19,1,8,3,1,0),(20,1,8,12,NULL,0),(21,1,9,4,1,0),(22,1,9,30,NULL,0),(23,1,9,26,NULL,0),(24,1,9,6,2,0),(25,1,10,24,NULL,0),(26,1,10,34,NULL,0),(27,1,10,14,NULL,0),(28,1,10,37,NULL,0),(29,1,11,28,NULL,0),(30,1,11,8,2,0),(31,1,11,25,NULL,0),(32,1,11,31,NULL,0),(33,1,12,2,1,0),(34,1,12,29,NULL,0),(35,1,12,38,NULL,0),(36,1,12,13,NULL,0),(37,1,13,22,NULL,0),(38,1,13,5,1,0),(39,1,13,40,NULL,0),(40,1,13,18,NULL,0),(41,6,1,48,NULL,0),(42,6,2,46,NULL,0),(43,6,2,11,NULL,0),(44,6,3,73,NULL,0),(45,6,3,17,NULL,0),(46,6,3,34,NULL,0),(47,6,4,28,NULL,0),(48,6,4,45,NULL,0),(49,6,4,68,NULL,0),(50,6,5,26,NULL,0),(51,6,5,22,NULL,0),(52,6,5,35,NULL,0),(53,6,6,20,NULL,0),(54,6,6,2,1,0),(55,6,7,23,NULL,0),(56,6,7,39,NULL,0),(57,6,7,37,NULL,0),(58,6,8,66,NULL,0),(59,6,8,51,NULL,0),(60,6,8,64,NULL,0),(61,6,9,79,NULL,0),(62,6,9,43,NULL,0),(63,6,9,70,NULL,0),(64,6,9,47,NULL,0),(65,6,10,36,NULL,0),(66,6,10,29,NULL,0),(67,6,10,44,NULL,0),(68,6,10,58,NULL,0),(69,6,11,69,NULL,0),(70,6,11,9,2,0),(71,6,11,1,1,0),(72,6,11,61,NULL,0),(73,6,12,50,NULL,0),(74,6,12,72,NULL,0),(75,6,12,60,NULL,0),(76,6,12,71,NULL,0),(77,6,13,8,2,0),(78,6,13,76,NULL,0),(79,6,13,31,NULL,0),(80,6,13,16,NULL,0),(81,6,1,77,NULL,0),(82,6,2,4,1,0),(83,6,2,30,NULL,0),(84,6,3,63,NULL,0),(85,6,3,57,NULL,0),(86,6,3,14,NULL,0),(87,6,4,65,NULL,0),(88,6,4,32,NULL,0),(89,6,4,59,NULL,0),(90,6,5,24,NULL,0),(91,6,5,33,NULL,0),(92,6,5,13,NULL,0),(93,6,6,41,NULL,0),(94,6,6,15,NULL,0),(95,6,7,25,NULL,0),(96,6,7,12,NULL,0),(97,6,7,56,NULL,0),(98,6,8,3,1,0),(99,6,8,10,2,0),(100,6,8,40,NULL,0),(101,6,9,18,NULL,0),(102,6,9,54,NULL,0),(103,6,9,49,NULL,0),(104,6,9,6,2,0),(105,6,10,42,NULL,0),(106,6,10,38,NULL,0),(107,6,10,55,NULL,0),(108,6,10,5,1,0),(109,6,11,19,NULL,0),(110,6,11,7,2,0),(111,6,11,52,NULL,0),(112,6,11,78,NULL,0),(113,6,12,74,NULL,0),(114,6,12,62,NULL,0),(115,6,12,80,NULL,0),(116,6,12,53,NULL,0),(117,6,13,27,NULL,0),(118,6,13,67,NULL,0),(119,6,13,75,NULL,0),(120,6,13,21,NULL,0);
/*!40000 ALTER TABLE `partida_carta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida_usuario`
--

DROP TABLE IF EXISTS `partida_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida_id` int(11) NOT NULL,
  `anfitrion` int(11) NOT NULL,
  `contrincante` int(11) DEFAULT NULL,
  `ganador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_partida_usuario_idx` (`partida_id`),
  KEY `fk_partida_usuario2_idx` (`anfitrion`),
  CONSTRAINT `fk_partida_usuario1` FOREIGN KEY (`partida_id`) REFERENCES `partida` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_usuario2` FOREIGN KEY (`anfitrion`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida_usuario`
--

LOCK TABLES `partida_usuario` WRITE;
/*!40000 ALTER TABLE `partida_usuario` DISABLE KEYS */;
INSERT INTO `partida_usuario` VALUES (1,1,2,NULL,NULL),(2,2,2,NULL,NULL),(3,3,2,NULL,NULL),(4,4,2,NULL,NULL),(5,5,2,NULL,NULL),(6,6,1,2,NULL);
/*!40000 ALTER TABLE `partida_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasenia` varchar(150) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin@correo.com','25d55ad283aa400af464c76d713c07ad',1),(2,'admin2','admin2@correo.com','25d55ad283aa400af464c76d713c07ad',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'gatito'
--

--
-- Dumping routines for database 'gatito'
--
/*!50003 DROP FUNCTION IF EXISTS `codigo_partida` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `codigo_partida`() RETURNS char(8) CHARSET latin1
BEGIN
	DECLARE base CHAR(64) DEFAULT 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.#';
    DECLARE codigo CHAR(8) DEFAULT '';
    DECLARE i INT DEFAULT 0;
    
    WHILE i < 8 DO
		SET codigo = CONCAT(codigo, SUBSTRING(base, FLOOR(1 + RAND() * 64), 1));
        SET i = i + 1;
	END WHILE;
    
    return codigo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generar_mazo_partida` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generar_mazo_partida`(IN partida INT, IN usuario1 INT, IN usuario2 INT)
BEGIN  

	DECLARE continuar INT DEFAULT FALSE;
	DECLARE id_carta INT;
	DECLARE carta_tipo INT;
	DECLARE cantidad_insertar INT;     

	DECLARE carta_cursor CURSOR FOR    
	SELECT
		id,
		carta_tipo_id,
		COALESCE(cantidad, CASE WHEN carta_tipo_id = 1 THEN 3 ELSE 4 END) AS cantidad
	FROM carta
	WHERE carta_tipo_id IN (1, 2);
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET continuar = TRUE;
	
    OPEN carta_cursor;      
		read_loop: LOOP
			FETCH carta_cursor INTO id_carta, carta_tipo, cantidad_insertar;
				IF continuar THEN
					LEAVE read_loop;
				END IF;          
				
				WHILE cantidad_insertar > 0 DO
					INSERT INTO partida_carta (partida_id, carta_id)
					VALUES (partida, id_carta);

					SET cantidad_insertar = cantidad_insertar - 1;
				END WHILE;
		END LOOP;
	CLOSE carta_cursor;
			
	UPDATE partida_carta SET orden = NULL WHERE partida_id = partida;
		
	SET @orden := 0;
    
    UPDATE partida_carta SET orden = (@orden:=@orden + 1) WHERE partida_id = partida ORDER BY RAND();

	IF EXISTS (SELECT * FROM partida_carta WHERE partida_id = partida AND carta_id = 1 AND orden <= 11) THEN
		UPDATE partida_carta
			SET orden = (SELECT MAX(orden) + 1 FROM carta_asignada)
		WHERE partida_id = partida
        AND carta_id = 1;
	END IF;
	
    UPDATE partida_carta SET usuario_id = usuario1 WHERE partida_id = partida AND orden BETWEEN 1 AND 5;
    
    UPDATE partida_carta SET usuario_id = usuario2 WHERE partida_id = partida AND orden BETWEEN 6 AND 10;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-31 20:59:46
