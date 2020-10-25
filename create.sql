SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

-- -----------------------------------------------------
-- Schema uni-db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `uni-db` DEFAULT CHARACTER SET utf8 ;
USE `uni-db` ;

-- -----------------------------------------------------
-- Table `bank_accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bank_accounts` ;

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `account_number` VARCHAR(256) NOT NULL,
  `interest_percentage` DECIMAL(2,2) NULL DEFAULT 0,
  `cash` DECIMAL(10,2) NULL DEFAULT 0,
  `currency_type_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `bank_accounts_clinet_id_FK_idx` (`client_id` ASC) VISIBLE,
  INDEX `bank_accounts_currency_type_id_FK_idx` (`currency_type_id` ASC) VISIBLE,
  CONSTRAINT `bank_accounts_clinet_id_FK`
    FOREIGN KEY (`client_id`)
    REFERENCES `clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `bank_accounts_currency_type_id_FK`
    FOREIGN KEY (`currency_type_id`)
    REFERENCES `currency_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clients` ;

CREATE TABLE IF NOT EXISTS `clients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) NOT NULL,
  `PID` VARCHAR(10) NOT NULL,
  `address` VARCHAR(256) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `currency_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `currency_types` ;

CREATE TABLE IF NOT EXISTS `currency_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) NOT NULL,
  `symbol` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `employees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `employees` ;

CREATE TABLE IF NOT EXISTS `employees` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `position_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `employees_position_id_FK_idx` (`position_id` ASC) VISIBLE,
  CONSTRAINT `employees_position_id_FK`
    FOREIGN KEY (`position_id`)
    REFERENCES `positions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `positions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `positions` ;

CREATE TABLE IF NOT EXISTS `positions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transaction_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transaction_types` ;

CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transactions` ;

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` DECIMAL(10,2) NOT NULL,
  `employee_id` INT NOT NULL,
  `bank_account_id` INT NOT NULL,
  `transaction_type_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `transactions_employee_id_FK_idx` (`employee_id` ASC) VISIBLE,
  INDEX `transactions_bank_account_id_FK_idx` (`bank_account_id` ASC) VISIBLE,
  INDEX `transactions_transaction_type_id_FK_idx` (`transaction_type_id` ASC) VISIBLE,
  CONSTRAINT `transactions_employee_id_FK`
    FOREIGN KEY (`employee_id`)
    REFERENCES `employees` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `transactions_bank_account_id_FK`
    FOREIGN KEY (`bank_account_id`)
    REFERENCES `bank_accounts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `transactions_transaction_type_id_FK`
    FOREIGN KEY (`transaction_type_id`)
    REFERENCES `transaction_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
