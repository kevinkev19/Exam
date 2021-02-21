
CREATE DATABASE `inventory`;
CREATE TABLE `inventory`.`items` ( `item_id` INT NOT NULL AUTO_INCREMENT , `item_name` VARCHAR(255) NOT NULL , `item_quantity` INT NOT NULL , `item_amount` DOUBLE NOT NULL , PRIMARY KEY (`item_id`)) ENGINE = InnoDB;