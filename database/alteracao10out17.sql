-- MySQL Workbench Synchronization
-- Generated: 2017-10-10 18:28
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Leo

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `xango_dev`.`tbl_tarefas` 
DROP COLUMN `tar_titulo`,
CHANGE COLUMN `tar_descricao` `tar_descricao` VARCHAR(1000) NULL DEFAULT NULL ,
ADD COLUMN `tar_tipo` INT(11) NULL DEFAULT NULL AFTER `tar_ordem`,
ADD COLUMN `ftn_id` INT(11) NULL DEFAULT NULL AFTER `usu_id_mandante`,
ADD INDEX `fk_tbl_tarefas_tbl_fontes1_idx` (`ftn_id` ASC);

DROP TABLE IF EXISTS `xango_dev`.`mensagens` ;

ALTER TABLE `xango_dev`.`tbl_tarefas` 
ADD CONSTRAINT `fk_tbl_tarefas_tbl_fontes1`
  FOREIGN KEY (`ftn_id`)
  REFERENCES `xango_dev`.`tbl_fontes` (`ftn_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
