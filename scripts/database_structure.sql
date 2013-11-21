CREATE DATABASE  IF NOT EXISTS `feedfilms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `feedfilms`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: feedfilms
-- ------------------------------------------------------
-- Server version	5.5.23

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
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- -----------------------------------------------------
-- Table `feedfilms`.`user_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `feedfilms`.`user_types` (
  `idusertype` INT(11) NOT NULL AUTO_INCREMENT,
  `usertype` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idusertype`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `feedfilms`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `feedfilms`.`users` (
  `iduser` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(255) NOT NULL,
  `state` INT(11) NOT NULL DEFAULT '0',
  `token` VARCHAR(255) NULL DEFAULT NULL,
  `timeout` TIMESTAMP NULL DEFAULT NULL,
  `idusertype` INT(11) NOT NULL,
  PRIMARY KEY (`iduser`),
  INDEX `fk_users_user_types_idx` (`idusertype` ASC),
  CONSTRAINT `fk_users_user_types`
    FOREIGN KEY (`idusertype`)
    REFERENCES `feedfilms`.`user_types` (`idusertype`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feedfilms`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `feedfilms`.`comments` (
  `idcomment` INT(11) NOT NULL AUTO_INCREMENT,
  `iduser` INT(11) NOT NULL,
  `idparentcomment` INT(11) NOT NULL DEFAULT '0',
  `idfilm` INT(11) NOT NULL,
  `body` text NOT NULL,
  `rating` INT(11) DEFAULT NULL,
  `review` INT(11) DEFAULT NULL,
  `dateadd` datetime NOT NULL,
  PRIMARY KEY (`idcomment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-20 19:58:50

DROP TABLE IF EXISTS `festivals`;
CREATE TABLE `festivals` ( 
	`idfestival` int(11) NOT NULL AUTO_INCREMENT,
 	`name` text,
	 `description` text,
	`date` timestamp NULL DEFAULT NULL,
    `create` timestamp NULL DEFAULT NULL,
    `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`idfestival`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

