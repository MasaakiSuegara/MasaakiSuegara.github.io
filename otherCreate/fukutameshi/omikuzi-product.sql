drop database if exists omikuzi;
create database omikuzi default character set utf8 collate utf8_general_ci;
drop user if exists 'kannushi'@'localhost';
create user 'kannushi'@'localhost' identified by 'matikane';
grant all on omikuzi.* to 'kannushi'@'localhost';
use omikuzi;

create table product (
	id int auto_increment primary key, 
	luck varchar(200) not null,
	kuzi varchar(200) not null
);

insert into product values(null, '超吉', '超すごい');
insert into product values(null, '大吉', 'すごい良い');
insert into product values(null, '中吉', 'なかなか良い');
insert into product values(null, '吉', 'ちょうど良い');
insert into product values(null, '小吉', 'まだ良い');
insert into product values(null, '末吉', 'すこしだけ良い');
insert into product values(null, '凶', 'あまり良くない');
insert into product values(null, '大凶', '厄落とし');

