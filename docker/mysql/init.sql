CREATE TABLE IF NOT EXISTS `testdocker`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `price` DECIMAL(8,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `testdocker`.`buyers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `testdocker`.`bids` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `buyer_id` INT NOT NULL,
  `amount` DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_idx` (`product_id` ASC),
  INDEX `fk_buyer_idx` (`buyer_id` ASC),
  CONSTRAINT `fk_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `testdocker`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_buyer`
    FOREIGN KEY (`buyer_id`)
    REFERENCES `testdocker`.`buyers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

INSERT INTO `testdocker`.`products` (`id`, `name`, `price`) VALUES ('1', 'Test product', '100.00');

INSERT INTO `testdocker`.`buyers` (`id`, `name`) VALUES ('1', 'Buyer1');
INSERT INTO `testdocker`.`buyers` (`id`, `name`) VALUES ('2', 'Buyer2');
INSERT INTO `testdocker`.`buyers` (`id`, `name`) VALUES ('3', 'Buyer3');

INSERT INTO `testdocker`.`bids` (`id`, `product_id`, `buyer_id`, `amount`) VALUES ('1', '1', '1', '20');
INSERT INTO `testdocker`.`bids` (`id`, `product_id`, `buyer_id`, `amount`) VALUES ('2', '1', '2', '99');
INSERT INTO `testdocker`.`bids` (`id`, `product_id`, `buyer_id`, `amount`) VALUES ('3', '1', '3', '105');

