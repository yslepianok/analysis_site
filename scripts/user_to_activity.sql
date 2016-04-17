DROP TABLE IF EXISTS user_to_activity;
CREATE TABLE `analysis_site`.`user_to_activity` (
  `user_id` INT NULL,
  `activity_id` INT NULL,
  `date` DATETIME NULL,
  `additional` TEXT NULL,
  `weight` FLOAT NULL,
  PRIMARY KEY (`user_id`, `activity_id`),
  INDEX `fk_user_to_activity_2_idx` (`activity_id` ASC),
  CONSTRAINT `fk_user_to_activity_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `analysis_site`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_to_activity_2`
    FOREIGN KEY (`activity_id`)
    REFERENCES `analysis_site`.`activity_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
