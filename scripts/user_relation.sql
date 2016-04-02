DROP TABLE IF EXISTS user_relation;
CREATE TABLE user_relation
(
   id integer auto_increment primary key,
   name varchar(50) not null,
   level smallint(3)
);