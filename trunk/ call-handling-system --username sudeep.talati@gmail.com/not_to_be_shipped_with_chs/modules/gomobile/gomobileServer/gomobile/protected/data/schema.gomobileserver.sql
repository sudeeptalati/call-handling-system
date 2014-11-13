
----
-- Table structure for engineer
----
CREATE TABLE 'engineer' ('id' INTEGER PRIMARY KEY NOT NULL, 'engineer_email' TEXT, 'pwd' TEXT, 'exp_date' DATETIME, 'created' DATETIME, 'last_modified' DATETIME);


----
-- Table structure for engineer_data
----
CREATE TABLE 'engineer_data' ('id' INTEGER PRIMARY KEY NOT NULL, 'engineer_email' TEXT, 'data' TEXT, 'data_status_id' INTEGER, 'created' DATETIME, 'last_modified' DATETIME);

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
COMMIT;
