SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `cake_workshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `cake_workshop` ;

-- -----------------------------------------------------
-- Table `cake_workshop`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`categories` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `code` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idx_unique_name` (`name` ASC) ,
  UNIQUE INDEX `idx_unique_code` (`code` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`courses` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`courses` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `category_id` BIGINT UNSIGNED NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `code` VARCHAR(50) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_courses_categories1_idx` (`category_id` ASC) ,
  UNIQUE INDEX `idx_unique_code` (`code` ASC) ,
  CONSTRAINT `fk_courses_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `cake_workshop`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`terms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`terms` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`terms` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `start` DATE NOT NULL ,
  `end` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idx_unique_term` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`genders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`genders` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`genders` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idx_unique_name` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`departments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`departments` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`departments` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `number` TINYINT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idx_unique_name` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`occupations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`occupations` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`occupations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idx_unique_name` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`groups` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`groups` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`users` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `group_id` BIGINT UNSIGNED NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `title` VARCHAR(45) NULL ,
  `firstname` VARCHAR(45) NOT NULL ,
  `lastname` VARCHAR(45) NOT NULL ,
  `gender_id` BIGINT UNSIGNED NOT NULL ,
  `department_id` BIGINT UNSIGNED NOT NULL ,
  `occupation_id` BIGINT UNSIGNED NOT NULL ,
  `hrz` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NOT NULL ,
  `hash` VARCHAR(100) NULL ,
  `email_confirmed` TINYINT(1) NOT NULL DEFAULT 0 ,
  `email_update` VARCHAR(100) NULL ,
  `active` VARCHAR(45) NOT NULL ,
  `created` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_genders_idx` (`gender_id` ASC) ,
  INDEX `fk_attendees_departments_idx` (`department_id` ASC) ,
  INDEX `fk_attendees_occupations_idx` (`occupation_id` ASC) ,
  INDEX `fk_users_groups_idx` (`group_id` ASC) ,
  UNIQUE INDEX `idx_unique_email` (`email` ASC) ,
  INDEX `idx_hash` (`hash` ASC) ,
  CONSTRAINT `fk_users_genders1`
    FOREIGN KEY (`gender_id` )
    REFERENCES `cake_workshop`.`genders` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendees_departments1`
    FOREIGN KEY (`department_id` )
    REFERENCES `cake_workshop`.`departments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendees_occupations1`
    FOREIGN KEY (`occupation_id` )
    REFERENCES `cake_workshop`.`occupations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `cake_workshop`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`types` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`types` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idx_unique_name` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`invoices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`invoices` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`invoices` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type_id` BIGINT UNSIGNED NOT NULL ,
  `user_id` BIGINT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `institution` VARCHAR(100) NULL ,
  `department` VARCHAR(100) NULL ,
  `postbox` VARCHAR(100) NULL ,
  `to_person` VARCHAR(100) NULL ,
  `street` VARCHAR(100) NOT NULL ,
  `zip` VARCHAR(10) NOT NULL ,
  `location` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_invoices_invoice_types1_idx` (`type_id` ASC) ,
  UNIQUE INDEX `idx_unique_name` (`name` ASC, `user_id` ASC) ,
  INDEX `fk_invoices_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_invoices_invoice_types1`
    FOREIGN KEY (`type_id` )
    REFERENCES `cake_workshop`.`types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoices_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `cake_workshop`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`courses_terms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`courses_terms` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`courses_terms` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `term_id` BIGINT UNSIGNED NOT NULL ,
  `course_id` BIGINT UNSIGNED NOT NULL ,
  `attendees` INT NOT NULL ,
  `max` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_courses_terms_terms1_idx` (`term_id` ASC) ,
  INDEX `fk_courses_terms_courses1_idx` (`course_id` ASC) ,
  UNIQUE INDEX `idx_unique_course_terrm` (`term_id` ASC, `course_id` ASC) ,
  CONSTRAINT `fk_courses_terms_terms1`
    FOREIGN KEY (`term_id` )
    REFERENCES `cake_workshop`.`terms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_courses_terms_courses1`
    FOREIGN KEY (`course_id` )
    REFERENCES `cake_workshop`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`bookings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`bookings` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`bookings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` BIGINT UNSIGNED NOT NULL ,
  `courses_term_id` BIGINT UNSIGNED NOT NULL ,
  `invoice_id` BIGINT UNSIGNED NOT NULL ,
  `commitment` TINYINT(1) NOT NULL DEFAULT 0 ,
  `completed` TINYINT(1) NOT NULL DEFAULT 0 ,
  `certificate` TINYINT(1) NOT NULL DEFAULT 0 ,
  `new` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATETIME NOT NULL ,
  `updated` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_bookings_users_idx` (`user_id` ASC) ,
  UNIQUE INDEX `idx_unique_booking` (`user_id` ASC, `courses_term_id` ASC) ,
  INDEX `fk_bookings_invoices_idx` (`invoice_id` ASC) ,
  INDEX `fk_bookings_courses_term_idx` (`courses_term_id` ASC) ,
  CONSTRAINT `fk_bookings_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `cake_workshop`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bookings_invoices1`
    FOREIGN KEY (`invoice_id` )
    REFERENCES `cake_workshop`.`invoices` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bookings_courses_terms1`
    FOREIGN KEY (`courses_term_id` )
    REFERENCES `cake_workshop`.`courses_terms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_workshop`.`days`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_workshop`.`days` ;

CREATE  TABLE IF NOT EXISTS `cake_workshop`.`days` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `courses_term_id` BIGINT UNSIGNED NOT NULL ,
  `start_date` DATE NOT NULL ,
  `start_time` TIME NOT NULL ,
  `end_time` TIME NOT NULL ,
  INDEX `fk_courses_days_courses_terms1_idx` (`courses_term_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_courses_days_courses_terms1`
    FOREIGN KEY (`courses_term_id` )
    REFERENCES `cake_workshop`.`courses_terms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `cake_workshop` ;
USE `cake_workshop`;

DELIMITER $$

USE `cake_workshop`$$
DROP TRIGGER IF EXISTS `cake_workshop`.`trigger_increment_booking_count` $$
USE `cake_workshop`$$




CREATE TRIGGER trigger_increment_booking_count AFTER INSERT ON bookings
  FOR EACH ROW BEGIN
	UPDATE courses_terms SET courses_terms.attendees = courses_terms.attendees + 1 WHERE courses_terms.id = NEW.courses_term_id;
END;

$$


USE `cake_workshop`$$
DROP TRIGGER IF EXISTS `cake_workshop`.`trigger_decrement_booking_count` $$
USE `cake_workshop`$$




CREATE TRIGGER trigger_decrement_booking_count AFTER DELETE ON bookings
  FOR EACH ROW BEGIN
	UPDATE courses_terms SET attendees = attendees - 1 WHERE courses_terms.id = OLD.courses_term_id;
END;

$$


DELIMITER ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cake_workshop`.`genders`
-- -----------------------------------------------------
START TRANSACTION;
USE `cake_workshop`;
INSERT INTO `cake_workshop`.`genders` (`id`, `name`) VALUES (1, 'Herr');
INSERT INTO `cake_workshop`.`genders` (`id`, `name`) VALUES (2, 'Frau');
INSERT INTO `cake_workshop`.`genders` (`id`, `name`) VALUES (3, 'Sonstiges');

COMMIT;

-- -----------------------------------------------------
-- Data for table `cake_workshop`.`occupations`
-- -----------------------------------------------------
START TRANSACTION;
USE `cake_workshop`;
INSERT INTO `cake_workshop`.`occupations` (`id`, `name`) VALUES (1, 'Lehrende(r) / Wiss. Mitarb. der Goethe-Universität');
INSERT INTO `cake_workshop`.`occupations` (`id`, `name`) VALUES (2, 'Stud. Mitarb. der Goethe-Universität');
INSERT INTO `cake_workshop`.`occupations` (`id`, `name`) VALUES (3, 'Lehrer(in)');
INSERT INTO `cake_workshop`.`occupations` (`id`, `name`) VALUES (4, 'Hess. Hochschulangehörige(r)');
INSERT INTO `cake_workshop`.`occupations` (`id`, `name`) VALUES (5, 'Sonstige');

COMMIT;

-- -----------------------------------------------------
-- Data for table `cake_workshop`.`groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `cake_workshop`;
INSERT INTO `cake_workshop`.`groups` (`id`, `name`) VALUES (1, 'admin');
INSERT INTO `cake_workshop`.`groups` (`id`, `name`) VALUES (2, 'assistant');
INSERT INTO `cake_workshop`.`groups` (`id`, `name`) VALUES (3, 'attendee');

COMMIT;
