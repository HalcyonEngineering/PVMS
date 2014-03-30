PRAGMA foreign_keys = ON;
----
-- Table structure for pvms_lookup
----
CREATE TABLE pvms_lookup
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(128) NOT NULL,
	code INTEGER NOT NULL,
	type VARCHAR(128) NOT NULL,
	position INTEGER NOT NULL
);

INSERT INTO "pvms_lookup" ("id","name","code","type","position") VALUES ('1','Administrator','0','UserType','0');
INSERT INTO "pvms_lookup" ("id","name","code","type","position") VALUES ('2','Manager','1','UserType','1');
INSERT INTO "pvms_lookup" ("id","name","code","type","position") VALUES ('3','Volunteer','2','UserType','2');
INSERT INTO "pvms_lookup" ("id","name","code","type","position") VALUES ('4','In Progress','1','TaskStatus','1');
INSERT INTO "pvms_lookup" ("id","name","code","type","position") VALUES ('5','Complete (Pending)','2','TaskStatus','2');
INSERT INTO "pvms_lookup" ("id","name","code","type","position") VALUES ('6','Complete (Verified)','3','TaskStatus','3');

----
-- Table structure for pvms_user
----
CREATE TABLE pvms_user
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL UNIQUE,
	location VARCHAR(32),
	skillset VARCHAR(256),
	causes VARCHAR(256),
  availability INTEGER NOT NULL DEFAULT 3,
	type VARCHAR(128) NOT NULL DEFAULT 2
);

----
-- Table structure for pvms_organization
----
CREATE TABLE pvms_organization
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  name VARCHAR(128) NOT NULL, -- Name
  desc TEXT NOT NULL -- Description
);

----
-- Table structure for pvms_project
----
CREATE TABLE pvms_project
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  org_id INTEGER NOT NULL,
  name VARCHAR(128) NOT NULL,
  desc TEXT NOT NULL,
  colour VARCHAR(7) NOT NULL,
  target INTEGER,
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

----
-- Table structure for pvms_role
----
CREATE TABLE pvms_role
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  project_id INTEGER NOT NULL,
  name VARCHAR(128) NOT NULL,
  desc TEXT NOT NULL,
  colour VARCHAR(7) NOT NULL,
  CONSTRAINT FK_project FOREIGN KEY (project_id) REFERENCES pvms_project (id) ON DELETE CASCADE ON UPDATE RESTRICT
);


----
-- Table structure for pvms_task
----
CREATE TABLE pvms_task
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  role_id INTEGER NOT NULL,
	name VARCHAR(128) NOT NULL,
	desc TEXT,
	expected INTEGER,
	actual INTEGER,
  status INTEGER NOT NULL DEFAULT 1,
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id) ON DELETE CASCADE ON UPDATE RESTRICT
);


----
-- Table structure for pvms_notification
----
CREATE TABLE pvms_notification
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	user_id INTEGER NOT NULL,
	description VARCHAR(128) NOT NULL,
	timestamp INTEGER NOT NULL DEFAULT CURRENT_TIMESTAMP,
	link VARCHAR(128) NOT NULL,
	read_status INTEGER NOT NULL DEFAULT 0,
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE
);

----
-- Table structure for pvms_message
----
CREATE TABLE pvms_message
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	user_id INTEGER NOT NULL,
	sender_id  INTEGER NOT NULL,
	message_subject VARCHAR(128) NOT NULL,
	message_body VARCHAR(128) NOT NULL,
	timestamp INTEGER NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_sender FOREIGN KEY (sender_id) REFERENCES pvms_user (id) ON DELETE CASCADE
);

----
-- Table structure for pvms_skill
----
CREATE TABLE pvms_skill
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(32) NOT NULL,
	frequency INTEGER DEFAULT 1
);

INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('1','Accounting','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('2','Advertising','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('3','Branding','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('4','Business Strategy','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('5','Communications','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('6','Copywriting','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('7','Design','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('9','Entrepreneurship','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('10','Event Planning','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('11','Finance','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('12','Fundraising','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('13','Human Resources','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('14','Legal','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('15','Marketing','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('16','Multimedia','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('17','Online Marketing','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('18','Photography','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('19','Project Management','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('20','Public Relations','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('21','Sales','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('22','Social Media','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('23','Technology','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('24','Software Engineering','1');
INSERT INTO "pvms_skill" ("id","name","frequency") VALUES ('26','Parkour','1');

----
-- Table structure for pvms_location
----
CREATE TABLE pvms_location
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(32) NOT NULL,
	frequency INTEGER DEFAULT 1
);

INSERT INTO "pvms_location" ("id","name","frequency") VALUES ('1','Surrey','1');
INSERT INTO "pvms_location" ("id","name","frequency") VALUES ('2','Whiterock','1');
INSERT INTO "pvms_location" ("id","name","frequency") VALUES ('3','Richmond','1');
INSERT INTO "pvms_location" ("id","name","frequency") VALUES ('4','Vancouver','1');

----
-- Table structure for pvms_user_organization
----
CREATE TABLE pvms_user_organization
(
  user_id INTEGER NOT NULL,
  org_id INTEGER NOT NULL,
  PRIMARY KEY (user_id, org_id),
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE
);


----
-- Table structure for pvms_user_role
----
CREATE TABLE pvms_user_role
(
  user_id INTEGER NOT NULL,
  role_id INTEGER NOT NULL,
  PRIMARY KEY (user_id, role_id),
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id) ON DELETE CASCADE
);

----
-- Table structure for pvms_organization_manager
----
CREATE TABLE pvms_organization_manager
(
  user_id INTEGER NOT NULL UNIQUE,
  org_id INTEGER NOT NULL,
  PRIMARY KEY (user_id, org_id),
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE
);

----
-- Table structure for pvms_onboarding
----
CREATE TABLE pvms_onboarding
(
  role_id INTEGER NOT NULL PRIMARY KEY,
  onboarding_welcome VARCHAR(1024),
  onboarding_instructions VARCHAR(1024),
  onboarding_contact VARCHAR(1024),
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id) ON DELETE CASCADE ON UPDATE CASCADE
);


----
-- Table structure for pvms_file
----
CREATE TABLE pvms_file
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  project_id INTEGER NOT NULL,
  file_name VARCHAR(256),
  file_size INTEGER,
  file_data BLOB,
  CONSTRAINT FK_project FOREIGN KEY (project_id) REFERENCES pvms_project (id) ON DELETE CASCADE ON UPDATE CASCADE
);


----
-- Table structure for pvms_passwordreset
----
CREATE TABLE pvms_passwordreset
(
	user_id INTEGER NOT NULL PRIMARY KEY,
	hash VARCHAR(128) NOT NULL,
	timestamp INTEGER NOT NULL DEFAULT (datetime('now')),
	expiry INTEGER NOT NULL DEFAULT (datetime('now', '+60 Minute')),
	CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE
);

----
-- Table structure for pvms_csv
----
CREATE TABLE pvms_csv(csv BLOB);


INSERT INTO pvms_organization("id", "name", "desc") VALUES ('1', '<script> alert("Bad security");</script>', '<script> alert("Bad security");</script>');
INSERT INTO pvms_project("id", "org_id", "name", "desc", "colour") VALUES ('1', '1', '<script> alert("Bad security");</script>', '<script> alert("Bad security");</script>', '#FF0000');
INSERT INTO pvms_role("id", "project_id", "name", "desc", "colour") VALUES ('1', '1', '<script> alert("Bad security");</script>', '<script> alert("Bad security");</script>', '#FF0000');
INSERT INTO pvms_task("id", "role_id", "name", "desc", "expected", "actual", "status") VALUES ('1', '1', '<script> alert("Bad security");</script>', '<script> alert("Bad security");</script>', '3', '3', '3');
INSERT INTO pvms_onboarding("role_id", "onboarding_welcome", "onboarding_instructions", "onboarding_contact") VALUES (1, '<script> alert("Bad security");</script>', '<script> alert("Bad security");</script>', '<script> alert("Bad security");</script>');
INSERT INTO pvms_user ("id", "name", "password", "email", "type") VALUES ('1', 'Security','$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC','webmaster@example.com', 1);
INSERT INTO pvms_organization_manager("user_id", "org_id") VALUES ('1', '1');


INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('2','Jason Tseng','$2a$10$xOHcdC9nHnzQeOYtw3jwUu1Nc87gDo9P9YGQYWLVQNMxJEZqZiL2y','admin@pitchn.ca',NULL,NULL,NULL,'3','0');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('3','Sean Kennedy','$2a$12$asAXUgsB3jixPd7PA5qrBe1ptevmxrl3eb8J8VuIMJSRVYZok1V/m','manager@pitchn.ca',NULL,NULL,NULL,'3','1');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('5','John Smith','$2a$12$NS9M0uomSPLp.E7KbBSW7Oapf5rbFTqaE.1aKqmdXD5PYTWN2UMXG','volunteer@pitchn.ca','Surrey','Project Management, Web Development',NULL,'3','2');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('6','David Li','$2a$13$dEoNvuwcQ/7xRSebI6tO6edjUTXKfElOjnZz7TK6ymhT3Z.cNb.0G','david@pitchn.ca','Surrey','Project Management, Web Development, Software Engineering',NULL,'3','2');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('7','Kenneth Shen','$2a$13$jn1wIc/PvXQMwdF6VRcKr.1vRzWPrjAyS4D..4tBkI5fHDAwUaMFe','kenneth@pitchn.ca','Richmond','Software Engineering, School',NULL,'3','2');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('8','Jon Wou','$2a$13$cXjPfW2T3q/WUWsGo2tGe.xFjn1UH8VAG0qLtCS.lHOak8HE9yXjC','jon@pitchn.ca','Vancouver','Software Engineering',NULL,'3','2');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('9','Matt Arnold','$2a$13$7G9CXaXPM2BHMHWMnKWyD.RMZkQwYxUe4tHUg79VKeSkKdDalVUwO','matt@pitchn.ca','Vancouver','Software Engineering, Video Games',NULL,'3','2');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('10','Andy Wang','$2a$13$SRvsTXfWXGDuLtYjDZlcVOVVa2Wjv.eXeHYQQXSwqEKMiNcvuUc9C','andy@pitchn.ca','Whiterock','Software Engineering',NULL,'3','2');
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type") VALUES ('11','Phattrick Tran','$2a$13$TDoAQfWsoD.9t54gTysg7efNlO4.8P07GDewLiigpjWG16Y9.XOt2','phat@pitchn.ca','Vancouver','Software Engineering, Parkour',NULL,'3','2');


INSERT INTO "pvms_organization" ("id","name","desc") VALUES ('2','Pitchn','This is Pitchn Solutions.');

INSERT INTO "pvms_organization_manager" ("user_id","org_id") VALUES ('3','2');

INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('6','2');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('7','2');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('8','2');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('9','2');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('10','2');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('11','2');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('5','2');
INSERT INTO "pvms_user_organization" ("user_id", "org_id") VALUES ('5', '1');

INSERT INTO "pvms_project" ("id","org_id","name","desc","colour","target") VALUES ('2','2','Volunteer Management System','To be complete by multiple CPSC319 students at UBC','#1AAB9F',NULL);
INSERT INTO "pvms_project" ("id","org_id","name","desc","colour","target") VALUES ('3','2','Sponsors','Ongoing project to obtain more sponsors','#009933',NULL);
INSERT INTO "pvms_project" ("id","org_id","name","desc","colour","target") VALUES ('4','2','Website Relaunch','Redesign the Pitchn website.','#FF6600',NULL);
INSERT INTO "pvms_project" ("id","org_id","name","desc","colour","target") VALUES ('5','2','Promotions','A project to promote Pitchn.','#FF0000',NULL);
INSERT INTO "pvms_project" ("id","org_id","name","desc","colour","target") VALUES ('6','2','Networking','Creating new connections in the Startup Company.','#2EFE2E',NULL);
INSERT INTO "pvms_project" ("id","org_id","name","desc","colour","target") VALUES ('7','2','Misc','Random roles and tasks to be completed','#0404B4',NULL);

INSERT INTO "pvms_role" ("id","project_id","name","desc","colour") VALUES ('2','2','Web Developer','First.','#CC9900');
INSERT INTO "pvms_role" ("id","project_id","name","desc","colour") VALUES ('3','2','PHP Programmer','First.','#009933');
INSERT INTO "pvms_role" ("id","project_id","name","desc","colour") VALUES ('4','2','Marketing Assistant','First.','#FF0000');
INSERT INTO "pvms_role" ("id","project_id","name","desc","colour") VALUES ('5','2','Sponsorship Assistant','First.','#2EFE2E');
INSERT INTO "pvms_role" ("id","project_id","name","desc","colour") VALUES ('6','7','First Role','First role created.','#81F7F3');

INSERT INTO "pvms_onboarding" ("role_id","onboarding_welcome","onboarding_instructions","onboarding_contact") VALUES ('2','Welcome!','get work done','david.d.li@gmail.com');
INSERT INTO "pvms_onboarding" ("role_id","onboarding_welcome","onboarding_instructions","onboarding_contact") VALUES ('3','Welcome!','get work done','david.d.li@gmail.com');
INSERT INTO "pvms_onboarding" ("role_id","onboarding_welcome","onboarding_instructions","onboarding_contact") VALUES ('4','Welcome!','get work done','david.d.li@gmail.com');
INSERT INTO "pvms_onboarding" ("role_id","onboarding_welcome","onboarding_instructions","onboarding_contact") VALUES ('5','Welcome!','get work done','david.d.li@gmail.com');
INSERT INTO "pvms_onboarding" ("role_id","onboarding_welcome","onboarding_instructions","onboarding_contact") VALUES ('6','Welcome!','get work done','david.d.li@gmail.com');

INSERT INTO "pvms_user_role" ("user_id","role_id") VALUES ('5','2');


INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('2','2','Create new UI','This task needs to be completed.',NULL,NULL,'2');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('3','5','Get Sponsorship','Contact smaller companies to get earn sponsorships.',NULL,NULL,'3');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('4','3','Update Database','Add more volunteers.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('5','4','Meet with Jason','Meeting is at Pitchn HQ in Downtown Vancouver on Monday at noon.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('6','3','Hand in documents','This task needs to be completed.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('7','6','A Task','Do stuff.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('8','6','Another Task','Do more.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('9','6','Yet another Task','Do even more.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('10','2','Make calls to database','Make call to the database before another Web Developer does.',NULL,NULL,'1');
INSERT INTO "pvms_task" ("id","role_id","name","desc","expected","actual","status") VALUES ('11','2','Meeting with client','This task needs to be completed.',NULL,NULL,'3');


INSERT INTO "pvms_file" ("id","project_id","file_name","file_size","file_data") VALUES ('1','2','example.txt','19','This is an example.');
INSERT INTO "pvms_file" ("id","project_id","file_name","file_size","file_data") VALUES ('2','2','example2.txt','24','This is another example.');
INSERT INTO "pvms_file" ("id","project_id","file_name","file_size","file_data") VALUES ('3','2','example3.txt','28','This is yet another example.');
