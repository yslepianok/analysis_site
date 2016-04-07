DROP TABLE IF EXISTS user_relation;
CREATE TABLE user_relation
(
   id integer auto_increment primary key,
   name varchar(50) not null,
   level smallint(3)
);

INSERT INTO `user_relation` (`name`, `level`) VALUES ('Мама', '1');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Мачеха', '1');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Папа', '1');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Отчим', '1');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Брат', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Сестра', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Бабушка', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Дедушка', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Дядя', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Тетя', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Сын', '2');
INSERT INTO `user_relation` (`name`, `level`) VALUES ('Дочь', '2');
