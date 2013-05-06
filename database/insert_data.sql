/*-----------------------------------------------------------------------------*/
/*----------------------insert these data in you database----------------------*/
/*----------------------------------it's a start-------------------------------*/
/*------------------------------------USERS------------------------------------*/
/*-----------------------------------------------------------------------------*/

INSERT INTO `diapazen`.`dpz_users` (`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
VALUES (NULL, 'Adrien', 'Fourel', 'adrien.fourel@isen.fr', '$2a$07$ea356421e2bc4b7a68465OElvyQr6LHdqd3lxdwFtMQbHcC5WN0zW', CURRENT_TIMESTAMP, '', NULL);

INSERT INTO `diapazen`.`dpz_users` (`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
VALUES (NULL, 'Nicolas', 'Silvain', 'nicolas.silvain@isen.fr', '$2a$07$1945af30dfc25cf863308eHPj8TwcdCkvtFkHe1mJJKeN5pnlxkKm', CURRENT_TIMESTAMP, '', NULL);

INSERT INTO `diapazen`.`dpz_users` (`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
VALUES (NULL, 'Guillaume', 'Bauduin', 'guillaume.bauduin@isen.fr', '$2a$07$eb26d1a40142ad0063bc6uTSZUWJwVknbkJz.ElWOUoFu8i01l1aG', CURRENT_TIMESTAMP, '', NULL);


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