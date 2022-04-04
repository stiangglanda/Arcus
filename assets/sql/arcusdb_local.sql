SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


DROP SCHEMA IF EXISTS `arcusdb`;

CREATE SCHEMA IF NOT EXISTS `arcusdb` DEFAULT CHARACTER SET utf8 ;
USE `arcusdb` ;


DROP TABLE IF EXISTS `arcusdb`.`event` ;

CREATE TABLE IF NOT EXISTS `arcusdb`.`event` (
  `eventId` INT NOT NULL AUTO_INCREMENT,
  `countingMode` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`eventId`))
ENGINE = InnoDB;


DROP TABLE IF EXISTS `arcusdb`.`user` ;

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


DROP TABLE IF EXISTS `arcusdb`.`parcour` ;

CREATE TABLE IF NOT EXISTS `arcusdb`.`parcour` (
  `parcourId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `place` VARCHAR(45) NOT NULL,
  `animalCount` INT NOT NULL,
  PRIMARY KEY (`parcourId`))
ENGINE = InnoDB;



DROP TABLE IF EXISTS `arcusdb`.`animal` ;

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


DROP TABLE IF EXISTS `arcusdb`.`score` ;

CREATE TABLE IF NOT EXISTS `arcusdb`.`score` (
  `scoreId` INT NOT NULL AUTO_INCREMENT,
  `points` INT NOT NULL,
  `userId` INT NOT NULL,
  `animalId` INT NOT NULL,
  `created` DATETIME NULL DEFAULT current_timestamp,
  PRIMARY KEY (`scoreId`),
  INDEX `fk_score_user_idx` (`userId` ASC),
  INDEX `fk_score_animal1_idx` (`animalId` ASC),
  CONSTRAINT `fk_score_user`
    FOREIGN KEY (`userId`)
    REFERENCES `arcusdb`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_animal1`
    FOREIGN KEY (`animalId`)
    REFERENCES `arcusdb`.`animal` (`animalId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


DROP TABLE IF EXISTS `arcusdb`.`event_has_parcour` ;

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


DROP TABLE IF EXISTS `arcusdb`.`event_has_user` ;

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


START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`user` (`userId`, `firstName`, `lastName`, `nickName`, `password`, `guest`) VALUES (DEFAULT, 'David', 'Kaiser', 'Kr4mpuz', '12345', 0);
INSERT INTO `arcusdb`.`user` (`userId`, `firstName`, `lastName`, `nickName`, `password`, `guest`) VALUES (DEFAULT, 'Tim', 'Hofmann', 'ThisTim', '12345', 0);
INSERT INTO `arcusdb`.`user` (`userId`, `firstName`, `lastName`, `nickName`, `password`, `guest`) VALUES (DEFAULT, 'Leander', 'Kieweg', 'stiangglanda', '12345', 0);

COMMIT;


START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`parcour` (`parcourId`, `name`, `place`, `animalCount`) VALUES (DEFAULT, 'Wurbauerkogel', 'Windischgarsten', 5);

COMMIT;


START TRANSACTION;
USE `arcusdb`;
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 1, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 2, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 3, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 4, 1);
INSERT INTO `arcusdb`.`animal` (`animalId`, `animalNumber`, `parcourId`) VALUES (DEFAULT, 5, 1);

COMMIT;