DROP TABLE IF EXISTS activity_type;
CREATE TABLE activity_type
(
   id integer auto_increment primary key,
   name varchar(50) not null,
   description text null,
   pair_one varchar(3) null,
   pair_two varchar(3) null
);

INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Аграрно-экологическая', '1.1', '4.4');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Проектирование полезных форм', '3.2', '2.1');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Психолого-терапевтическая', '3.5', '3.3');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Духовно-религиозная', '7.2', '7.4');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('СМИ', '6.4', '2.5');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Естественнонаучная и математическая', '5.1', '3.4');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Культуры и искусств', '6.5', '7.5');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Медико-оздоровительная', '4.3', '1.2');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Общественно-научная', '4.1', '5.5');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Педагогический', '3.1', '5.2');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Социальная (досуг, игровая, развивающая) сфера услуг', '1.4', '4.5');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Социально-бытовая сфера услуг', '2.3', '2.2');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Техническое творчество', '4.2', '5.3');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Экономическая', '7.1', '1.5');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Государственно-правовая', '6.1', '2.4');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Материальное производство', '6.3', '1.3');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Идеологическая', '5.4', '6.2');
INSERT INTO `activity_type` (`name`, `pair_one`, `pair_two`) VALUES ('Философская', '8.1', '7.3');
