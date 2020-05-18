-- MySQL Script generated by MySQL Workbench
-- Mon May 18 11:50:49 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema NaikieDasVacatures
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema NaikieDasVacatures
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `NaikieDasVacatures` DEFAULT CHARACTER SET utf8 ;
USE `NaikieDasVacatures` ;

-- -----------------------------------------------------
-- Table `NaikieDasVacatures`.`jobbranch`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NaikieDasVacatures`.`jobbranch` ;

CREATE TABLE IF NOT EXISTS `NaikieDasVacatures`.`jobbranch` (
  `jobBranchID` INT(11) NOT NULL AUTO_INCREMENT,
  `branchName` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`jobBranchID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NaikieDasVacatures`.`jobFunction`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NaikieDasVacatures`.`jobFunction` ;

CREATE TABLE IF NOT EXISTS `NaikieDasVacatures`.`jobFunction` (
  `jobfunctionID` INT(11) NOT NULL AUTO_INCREMENT,
  `functionName` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`jobfunctionID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NaikieDasVacatures`.`joboffer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NaikieDasVacatures`.`joboffer` ;

CREATE TABLE IF NOT EXISTS `NaikieDasVacatures`.`joboffer` (
  `jobofferID` INT(11) NOT NULL AUTO_INCREMENT,
  `idJobbranch` INT(11) NOT NULL,
  `idJobfunction` INT(11) NOT NULL,
  `status` TINYINT(4) NOT NULL,
  `name` VARCHAR(254) NOT NULL,
  `description` LONGTEXT NOT NULL,
  PRIMARY KEY (`jobofferID`),
  CONSTRAINT `jobbranchID`
    FOREIGN KEY (`idJobbranch`)
    REFERENCES `NaikieDasVacatures`.`jobbranch` (`jobBranchID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `jobfunctionID`
    FOREIGN KEY (`idJobfunction`)
    REFERENCES `NaikieDasVacatures`.`jobFunction` (`jobfunctionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NaikieDasVacatures`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NaikieDasVacatures`.`Users` ;

CREATE TABLE IF NOT EXISTS `NaikieDasVacatures`.`Users` (
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`userID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NaikieDasVacatures`.`offerreaction`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NaikieDasVacatures`.`offerreaction` ;

CREATE TABLE IF NOT EXISTS `NaikieDasVacatures`.`offerreaction` (
  `offerReactionID` INT(11) NOT NULL AUTO_INCREMENT,
  `idUser` INT(11) NOT NULL,
  `idJoboffer` INT(11) NOT NULL,
  `motivation` LONGTEXT NOT NULL,
  `cv` LONGTEXT NOT NULL,
  PRIMARY KEY (`offerReactionID`),
  CONSTRAINT `jobofferID`
    FOREIGN KEY (`idJoboffer`)
    REFERENCES `NaikieDasVacatures`.`joboffer` (`jobofferID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userID`
    FOREIGN KEY (`idUser`)
    REFERENCES `NaikieDasVacatures`.`Users` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NaikieDasVacatures`.`manager`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NaikieDasVacatures`.`manager` ;

CREATE TABLE IF NOT EXISTS `NaikieDasVacatures`.`manager` (
  `managerID` INT(11) NOT NULL AUTO_INCREMENT,
  `manEmail` VARCHAR(45) NOT NULL,
  `manPassword` VARCHAR(254) NOT NULL,
  `isManager` TINYINT(4) NOT NULL,
  PRIMARY KEY (`managerID`))
ENGINE = InnoDB;

INSERT INTO manager (manEmail, manPassword, isManager)
VALUES ('admin@admin', '$2y$10$LgF4LrYl2tKlewjha1LaSuo0YDpJYlauiHqYhYj.zfsP76q6EuzTC', 1);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
