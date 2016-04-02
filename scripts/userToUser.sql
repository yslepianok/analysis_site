CREATE TABLE `analysis_site`.`user_to_user` (
  `user_id` INT NOT NULL,
  `user_related_id` INT NOT NULL,
  `relation_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `user_related_id`),
  INDEX `fk_user_to_user_2_idx` (`user_related_id` ASC),
  INDEX `fk_user_to_user_3_idx` (`relation_id` ASC),
  CONSTRAINT `fk_user_to_user_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `analysis_site`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_to_user_2`
    FOREIGN KEY (`user_related_id`)
    REFERENCES `analysis_site`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_to_user_3`
    FOREIGN KEY (`relation_id`)
    REFERENCES `analysis_site`.`user_relation` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
