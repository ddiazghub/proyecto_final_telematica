CREATE TABLE `covid19_management`.`users` (
  `user_id` INT NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `role_id` INT UNSIGNED NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`user_id`));

CREATE TABLE `covid19_management`.`cases` (
  `case_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `person_id` INT NOT NULL,
  `sex_id` INT NOT NULL,
  `birthday` VARCHAR(45) NOT NULL,
  `home_address` VARCHAR(45) NOT NULL,
  `work_address` VARCHAR(45) NOT NULL,
  `state_id` INT NOT NULL,
  `last_update` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`case_id`));

CREATE TABLE `covid19_management`.`roles` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_id`));

CREATE TABLE `covid19_management`.`sexes` (
  `sex_id` INT NOT NULL AUTO_INCREMENT,
  `sex` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`sex_id`));

CREATE TABLE `covid19_management`.`states` (
  `state_id` INT NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`state_id`));



INSERT INTO `covid19_management`.`roles` (`role`) VALUES ('Administración');
INSERT INTO `covid19_management`.`roles` (`role`) VALUES ('Ayudante');
INSERT INTO `covid19_management`.`roles` (`role`) VALUES ('Médico');

INSERT INTO `covid19_management`.`sexes` (`sex`) VALUES ('Masculino');
INSERT INTO `covid19_management`.`sexes` (`sex`) VALUES ('Femenino');

INSERT INTO `covid19_management`.`states` (`state`) VALUES ('Negativo');
INSERT INTO `covid19_management`.`states` (`state`) VALUES ('En Tratamiento Casa');
INSERT INTO `covid19_management`.`states` (`state`) VALUES ('En Tratamiento Hospital');
INSERT INTO `covid19_management`.`states` (`state`) VALUES ('En UCI');
INSERT INTO `covid19_management`.`states` (`state`) VALUES ('Curado');
INSERT INTO `covid19_management`.`states` (`state`) VALUES ('Muerte');