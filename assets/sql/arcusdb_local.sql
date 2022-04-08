-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema arcusdb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `arcusdb` ;

-- -----------------------------------------------------
-- Schema arcusdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `arcusdb` DEFAULT CHARACTER SET utf8 ;
USE `arcusdb` ;

-- -----------------------------------------------------
-- Table `arcusdb`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`event` (
  `eventId` INT NOT NULL AUTO_INCREMENT,
  `countingMode` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`eventId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`user` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `nickName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `guest` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `nickName_UNIQUE` (`nickName` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`parcour`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`parcour` (
  `parcourId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `place` VARCHAR(45) NOT NULL,
  `animalCount` INT NOT NULL,
  PRIMARY KEY (`parcourId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`animal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`animal` (
  `animalId` INT NOT NULL AUTO_INCREMENT,
  `animalNumber` INT NOT NULL,
  `parcourId` INT NOT NULL,
  PRIMARY KEY (`animalId`),
  INDEX `fk_animal_parcour1_idx` (`parcourId` ASC),
  CONSTRAINT `fk_animal_parcour1`
    FOREIGN KEY (`parcourId`)
    REFERENCES `arcusdb`.`parcour` (`parcourId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`hitzone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`hitzone` (
  `hitzoneId` INT NOT NULL AUTO_INCREMENT,
  `hitzoneName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`hitzoneId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`arrow`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`arrow` (
  `arrowId` INT NOT NULL AUTO_INCREMENT,
  `arrowUsed` INT NULL,
  PRIMARY KEY (`arrowId`),
  UNIQUE INDEX `arrowUsed_UNIQUE` (`arrowUsed` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`points`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`points` (
  `pointsId` INT NOT NULL AUTO_INCREMENT,
  `counting` INT NULL,
  `hitzoneId` INT NOT NULL,
  `arrowId` INT NULL,
  PRIMARY KEY (`pointsId`),
  INDEX `fk_points_hitZone1_idx` (`hitzoneId` ASC),
  INDEX `fk_points_arrow1_idx` (`arrowId` ASC),
  CONSTRAINT `fk_points_hitZone1`
    FOREIGN KEY (`hitzoneId`)
    REFERENCES `arcusdb`.`hitzone` (`hitzoneId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_points_arrow1`
    FOREIGN KEY (`arrowId`)
    REFERENCES `arcusdb`.`arrow` (`arrowId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`score`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`score` (
  `scoreId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `animalId` INT NOT NULL,
  `pointsId` INT NOT NULL,
  `created` DATETIME NULL DEFAULT current_timestamp,
  PRIMARY KEY (`scoreId`),
  INDEX `fk_score_user_idx` (`userId` ASC),
  INDEX `fk_score_animal1_idx` (`animalId` ASC),
  INDEX `fk_score_points1_idx` (`pointsId` ASC),
  CONSTRAINT `fk_score_user`
    FOREIGN KEY (`userId`)
    REFERENCES `arcusdb`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_animal1`
    FOREIGN KEY (`animalId`)
    REFERENCES `arcusdb`.`animal` (`animalId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_points1`
    FOREIGN KEY (`pointsId`)
    REFERENCES `arcusdb`.`points` (`pointsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`event_has_parcour`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`event_has_parcour` (
  `eventId` INT NOT NULL,
  `parcourId` INT NOT NULL,
  INDEX `fk_event_has_parcour_parcour1_idx` (`parcourId` ASC),
  INDEX `fk_event_has_parcour_event1_idx` (`eventId` ASC),
  CONSTRAINT `fk_event_has_parcour_event1`
    FOREIGN KEY (`eventId`)
    REFERENCES `arcusdb`.`event` (`eventId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_has_parcour_parcour1`
    FOREIGN KEY (`parcourId`)
    REFERENCES `arcusdb`.`parcour` (`parcourId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arcusdb`.`event_has_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arcusdb`.`event_has_user` (
  `eventId` INT NOT NULL,
  `userId` INT NOT NULL,
  INDEX `fk_event_has_user_user1_idx` (`userId` ASC),
  INDEX `fk_event_has_user_event1_idx` (`eventId` ASC),
  CONSTRAINT `fk_event_has_user_event1`
    FOREIGN KEY (`eventId`)
    REFERENCES `arcusdb`.`event` (`eventId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_has_user_user1`
    FOREIGN KEY (`userId`)
    REFERENCES `arcusdb`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `arcusdb`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`user` (`userId`, `firstName`, `lastName`, `nickName`, `password`, `guest`) VALUES (DEFAULT, 'David', 'Kaiser', 'Kr4mpuz', '12345', 0);
INSERT INTO `arcusdb`.`user` (`userId`, `firstName`, `lastName`, `nickName`, `password`, `guest`) VALUES (DEFAULT, 'Tim', 'Hofmann', 'ThisTim', '12345', 0);
INSERT INTO `arcusdb`.`user` (`userId`, `firstName`, `lastName`, `nickName`, `password`, `guest`) VALUES (DEFAULT, 'Leander', 'Kieweg', 'stiangglanda', '12345', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `arcusdb`.`parcour`
-- -----------------------------------------------------
START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`parcour` (`parcourId`, `name`, `place`, `animalCount`) VALUES (DEFAULT, 'Wurbauerkogel', 'Windischgarsten', 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `arcusdb`.`animal`
-- -----------------------------------------------------
START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 1, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 2, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 3, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 4, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 5, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `arcusdb`.`hitzone`
-- -----------------------------------------------------
START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`hitzone` (`hitzoneId`, `hitzoneName`) VALUES (DEFAULT, 'Center Kill');
INSERT INTO `arcusdb`.`hitzone` (`hitzoneId`, `hitzoneName`) VALUES (DEFAULT, 'Kill');
INSERT INTO `arcusdb`.`hitzone` (`hitzoneId`, `hitzoneName`) VALUES (DEFAULT, 'Body');
INSERT INTO `arcusdb`.`hitzone` (`hitzoneId`, `hitzoneName`) VALUES (DEFAULT, 'Miss');

COMMIT;


-- -----------------------------------------------------
-- Data for table `arcusdb`.`arrow`
-- -----------------------------------------------------
START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`arrow` (`arrowId`, `arrowUsed`) VALUES (DEFAULT, 1);
INSERT INTO `arcusdb`.`arrow` (`arrowId`, `arrowUsed`) VALUES (DEFAULT, 2);
INSERT INTO `arcusdb`.`arrow` (`arrowId`, `arrowUsed`) VALUES (DEFAULT, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `arcusdb`.`points`
-- -----------------------------------------------------
START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 20, 1, 1);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 18, 2, 1);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 16, 3, 1);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 14, 1, 2);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 12, 2, 2);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 10, 3, 2);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 8, 1, 3);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 6, 2, 3);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 4, 3, 3);
INSERT INTO `arcusdb`.`points` (`pointsId`, `counting`, `hitzoneId`, `arrowId`) VALUES (DEFAULT, 0, 4, NULL);

COMMIT;

