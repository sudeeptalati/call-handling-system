----
-- Table structure for tbl_users
----
CREATE TABLE tbl_users (
  id INTEGER NOT NULL  PRIMARY KEY AUTOINCREMENT,
  username varchar(20) NOT NULL,
  password varchar(128) NOT NULL,
  email varchar(128) NOT NULL,
  activkey varchar(128) NOT NULL DEFAULT '',
  createtime int(10) NOT NULL DEFAULT '0',
  lastvisit int(10) NOT NULL DEFAULT '0',
  superuser int(1) NOT NULL DEFAULT '0',
  status int(1) NOT NULL DEFAULT '0'
);

----
-- Data dump for tbl_users, a total of 8 rows
----
BEGIN TRANSACTION;
INSERT INTO tbl_users (id,username,password,email,activkey,createtime,lastvisit,superuser,status) VALUES ('1','admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','21232f297a57a5a743894a0e4a801fc3','1261146094','1407156925','1','1');
INSERT INTO tbl_users (id,username,password,email,activkey,createtime,lastvisit,superuser,status) VALUES ('2','demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','fe01ce2a7fbac8fafaed7c982a04e229','1261146096','0','0','1');
INSERT INTO tbl_users (id,username,password,email,activkey,createtime,lastvisit,superuser,status) VALUES ('3','purva','e824772bbdda3f02a30d17840359c865','pp@p.cpo','9829bf3c0b06fd1f09e2b30b502a4e3b','1406558573','1406648432','0','1');
COMMIT;


----
-- Table structure for tbl_profiles_fields
----
CREATE TABLE tbl_profiles_fields (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  varname varchar(50) NOT NULL,
  title varchar(255) NOT NULL,
  field_type varchar(50) NOT NULL,
  field_size int(3) NOT NULL DEFAULT '0',
  field_size_min int(3) NOT NULL DEFAULT '0',
  required int(1) NOT NULL DEFAULT '0',
  match varchar(255) NOT NULL DEFAULT '',
  range varchar(255) NOT NULL DEFAULT '',
  error_message varchar(255) NOT NULL DEFAULT '',
  other_validator TEXT NOT NULL DEFAULT '',
  'default' varchar(255) NOT NULL DEFAULT '',
  widget varchar(255) NOT NULL DEFAULT '',
  widgetparams TEXT NOT NULL DEFAULT '',
  position int(3) NOT NULL DEFAULT '0',
  visible int(1) NOT NULL DEFAULT '0'
);

----
-- Data dump for tbl_profiles_fields, a total of 3 rows
----
BEGIN TRANSACTION;
INSERT INTO tbl_profiles_fields (id,varname,title,field_type,field_size,field_size_min,required,match,range,error_message,other_validator,default,widget,widgetparams,position,visible) VALUES ('1','lastname','Last Name','VARCHAR','50','3','1','','','Incorrect Last Name (length between 3 and 50 characters).','','','','','1','3');
INSERT INTO tbl_profiles_fields (id,varname,title,field_type,field_size,field_size_min,required,match,range,error_message,other_validator,default,widget,widgetparams,position,visible) VALUES ('2','firstname','First Name','VARCHAR','50','3','1','','','Incorrect First Name (length between 3 and 50 characters).','','','','','0','3');
INSERT INTO tbl_profiles_fields (id,varname,title,field_type,field_size,field_size_min,required,match,range,error_message,other_validator,default,widget,widgetparams,position,visible) VALUES ('3','birthday','Birthday','DATE','0','0','2','','','','','0000-00-00','UWjuidate','{"ui-theme":"redmond"}','3','2');
COMMIT;



----
-- Table structure for tbl_profiles
----
CREATE TABLE tbl_profiles (
  user_id INTEGER NOT NULL PRIMARY KEY,
  lastname varchar(50) NOT NULL DEFAULT '',
  firstname varchar(50) NOT NULL DEFAULT '',
  birthday date NOT NULL DEFAULT '0000-00-00'
);

----
-- Data dump for tbl_profiles, a total of 8 rows
----
BEGIN TRANSACTION;
INSERT INTO tbl_profiles (user_id,lastname,firstname,birthday) VALUES ('1','Admin','Administrator','0000-00-00');
INSERT INTO tbl_profiles (user_id,lastname,firstname,birthday) VALUES ('2','Demo','Demo','0000-00-00');
INSERT INTO tbl_profiles (user_id,lastname,firstname,birthday) VALUES ('3','Talati','Purva','2014-07-15');
COMMIT;


----
-- Table structure for Rights
----
CREATE TABLE Rights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
);

----
-- Data dump for Rights, a total of 0 rows
----
BEGIN TRANSACTION;
COMMIT;

----
-- Structure for index sqlite_autoindex_Rights_1 on table Rights
----
;


----
-- Table structure for AuthItemChild
----
CREATE TABLE AuthItemChild
(
   parent varchar(64) not null,
   child varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references AuthItem (name) on delete cascade on update cascade,
   foreign key (child) references AuthItem (name) on delete cascade on update cascade
);

----
-- Data dump for AuthItemChild, a total of 4 rows
----
BEGIN TRANSACTION;
INSERT INTO AuthItemChild (parent,child) VALUES ('engg','Brand.Admin');
INSERT INTO AuthItemChild (parent,child) VALUES ('engg','Brand.Index');
INSERT INTO AuthItemChild (parent,child) VALUES ('engg','Brand.Update');
INSERT INTO AuthItemChild (parent,child) VALUES ('engg','Brand.View');
COMMIT;

----
-- Structure for index sqlite_autoindex_AuthItemChild_1 on table AuthItemChild
----
;



----
-- Table structure for AuthItem
----
CREATE TABLE AuthItem
(
   name varchar(64) not null,
   type integer not null,
   description text,
   bizrule text,
   data text,
   primary key (name)
);

----
-- Data dump for AuthItem, a total of 16 rows
----
BEGIN TRANSACTION;
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Authenticated','2','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Guest','2','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Admin','2','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('engg','2','engg','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.View','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.Update','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.Index','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.Admin','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Servicecall.View','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Servicecall.Preview','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Servicecall.HtmlPreview','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Servicecall.Update','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Servicecall.Delete','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.*','1','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.Create','0','','','N;');
INSERT INTO AuthItem (name,type,description,bizrule,data) VALUES ('Brand.Delete','0','','','N;');
COMMIT;

----
-- Structure for index sqlite_autoindex_AuthItem_1 on table AuthItem
----
;



----
-- Table structure for AuthAssignment
----
CREATE TABLE AuthAssignment
(
   itemname varchar(64) not null,
   userid varchar(64) not null,
   bizrule text,
   data text,
   primary key (itemname,userid),
   foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
);

----
-- Data dump for AuthAssignment, a total of 2 rows
----
BEGIN TRANSACTION;
INSERT INTO AuthAssignment (itemname,userid,bizrule,data) VALUES ('Admin','1','','N;');
INSERT INTO AuthAssignment (itemname,userid,bizrule,data) VALUES ('engg','3','','N;');
COMMIT;

----
-- Structure for index sqlite_autoindex_AuthAssignment_1 on table AuthAssignment
----
;
