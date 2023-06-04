drop database petvet;
create database petvet;
use petvet;

create table role(
ID int unsigned not null auto_increment primary key,
r_name varchar(15) not null
);

insert into role (r_name) values('Admin');
insert into role (r_name) values('Editor');
insert into role (r_name) values('Manager');


create table users(
ID int unsigned not null auto_increment primary key,
prefix varchar(5),
fullname varchar(45) not null,
username varchar(10) not null,
u_password varchar(60) not null,
email varchar(50),
fk_role_id int unsigned not null,
foreign key (`fk_role_id`) references `role` (`ID`) on delete restrict
);

insert into users (prefix, fullname, username, u_password, email, fk_role_id)
values('Mr.', 'Ahmed Farhad Abdulkareem', 'A7a', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@mail.com', 1); /*[PASSWORD:123]*/
insert into users (prefix, fullname, username, u_password, email, fk_role_id)
values('Ms.', 'Zhela Sartep Umed', 'Zhelo', '6a0129d59aa4967c0627c4c0803ae1a9a49f6ddd', 'z@mail.com', 3); /*[PASSWORD:1312]*/
insert into users (prefix, fullname, username, u_password, email, fk_role_id)
values('Miss', 'Sarah Muafaq Tofeq', 'Susu', '00fd4b4549a1094aae926ef62e9dbd3cdcc2e456', 'susu@mail.com', 2); /*[PASSWORD:1122]*/

create table privilege(
ID int unsigned not null auto_increment primary key,
view_p enum('Yes','No') not null,
insert_p enum('Yes','No') not null,
update_p enum('Yes','No') not null,
delete_p enum('Yes','No') not null,
p_name varchar(35) not null,
fk_users_id int unsigned not null,
foreign key (`fk_users_id`) references `users` (`ID`) on delete cascade
);

insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Categories', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Next Vaccination Report', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Owner Test Vaccination Report', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Owners', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Pets', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Privileges', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Roles', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Test Report', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Tests', 1);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'Yes', 'Yes', 'Yes', 'Users', 1);

insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'No', 'Yes', 'No', 'Owners', 2);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('No', 'No', 'No', 'No', 'Categories', 3);
insert into privilege (view_p, insert_p, update_p, delete_p, p_name, fk_users_id) values('Yes', 'No', 'No', 'No', 'Roles', 3);



create table owners(
ID int unsigned not null auto_increment primary key,
prefix varchar(5),
fullname varchar(45) not null,
address char(75),
mobile char(11) not null,
email varchar(50),
description char(75)
);

insert into owners (prefix, fullname, address, mobile, email)
values('Mr.','Ahmed Hakem Makhluq','Irbil, Ankawa','07704324568','makh@mail.com');
insert into owners (prefix, fullname, address, mobile, email)
values('Miss','Sara Kalar Muhammed','Irbil, Saidawa','07821673475','sara@mail.com');
insert into owners (prefix, fullname, address, mobile, email)
values('Mrs.','Sarah Paywand Solav','Irbil, Topzawa','07516378943','s.paywand@mail.com');
insert into owners (prefix, fullname, address, mobile, email)
values('Miss','Ahmed Rasul Tolas','Irbil, Newroz','07507893409','zarposh@mail.com');


create table pet(
ID int unsigned not null auto_increment primary key,
p_name varchar(25) not null,
birthdate date not null,
gender enum('Male', 'Female') not null,
species varchar(25),
breed varchar (25),
photo varchar(75),
coat_color varchar(10),
microchip_number int not null,
microchip_date date not null,
rabies varchar(50),
result char(50),
reference_lab char(50),
health_certificate char(50),
inserted_date date not null,
fk_owners_id int unsigned not null,
foreign key (`fk_owners_id`) references `owners` (`ID`) on delete cascade
);

insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Charly','2016-02-27', '../petvet/uploads/photos/1.jpg','Male','dog','sheperd','Yellow',12345678,'2018-08-01','../petvet/uploads/files/1_rabies.pdf','../petvet/uploads/files/1_result.pdf','no reference','yes','2018-08-01', 1);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Mr. Betils','2017-03-21', '../petvet/uploads/photos/2.jpg','Male','Cat','Bowny','Brown',847294,'2018-12-28','../petvet/uploads/files/2_rabies.pdf','../petvet/uploads/files/2_result.pdf','no reference','yes','2019-01-01', 2);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Semon','2016-08-18', '../petvet/uploads/photos/3.jpg','Female','Cat','Egyption','White',98214,'2018-08-03','../petvet/uploads/files/3_rabies.pdf','../petvet/uploads/files/3_result.pdf','no reference','yes','2018-08-03', 1);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Tommy','2016-02-27', '../petvet/uploads/photos/1.jpg','Male','dog','sheperd','Yellow',12345678,'2018-08-01','../petvet/uploads/files/1_rabies.pdf','../petvet/uploads/files/1_result.pdf','no reference','yes','2018-08-01', 3);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Light','2017-03-21', '../petvet/uploads/photos/2.jpg','Male','Cat','Bowny','Brown',847294,'2018-12-28','../petvet/uploads/files/2_rabies.pdf','../petvet/uploads/files/2_result.pdf','no reference','yes','2019-01-01', 4);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Betty','2016-08-18', '../petvet/uploads/photos/3.jpg','Female','Cat','Egyption','White',98214,'2018-08-03','../petvet/uploads/files/3_rabies.pdf','../petvet/uploads/files/3_result.pdf','no reference','yes','2018-08-03', 3);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Carl','2016-02-27', '../petvet/uploads/photos/1.jpg','Male','dog','sheperd','Yellow',12345678,'2018-08-01','../petvet/uploads/files/1_rabies.pdf','../petvet/uploads/files/1_result.pdf','no reference','yes','2018-08-01', 4);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Beast','2017-03-21', '../petvet/uploads/photos/2.jpg','Male','Cat','Bowny','Brown',847294,'2018-12-28','../petvet/uploads/files/2_rabies.pdf','../petvet/uploads/files/2_result.pdf','no reference','yes','2019-01-01', 2);
insert into pet (p_name, birthdate, photo, gender, species, breed, coat_color, microchip_number, microchip_date, rabies, result, reference_lab, health_certificate, inserted_date, fk_owners_id)
values('Miss. Cookie','2016-08-18', '../petvet/uploads/photos/3.jpg','Female','Cat','Egyption','White',98214,'2018-08-03','../petvet/uploads/files/3_rabies.pdf','../petvet/uploads/files/3_result.pdf','no reference','yes','2018-08-03', 3);

create table category(
ID int unsigned not null auto_increment primary key,
c_name varchar(45) not null,
description varchar(50)
);

insert into category (c_name, description) values('External Parasite Treatments', 'parasite.');
insert into category (c_name, description) values('Internal Parasite Treatments (Deworming)', 'parasite (deworm).');
insert into category (c_name, description) values('Surgeries', 'any kind of surgeries.');


create table test(
ID int unsigned not null auto_increment primary key,
t_date date not null,
vaccine_label char(50) not null,
barcode char(15) not null,
next_vaccination date not null,
fk_users_id int unsigned not null,
fk_pet_id int unsigned not null,
fk_category_id int unsigned not null,
foreign key (`fk_users_id`) references `users` (`ID`) on delete cascade,
foreign key (`fk_pet_id`) references `pet` (`ID`) on delete cascade,
foreign key (`fk_category_id`) references `category` (`ID`) on delete restrict
);

insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2018-09-6',1,1,1);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-01-06','13564','12423545','2018-05-02',2,2,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2017-01-01',1,1,2);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-01-06','13564','12423545','2017-03-02',2,3,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2017-03-23',1,4,1);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-01-06','13564','12423545','2017-05-17',2,5,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2017-09-21',1,6,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-01-06','13564','12423545','2017-05-11',2,7,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2017-12-16',1,8,2);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-01-06','13564','12423545','2018-10-17',2,5,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2018-10-21',1,6,2);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-01-06','13564','12423545','2018-10-11',2,7,3);
insert into test (t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id)
values('2018-08-01','1234567','123456789','2018-10-16',1,8,2);

