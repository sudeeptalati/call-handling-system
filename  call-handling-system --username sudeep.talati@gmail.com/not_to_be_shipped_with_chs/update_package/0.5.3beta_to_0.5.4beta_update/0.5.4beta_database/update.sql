/************** ADVANCE SETTINGS *******************/
CREATE TABLE "advance_settings" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "parameter" TEXT, "value" TEXT, "name" TEXT);
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('1','ftp_url','rapportsoftware.co.uk','Ftp Ur');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('2','ftp_username','kwatt','Ftp Username');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('3','ftp_password','#l1th1um!','Ftp Password');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('4','ftp_port','','Ftp Port');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('5','livecall_max_calls','10','Livecall Max Calls');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('6','livecall_max_day_distance','500','Livecall Max Distance');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('7','livecall_max_day_traveltime','500','Livecall Max Travell time');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('10001','internet_connected','1','Internet Available');
INSERT INTO advance_settings (id,parameter,value,name) VALUES ('10002','warranty_notification','1','Warranty Notification');
/****** DROPPING EXCESS OLD TABLES *******/
DROP TABLE IF EXISTS old_contact_details;
DROP TABLE IF EXISTS old_contract;
DROP TABLE IF EXISTS old_contract_type;
DROP TABLE IF EXISTS old_customer;
DROP TABLE IF EXISTS old_engineer;
DROP TABLE IF EXISTS old_job_status;
DROP TABLE IF EXISTS old_product;
DROP TABLE IF EXISTS old_product_type;
DROP TABLE IF EXISTS old_servicecall;
DROP TABLE IF EXISTS old_spares_used;
DROP TABLE IF EXISTS old_user;
DROP TABLE IF EXISTS old_enggdiary;
DROP TABLE IF EXISTS old_brand;
DROP TABLE IF EXISTS config;
/********** COUNTRY CODES *************/
CREATE TABLE "country_codes" ("id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , "iso2" TEXT, "short_name" TEXT, "long_name" TEXT, "iso3" TEXT, "numcode" TEXT, "un_member" TEXT, "calling_code" TEXT, "cctld" TEXT);
INSERT INTO country_codes (id,iso2,short_name,long_name,iso3,numcode,un_member,calling_code,cctld) VALUES ('1','GB','United Kingdom','United Kingdom of Great Britain and Nothern Ireland','GBR','826','yes','44','.uk');
INSERT INTO country_codes (id,iso2,short_name,long_name,iso3,numcode,un_member,calling_code,cctld) VALUES ('2','IN','India','Republic of India','IND','356','yes','91','.in');
INSERT INTO country_codes (id,iso2,short_name,long_name,iso3,numcode,un_member,calling_code,cctld) VALUES ('3','US, CA','United States, Canada','United States of America, Canada','USA, CAN','840, 124','yes','1','.us, .ca');
/********** DROPPING FTP SETTINGS TABLE ************/
DROP TABLE ftp_settings;
/********** DROPPING SPARES USED STATUS TABLE ************/
DROP TABLE spares_used_status;
/*********** TASKS TO DO TABLE ***************/
CREATE TABLE tasks_to_do(id INTEGER PRIMARY KEY NOT NULL, task TEXT, status TEXT, msgbody TEXT, subject TEXT, send_to TEXT, created DATETIME, scheduled DATETIME, executed DATETIME, finished DATETIME);
/************ ADDING COUNTRY ID FELID IN SETUP AND SAVING COUNTRY_COES ID IN SETUP TABLE******************/
ALTER TABLE "setup" RENAME TO 'old_setup';
CREATE TABLE "setup" ("id" INTEGER PRIMARY KEY  NOT NULL ,"company" TEXT,"address" TEXT,"town" TEXT,"postcode_s" TEXT,"postcode_e" TEXT,"county" TEXT,"country_id" INTEGER,"email" TEXT,"telephone" TEXT,"mobile" TEXT,"alternate" TEXT,"fax" TEXT,"postcodeanywhere_account_code" TEXT,"postcodeanywhere_license_key" TEXT,"website" TEXT,"vat_reg_no" TEXT,"company_number" TEXT,"postcode" TEXT,"version_update_url" TEXT,"live_booking_id" INTEGER);
INSERT INTO setup SELECT id,company,address,town,postcode_s,postcode_e,county,1,email,telephone,mobile,alternate,fax,postcodeanywhere_account_code,postcodeanywhere_license_key,website,vat_reg_no,company_number,postcode,version_update_url,live_booking_id FROM old_setup;
DROP TABLE IF EXISTS old_setup;
/*************** INSERTING DEFAULT NOT KNOWN ID CHANGRED TO 1000000 **************/
INSERT INTO brand (id,name,information,active,created_by_user_id,created,modified,inactivated,server_brand_id) VALUES ('1000000','Not Known','Not Known','1','1','','1369920176','','1000000');
INSERT INTO contact_details (id,address_line_1,address_line_2,address_line_3,town,postcode_s,postcode_e,postcode,county,state,country,latitudes,longitudes,mobile,telephone,fax,email,website,created,lockcode) VALUES ('1000000','N/A','N/A','','N/A','N/A','N/A','N/A N/A','','','','','','N/A','N/A','','N/A','','1366114663','0');
INSERT INTO contract (id,contract_type_id,name,main_contact_details_id,vat_reg_number,notes,active,inactivated_by_user_id,inactivated_on,created_by_user_id,created,modified,management_contact_details,spares_contact_details,accounts_contact_details,technical_contact_details,short_name,labour_warranty_months_duration,parts_warranty_months_duration) VALUES ('1000000','1000000','Unknown Contract','1000000','','','1','','','1','1350473939','','Same as main contact','Same as main contact','Same as main contact','Same as main contact','UnknownContract','','');
INSERT INTO contract_type (id,name,information,created_by_user_id,created) VALUES ('1000000','Unknown','N/A','1','1353405391');
INSERT INTO product_type (id,name,information,created_by_user_id,created,modified,server_product_type_id) VALUES ('1000000','Not Known','Not Known','1','','1366385057','1000000');
INSERT INTO 'user' (id,name,username,password,email,profile,created,modified,usergroup_id) VALUES ('1000000','remote_user','Remote User','9c31965dc0f4c2d4f37853f30b0aeab3bac6ba13a1dbe1baf
7193c65ad8ae67e','r@gmail.com','This id will be used in remote call booking.System user NOT TO BE DELETED','1371205873','','0');
INSERT INTO engineer (id,first_name,last_name,active,company,vat_reg_number,notes,inactivated_by_user_id,inactivated_on,contact_details_id,delivery_contact_details_id,created_by_user_id,created,modified,fullname) VALUES ('90000000','Not ','Assigned','0','Not Assigned','N/A','Not Known','','','1000000','1000000','2','1366114663','','Not Assigned');
ALTER TABLE product_type ADD active INTEGER;
ALTER TABLE product_type ADD inactivated DATETIME;
ALTER TABLE contract ADD labour_warranty_months_duration INTEGER;
ALTER TABLE contract ADD parts_warranty_months_duration INTEGER;
INSERT INTO contract (id,contract_type_id,name,main_contact_details_id,vat_reg_number,notes,active,inactivated_by_user_id,inactivated_on,created_by_user_id,created,modified,management_contact_details,spares_contact_details,accounts_contact_details,technical_contact_details,short_name,labour_warranty_months_duration,parts_warranty_months_duration) VALUES ('1000000','1000000','Unknown Contract','1000000','','','1','','','1','1350473939','','Same as main contact','Same as main contact','Same as main contact','Same as main contact','UnknownContract','','');