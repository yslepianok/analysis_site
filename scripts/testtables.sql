drop table if exists user_to_test;
drop table if exists answer;
drop table if exists question;
drop table if exists test;

create table test ( id int primary key auto_increment, name varchar(50) not null, weight float not null default 0, comment text null );

create table question ( id int primary key auto_increment, test_id int not null, name varchar(50) not null, text text null, FOREIGN KEY (test_id) REFERENCES test(id) ON DELETE CASCADE );

create table answer ( id int primary key auto_increment, question_id int not null, name varchar(50) null, url varchar(250) null, text varchar(50) null, cells TEXT null, weight float not null default 0, FOREIGN KEY (question_id) REFERENCES question(id) ON DELETE CASCADE );

create table user_to_test ( id int primary key auto_increment, user_id int not null, test_id int not null, date datetime not null, url varchar(250) null, answers TEXT null, FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE, FOREIGN KEY (test_id) REFERENCES test(id) ON DELETE CASCADE );
