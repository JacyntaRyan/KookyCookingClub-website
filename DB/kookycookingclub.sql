-- MySQL Workbench Forward Engineering
DROP DATABASE IF EXISTS kookycookingclub;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema kookycookingclub
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema kookycookingclub
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kookycookingclub` ;
USE `kookycookingclub` ;

-- -----------------------------------------------------
-- Table `kookycookingclub`.`User`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `kookycookingclub`.`Users` (
  `user_id` INT NOT NULL auto_increment,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `phone` INT(10) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `username` VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `date_of_birth` DATE ,
  `email` VARCHAR(45) NOT NULL,
  `user_type` ENUM('user', 'admin') DEFAULT 'user' ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  PRIMARY KEY (`user_id`));

INSERT into 
`Users`(`first_name`,`last_name`,`phone`,`address`,`username`,`password`,`date_of_birth`,`email`,`user_type`)
values
('John','Ryan','0876543247', '32 willow gardens, mitchell street, Templemore','john56','password','1990-09-18','john@gmail.com','admin'),
('Jacynta','Ryan','0891342567', 'monakeeba, Thurles','jacynta123','password','1994-02-23','jaz@gmail.com','admin'),
('Frank','Dunne','0891383467', 'BloomsField, Limerick','FrankD','$2y$10$haR76lNtscr0RCesKSvVuOoAaMxIYDwgXI1JA.SJDkJlfuI8lhvPe','1978-12-03','FrankieD@gmail.com','user');
-- -----------------------------------------------------
-- Table `kookycookingclub`.`Payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kookycookingclub`.`Payments` (
  `pay_id` INT NOT NULL auto_increment,
  `amount_remaining` DECIMAL(10,2) NOT NULL,
  `is_paid` ENUM('Y', 'N') Default 'N',
  `user_id` INT NULL,
  PRIMARY KEY (`pay_id`));
  
  INSERT into `Payments`(`amount_remaining`, `is_paid`,`user_id`)
  VALUES
  (12.00,'N',3),(10.00,'N',3),(5.00,'N',3),(15.00,'N',3);


-- -----------------------------------------------------
-- Table `kookycookingclub`.`Event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kookycookingclub`.`Events` (
  `event_id` INT NOT NULL auto_increment,
  `date` date NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` VARCHAR(255) NULL,
  `availability` ENUM('yes', 'no') default 'yes',
  `image_path` VARCHAR(255) NULL,
  PRIMARY KEY (`event_id`));
  
  insert into Events (date,price,location,name,description,availability,image_path) values('2019/05/12',20.00,'Cork','Sustainable Living Festival',
'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
 nisi ut aliquip ex ea commodo consequat.','yes','images//veggarden.jpg');
 insert into Events (date,price,location,name,description,availability,image_path) values ('2019/07/04',34.00,'Strand hotel ,Limerick','Q/A with Jamie Oliver',
'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
 nisi ut aliquip ex ea commodo consequat.','yes','images//event.jpg');


-- -----------------------------------------------------
-- Table `kookycookingclub`.`Course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kookycookingclub`.`Courses` (
  `course_id` INT NOT NULL auto_increment,
  `course_name` VARCHAR(45) NOT NULL,
  `date` date NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `description` VARCHAR(255) NULL,
  `availability` ENUM('yes', 'no') DEFAULT 'yes',
  `image_path` VARCHAR(255) NULL,
  PRIMARY KEY (`course_id`));
  insert into Courses (course_name,date,price,description,availability,image_path) values('Intro to Pastry', '2019/04/29',64.00,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
 nisi ut aliquip ex ea commodo consequat.','yes','images//pastry.jpeg');
 insert into Courses (course_name,date,price,description,availability,image_path) values ('Menu Planning', '2019/06/19',32.00,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
 nisi ut aliquip ex ea commodo consequat.' ,'yes','images//foodPrep.jpg');
   insert into Courses (course_name,date,price,description,availability,image_path) values('test', '2019/04/29',64.00,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
 nisi ut aliquip ex ea commodo consequat.','yes','images//choc.jpeg');
 insert into Courses (course_name,date,price,description,availability,image_path) values ('test', '2019/06/19',32.00,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
 nisi ut aliquip ex ea commodo consequat.' ,'yes','images//vegan.jpeg');


-- -----------------------------------------------------
-- Table `kookycookingclub`.`Booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kookycookingclub`.`Bookings` (
  `booking_id` INT NOT NULL auto_increment,
  `user_id` INT NULL,
  `course_id` INT NULL,
  `pay_id` INT NULL,
  `event_id` INT NULL,
  PRIMARY KEY (`booking_id`),
  CONSTRAINT `booking_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `kookycookingclub`.`Users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `booking_pay_id`
    FOREIGN KEY (`pay_id`)
    REFERENCES `kookycookingclub`.`Payments` (`pay_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `booking_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `kookycookingclub`.`Events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `booking_course_id`
    FOREIGN KEY (`course_id`)
    REFERENCES `kookycookingclub`.`Courses` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT into `Bookings`(`user_id` ,`course_id` ,`pay_id`)
VALUES
(3,2,1),
(3,1,2);
INSERT into `Bookings`(`user_id` ,`event_id` ,`pay_id`)
VALUES
(3,2,3),
(3,1,4);

-- -----------------------------------------------------
-- Table `kookycookingclub`.`Venue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kookycookingclub`.`Venues` (
  `venue_id` INT NOT NULL,
  `course_id` INT NULL,
  `address` VARCHAR(255) NOT NULL,
  `phone` INT NOT NULL,
  primary key(`venue_id`),
    CONSTRAINT `venue_course_id`
    FOREIGN KEY (`course_id`)
    REFERENCES `kookycookingclub`.`Course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


