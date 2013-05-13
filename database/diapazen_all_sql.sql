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
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `expiration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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











/*-----------------------------------------------------------------------------*/
/*----------------------------------Diapazen-----------------------------------*/
/*-----------------------------------Views-------------------------------------*/
/*-----------------------------------------------------------------------------*/

CREATE OR REPLACE VIEW diapazen.dpz_view_connexion AS
SELECT 
  dpz_users.id,
  dpz_users.firstname,
  dpz_users.lastname,
  dpz_users.email,
  dpz_users.password     
FROM diapazen.dpz_users;

CREATE OR REPLACE VIEW diapazen.dpz_view_users AS
SELECT 
  dpz_users.id,
  dpz_users.firstname,
  dpz_users.lastname,
  dpz_users.email,
  dpz_users.registration_date,
  dpz_users.last_login_date,
  dpz_users.last_login_ip 
FROM diapazen.dpz_users;

CREATE OR REPLACE VIEW diapazen.dpz_view_users_join_polls AS
SELECT 
  dpz_users.id AS USER_ID,
  dpz_users.firstname,
  dpz_users.lastname,
  dpz_users.email,
  dpz_users.registration_date,
  dpz_users.last_login_date,
  dpz_users.last_login_ip,

  dpz_polls.id AS POLL_ID,
  dpz_polls.url,
  dpz_polls.title,
  dpz_polls.description,
  dpz_polls.expiration_date,
  dpz_polls.open
FROM diapazen.dpz_users 
INNER JOIN diapazen.dpz_polls
ON dpz_users.id=dpz_polls.user_id
ORDER BY USER_ID ASC;









/*-----------------------------------------------------------------------------*/
/*----------------------------------Diapazen-----------------------------------*/
/*----------------------------------ViewsPoll----------------------------------*/
/*-----------------------------------------------------------------------------*/

CREATE OR REPLACE VIEW diapazen.dpz_view_poll AS
SELECT 
        dpz_polls.id AS POLL_ID,
        dpz_polls.url,
        dpz_polls.title,
        dpz_polls.description,
        dpz_polls.expiration_date,
        
        dpz_choices.id AS CHOICE_ID,
        dpz_choices.choice
        
FROM diapazen.dpz_polls
INNER JOIN diapazen.dpz_choices
ON dpz_polls.id=dpz_choices.poll_id
ORDER BY POLL_ID ASC;

CREATE OR REPLACE VIEW diapazen.dpz_view_choice AS
SELECT 
        dpz_choices.id AS CHOICE_ID,
        dpz_choices.poll_id AS POLL_ID,
        dpz_choices.choice,
        
        dpz_results.value
FROM diapazen.dpz_choices
INNER JOIN diapazen.dpz_results
ON dpz_choices.id=dpz_results.choice_id
ORDER BY CHOICE_ID ASC;










/*-----------------------------------------------------------------------------*/
/*----------------------insert these data in you database----------------------*/
/*----------------------------------it's a start-------------------------------*/
/*------------------------------------USERS------------------------------------*/
/*-----------------------------------------------------------------------------*/

INSERT INTO `diapazen`.`dpz_users` (`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
VALUES (NULL, 'Adrien', 'Fourel', 'adrien.fourel@isen.fr', '$2a$07$WgHXUqdYPR8A7csxSnhL$.M95uNRXBiMUa3H5YOFBlswm.HFYzaSO', CURRENT_TIMESTAMP, '', NULL);

INSERT INTO `diapazen`.`dpz_users` (`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
VALUES (NULL, 'Nicolas', 'Silvain', 'nicolas.silvain@isen.fr', '$2a$07$SvItH38xYibO6E2eQop/$.tdCCJtGmXxzrJMr5wMbkyVTvR6lUBse', CURRENT_TIMESTAMP, '', NULL);

INSERT INTO `diapazen`.`dpz_users` (`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
VALUES (NULL, 'Guillaume', 'Bauduin', 'guillaume.bauduin@isen.fr', '$2a$07$rAwN3gqQVFxEvo.8tXMu$.tM0m0MCKxlElNZ09RyrU/2DF2.P3glG', CURRENT_TIMESTAMP, '', NULL);


/*-----------------------------------------------------------------------------*/
/*-----------------------------------POLLS-------------------------------------*/
/*-----------------------------------------------------------------------------*/

INSERT INTO `diapazen`.`dpz_polls` (`id`, `user_id`, `url`, `title`, `description`, `expiration_date`, `open`) 
VALUES (NULL, '2', 'E7DF4FED2ZD', 'Soirée chez moi !', 'bon voila, j''organise une soirée ce samedi, qui voudrai quoi à manger ?', '2013-05-20 14:45:09', '1');

INSERT INTO `diapazen`.`dpz_polls` (`id`, `user_id`, `url`, `title`, `description`, `expiration_date`, `open`) 
VALUES (NULL, '1', 'MZ7DFG96DD3', 'Voyage cet été', 'bon voila, où part on cet été ?', '2013-06-20 14:45:09', '1');

INSERT INTO `diapazen`.`dpz_polls` (`id`, `user_id`, `url`, `title`, `description`, `expiration_date`, `open`) 
VALUES (NULL, '2', 'DFGTR1523S', 'Soirée chez moi !', 'blabla', '2013-05-26 14:45:09', '1');

INSERT INTO `diapazen`.`dpz_polls` (`id`, `user_id`, `url`, `title`, `description`, `expiration_date`, `open`) 
VALUES (NULL, '2', 'ZER7D4Z5D2', 'Sortie', 'blabla', '2013-05-25 07:28:09', '1');
/*-----------------------------------------------------------------------------*/
/*---------------------------------CHOICES-------------------------------------*/
/*-----------------------------------------------------------------------------*/
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '1', 'Couscous !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '1', 'Tajine !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '1', 'Lasagnes !');


INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '2', 'Barcelone !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '2', 'Paris !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '2', 'Londres !');

INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '3', 'bla !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '3', 'blabla !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '3', 'blablabla !');

INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '4', 'Barcelone !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '4', 'Paris ');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '4', 'Berlin !');
INSERT INTO `diapazen`.`dpz_choices` (`id`, `poll_id`, `choice`) VALUES (NULL, '4', 'Londres !');

/*-----------------------------------------------------------------------------*/
/*---------------------------------RESULTS-------------------------------------*/
/*-----------------------------------------------------------------------------*/

INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '1', 'Marc');
INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '2', 'Antoine');
INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '1', 'Jean');
INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '3', 'CLaire');


INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '4', 'Pierre');
INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '4', 'Eric');

INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '7', 'Pierre');
INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '8', 'Eric');

INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '12', 'Pierre');
INSERT INTO `diapazen`.`dpz_results` (`id`, `choice_id`, `value`) VALUES (NULL, '12', 'Eric');
