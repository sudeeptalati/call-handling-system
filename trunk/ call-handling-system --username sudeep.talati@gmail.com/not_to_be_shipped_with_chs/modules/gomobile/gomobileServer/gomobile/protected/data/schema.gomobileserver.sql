----
-- phpLiteAdmin database dump (http://phpliteadmin.googlecode.com)
-- phpLiteAdmin version: 1.9.5
-- Exported: 12:22am on February 17, 2015 (GMT)
-- database file: ./gomobile/protected/data/gomobileserver.db
----
BEGIN TRANSACTION;

----
-- Table structure for engineer
----
CREATE TABLE 'engineer' ('id' INTEGER PRIMARY KEY NOT NULL, 'engineer_email' TEXT, 'pwd' TEXT, 'exp_date' DATETIME, 'created' DATETIME, 'last_modified' DATETIME);

----
-- Data dump for engineer, a total of 3 rows
----
INSERT INTO "engineer" ("id","engineer_email","pwd","exp_date","created","last_modified") VALUES ('1','sweetpullo@gmail.com','c9ebf569947258fc5263bb8d0b00192a988e99280104d5298e80d1b320deaeba','1424905200','1415806787','');
INSERT INTO "engineer" ("id","engineer_email","pwd","exp_date","created","last_modified") VALUES ('2','sweetpullo@gmail.com5','purva1911','1421276400','1415807175',NULL);
INSERT INTO "engineer" ("id","engineer_email","pwd","exp_date","created","last_modified") VALUES ('3','purva.chourey@yahoo.com','c9ebf569947258fc5263bb8d0b00192a988e99280104d5298e80d1b320deaeba','1432076400','1415809843','1424097869');

----
-- Table structure for data_status
----
CREATE TABLE 'data_status' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'name' TEXT);

----
-- Data dump for data_status, a total of 4 rows
----
INSERT INTO "data_status" ("id","name") VALUES ('1','Received from CHS');
INSERT INTO "data_status" ("id","name") VALUES ('2','Sent to Mobile');
INSERT INTO "data_status" ("id","name") VALUES ('3','Received from Mobile');
INSERT INTO "data_status" ("id","name") VALUES ('4','Sent to CHS');

----
-- Table structure for engineer_data
----
CREATE TABLE 'engineer_data' ('id' INTEGER PRIMARY KEY NOT NULL, 'engineer_email' TEXT, 'data' TEXT, 'data_status_id' INTEGER, 'created' DATETIME, 'last_modified' DATETIME, 'gomobile_account_id' TEXT);

----
-- Data dump for engineer_data, a total of 0 rows
----

----
-- Table structure for gomobile_account
----
CREATE TABLE 'gomobile_account' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'gomobile_account_name' TEXT, 'company_name' TEXT, 'contact_email' TEXT, 'no_of_rapport_users' INTEGER, 'no_of_engineers' INTEGER,'created_on' DATETIME DEFAULT CURRENT_TIMESTAMP, 'last_modified_on' DATETIME);

----
-- Data dump for gomobile_account, a total of 0 rows
----
COMMIT;
