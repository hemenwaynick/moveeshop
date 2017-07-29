drop database if exists nhemenway_moveeshop;
create database if not exists nhemenway_moveeshop;
use nhemenway_moveeshop;

create table if not exists Titles (
  tno int(4) primary key,
  tname varchar(50),
  inventory int(4),
  price decimal(4,2)
  );

create table if not exists Customers (
  cno int(4) primary key auto_increment,
  cname varchar(50),
  street varchar(50),
  city varchar(50),
  state varchar(50),
  zip int(2),
  phone char(12),
  email varchar(50) unique,
  password varchar(12),
  last_access datetime
  );

create table if not exists Orders(
  ono int(4) primary key auto_increment,
  cno int(4) not null,
  received datetime,
  foreign key (cno) references Customers(cno)
  );

create table if not exists Odetails (
  ono int(4) not null,
  tno int(4) not null,
  qty int(1) check(qty > 0),
  primary key (ono, tno),
  foreign key (ono) references Orders(ono),
  foreign key (tno) references Titles(tno)
  );

