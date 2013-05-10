DROP DATABASE IF EXISTS diapazen;

 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `diapazen` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `diapazen` ;

-- -----------------------------------------------------
-- Table `diapazen`.`dpz_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `diapazen`.`dpz_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `firstname` VARCHAR(45) NOT NULL ,
  `lastname` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(60) NOT NULL ,
  `registration_date` TIMESTAMP NOT NULL ,
  `last_login_date` TIMESTAMP NULL ,
  `last_login_ip` VARCHAR(30) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diapazen`.`dpz_polls`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `diapazen`.`dpz_polls` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL ,
  `url` VARCHAR(30) NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(400) NULL ,
  `expiration_date` TIMESTAMP NOT NULL ,
  `open` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_dp_polls_dp_users_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_dp_polls_dp_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `diapazen`.`dpz_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diapazen`.`dpz_choices`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `diapazen`.`dpz_choices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `poll_id` INT NOT NULL ,
  `choice` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_dp_choices_dp_polls1_idx` (`poll_id` ASC) ,
  CONSTRAINT `fk_dp_choices_dp_polls1`
    FOREIGN KEY (`poll_id` )
    REFERENCES `diapazen`.`dpz_polls` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diapazen`.`dpz_results`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `diapazen`.`dpz_results` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `choice_id` INT UNSIGNED NOT NULL ,
  `value` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dp_results_dp_choices1_idx` (`choice_id` ASC) ,
  CONSTRAINT `fk_dp_results_dp_choices1`
    FOREIGN KEY (`choice_id` )
    REFERENCES `diapazen`.`dpz_choices` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `diapazen` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
