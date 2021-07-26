create database e_learning_site;
use e_learning_site;
create table Admin(
adminID varchar(20) primary key,
password varchar(100) NOT NULL,
name varchar(30) NOT NULL,
email varchar(30) NOT NULL);

create table User (
userID varchar(20) primary key,
name varchar(30) NOT NULL,
regDate date NOT NULL,
address varchar(100) NOT NULL,
profilePic varchar(100),
phoneNum char(10) NOT NULL,
email varchar(30) NOT NULL,
password varchar(100) NOT NULL);

create table Contact(
contactID int not null auto_increment primary key,
userID varchar(20) NOT NULL,
name varchar(30) NOT NULL,
email varchar(30) NOT NULL,
message varchar(100),
phoneNum char(10) NOT NULL,
foreign key(userID) references User(userID));

create table Course(
course_name varchar(20),
courseID varchar(20) primary key,
course_resource varchar(60),
course_description varchar(200),
course_fee long);

create table feedback(
feedback_id int not null auto_increment primary key,
name varchar(30),
email varchar(30),
feedback varchar(200),
userID varchar(20),
foreign key(userID) references User(userID));
