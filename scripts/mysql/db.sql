DROP DATABASE csulalea_LeaugueServer;
CREATE DATABASE csulalea_LeaugueServer;
Use csulalea_LeaugueServer;

drop table if exists Users;
drop table if exists Teams;
drop table if exists Notes;
drop table if exists Posts;

CREATE TABLE Users (
    id int PRIMARY KEY AUTO_INCREMENT,
	ign varchar (32) NOT NULL ,
	status tinyint (1) NULL ,
	email varchar (32) Not NULL ,
	salt varchar (10) Not NULL ,
	pass varchar (13) NOT NULL ,
	active tinyint(1) Not Null,
	reg_date date Not NULL ,
	team varchar (32) NULL
    	
);

CREATE TABLE Teams (
    name varchar (32)PRIMARY KEY,
	captain int Not Null,
	Foreign Key (captain) References Users(id) On Delete Restrict ON Update Cascade
);

Alter Table Users ADD Foreign Key (team) References Teams(name) On Delete Restrict ON Update Cascade;

CREATE TABLE Posts (
    pid int PRIMARY KEY AUTO_INCREMENT,
	message text not null,
	post_date date Not Null,
	title varchar(32) Not Null,
	author int Not Null,
	Foreign Key (author) References Users(id) On Delete Restrict ON Update Cascade	
	
);

CREATE TABLE Notes (
    nid int PRIMARY KEY AUTO_INCREMENT,
	sender int Not Null,
	recipient int not null,
	type tinyint (1) Not NULL,
	Foreign Key (sender) References Users(id) On Delete Cascade ON Update Cascade,
	Foreign Key (recipient) References Users(id) On Delete Cascade ON Update Cascade
);


-- end of script 

-- add permissions to test on repository locally 
CREATE USER 'csulalea'@'localhost' IDENTIFIED BY 'programming';
GRANT ALL PRIVILEGES ON *.* TO 'csulalea'@'localhost';
FLUSH PRIVILEGES;



 
