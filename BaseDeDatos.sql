-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


--Usuario de acceso: usuario@correo.com--
--Contraseña de acceso: Nueva.123--

-- Volcando estructura de base de datos para resultados-estudiante
CREATE DATABASE IF NOT EXISTS `resultados-estudiante` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `resultados-estudiante`;

-- Volcando estructura para tabla resultados-estudiante.docente
CREATE TABLE IF NOT EXISTS `docente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `FirstName` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `LastName` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `updationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla resultados-estudiante.docente: ~1 rows (aproximadamente)
INSERT INTO `docente` (`id`, `UserName`, `FirstName`, `LastName`, `Password`, `status`, `updationDate`) VALUES
	(1, 'usuario@correo.com', 'Usuario', 'Docente', '$2y$10$FTLhCTVa23nxV2y7g8gqC.j90pWrKfV4Fn6WC5eoWT2F5mExX4Km.', 1, NULL);

-- Volcando estructura para tabla resultados-estudiante.periodo_estudio
CREATE TABLE IF NOT EXISTS `periodo_estudio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int DEFAULT NULL,
  `Section` varchar(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla resultados-estudiante.periodo_estudio: ~0 rows (aproximadamente)

-- Volcando estructura para tabla resultados-estudiante.tblnotice
CREATE TABLE IF NOT EXISTS `tblnotice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noticeTitle` varchar(255) DEFAULT NULL,
  `noticeDetails` mediumtext,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla resultados-estudiante.tblnotice: ~0 rows (aproximadamente)

-- Volcando estructura para tabla resultados-estudiante.tblresult
CREATE TABLE IF NOT EXISTS `tblresult` (
  `id` int NOT NULL AUTO_INCREMENT,
  `StudentId` int DEFAULT NULL,
  `ClassId` int DEFAULT NULL,
  `SubjectId` int DEFAULT NULL,
  `marks` int DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla resultados-estudiante.tblresult: ~0 rows (aproximadamente)

-- Volcando estructura para tabla resultados-estudiante.tblstudents
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `StudentId` int NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla resultados-estudiante.tblstudents: ~0 rows (aproximadamente)

-- Volcando estructura para tabla resultados-estudiante.tblsubjectcombination
CREATE TABLE IF NOT EXISTS `tblsubjectcombination` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ClassId` int DEFAULT NULL,
  `SubjectId` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla resultados-estudiante.tblsubjectcombination: ~0 rows (aproximadamente)

-- Volcando estructura para tabla resultados-estudiante.tblsubjects
CREATE TABLE IF NOT EXISTS `tblsubjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla resultados-estudiante.tblsubjects: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
