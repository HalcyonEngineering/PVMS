CREATE TABLE pvms_lookup
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(128) NOT NULL,
	code INTEGER NOT NULL,
	type VARCHAR(128) NOT NULL,
	position INTEGER NOT NULL
);

CREATE TABLE pvms_user
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL UNIQUE,
	location VARCHAR(32),
	skillset VARCHAR(256),
	causes VARCHAR(256),
    availability INTEGER NOT NULL DEFAULT 15,
	type VARCHAR(128) NOT NULL DEFAULT 2,
	adminAccess BOOLEAN NOT NULL DEFAULT 0,
	profile TEXT
);

CREATE TABLE pvms_organization
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  name VARCHAR(128) NOT NULL, -- Name
  desc TEXT NOT NULL -- Description
);

CREATE TABLE pvms_project
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  org_id INTEGER NOT NULL,
  name VARCHAR(128) NOT NULL,
  desc TEXT NOT NULL,
  colour VARCHAR(7) NOT NULL,
  target VARCHAR(10),
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE pvms_role
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  project_id INTEGER NOT NULL,
  name VARCHAR(128) NOT NULL,
  desc TEXT NOT NULL,
  colour VARCHAR(7) NOT NULL,
  CONSTRAINT FK_project FOREIGN KEY (project_id) REFERENCES pvms_project (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

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

CREATE TABLE pvms_skill
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(32) NOT NULL,
	frequency INTEGER DEFAULT 1
);

-- Various join tables.
CREATE TABLE pvms_user_organization
(
  user_id INTEGER NOT NULL,
  org_id INTEGER NOT NULL,
  PRIMARY KEY (user_id, org_id),
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE
);

CREATE TABLE pvms_user_role
(
  user_id INTEGER NOT NULL,
  role_id INTEGER NOT NULL,
  PRIMARY KEY (user_id, role_id),
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id) ON DELETE CASCADE
);

-- Table for Manager to Org mappings.
CREATE TABLE pvms_organization_manager
(
  user_id INTEGER NOT NULL UNIQUE,
  org_id INTEGER NOT NULL,
  PRIMARY KEY (user_id, org_id),
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id) ON DELETE CASCADE,
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE
);

-- Table for onboarding documents
CREATE TABLE pvms_onboarding
(
  role_id INTEGER NOT NULL PRIMARY KEY,
  onboarding_welcome VARCHAR(1024),
  onboarding_instructions VARCHAR(1024),
  onboarding_contact VARCHAR(1024),
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table for files
CREATE TABLE pvms_file
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  project_id INTEGER NOT NULL,
  file_name VARCHAR(256),
  file_size INTEGER,
  file_data BLOB,
  CONSTRAINT FK_project FOREIGN KEY (project_id) REFERENCES pvms_project (id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Draft', 'PostStatus', 1, 1);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Published', 'PostStatus', 2, 2);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Archived', 'PostStatus', 3, 3);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Pending Approval', 'CommentStatus', 1, 1);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Approved', 'CommentStatus', 2, 2);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Administrator', 'UserType', 0, 0);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Manager', 'UserType', 1, 1);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Volunteer', 'UserType', 2, 2);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('In Progress', 'TaskStatus', 1, 1);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Complete (Pending)', 'TaskStatus', 2, 2);
INSERT INTO pvms_lookup (name, type, code, position) VALUES ('Complete (Verified)', 'TaskStatus', 3, 3);

INSERT INTO pvms_user (name, password, email, type) VALUES ('demo','$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC','webmaster@example.com', 0);
INSERT INTO pvms_user (name, password, email, type) VALUES ('admin','$2a$10$xOHcdC9nHnzQeOYtw3jwUu1Nc87gDo9P9YGQYWLVQNMxJEZqZiL2y','admin', 0);
--pw for Sean is manager
INSERT INTO pvms_user (name, password, email, type) VALUES ('Sean Kennedy','$2a$12$asAXUgsB3jixPd7PA5qrBe1ptevmxrl3eb8J8VuIMJSRVYZok1V/m','sean@pitchn.ca', 1);
INSERT INTO pvms_user (name, password, email, type) VALUES ('manager2','$2a$12$MO94I98I9ts.psar1DoMBOxfKAZXciOPDwqUF4UJ8P5hua.my5EPO','manager2', 1);
INSERT INTO pvms_user (name, password, email, type) VALUES ('volunteer','$2a$12$J1n3OwZasqX3gsMG6TSzvOHEJleCYyWJ/TNAuxOmAoB/zmiBqskeq','volunteer', 2);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('6','David','$2a$13$dEoNvuwcQ/7xRSebI6tO6edjUTXKfElOjnZz7TK6ymhT3Z.cNb.0G','david@pitchn.ca','Surrey','Project Management, Web Development, Software Engineering',NULL, 15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('7','Kenneth','$2a$13$jn1wIc/PvXQMwdF6VRcKr.1vRzWPrjAyS4D..4tBkI5fHDAwUaMFe','kenneth@pitchn.ca','Richmond','Software Engineering, School',NULL,                        15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('8','Jon','$2a$13$cXjPfW2T3q/WUWsGo2tGe.xFjn1UH8VAG0qLtCS.lHOak8HE9yXjC','jon@pitchn.ca','Vancouver','Software Enginneering',NULL,                                      15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('9','Matt','$2a$13$7G9CXaXPM2BHMHWMnKWyD.RMZkQwYxUe4tHUg79VKeSkKdDalVUwO','matt@pitchn.ca','Vancouver','Software Engineering, Video Games',NULL,                        15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('10','Andy','$2a$13$SRvsTXfWXGDuLtYjDZlcVOVVa2Wjv.eXeHYQQXSwqEKMiNcvuUc9C','andy@pitchn.ca','Whiterock','Software Engineering',NULL,                                    15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('11','Phat','$2a$13$TDoAQfWsoD.9t54gTysg7efNlO4.8P07GDewLiigpjWG16Y9.XOt2','phat@pitchn.ca','Vancouver','Software Engineering, Parkour',NULL,                           15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('12','Deepak','$2a$13$TDoAQfWsoD.9t54gTysg7efNlO4.8P07GDewLiigpjWG16Y9.XOt2','dazad@gmail.com','Vancouver','Education',NULL,                                            15, '2','0',NULL);
--pw for Jenny is jenny
INSERT INTO pvms_user (name, password, email, type) VALUES ('Jenny', '$2a$12$BN7dwapvVqvDaBlRBQPYneNUFkMwdjhlRFNwrtcNKs80zuKt5vNvq', 'jenny@rec.ubc.ca', 1);
--pw for Jonathan is password
INSERT INTO pvms_user (name, password, email, type) VALUES ('Jonathan Wou', '$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC', 'jonathan@rec.ubc.ca', 1);

--Volunteers start
-- pw for Volunteers is password
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('15','Harry','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','harry@rec.ubc.ca','Vancouver','School',NULL,     15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('16','Billy','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','billy@rec.ubc.ca','Vancouver','School',NULL,     15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('17','Rex','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','rex@rec.ubc.ca','Vancouver','School',NULL,         15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('18','Joel','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','joel@rec.ubc.ca','Vancouver','School',NULL,       15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('19','Melissa','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','melissa@rec.ubc.ca','Vancouver','School',NULL, 15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('20','Gord','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','gord@rec.ubc.ca','Vancouver','School',NULL,       15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('21','Lucas','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','lucas@rec.ubc.ca','Vancouver','School',NULL,     15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('22','Emma','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','emma@rec.ubc.ca','Vancouver','School',NULL,       15, '2','0',NULL);
INSERT INTO "pvms_user" ("id","name","password","email","location","skillset","causes","availability","type","adminAccess","profile") VALUES ('23','Olivia','$2a$12$L7Bt02zTY.35HCHODI3IDecUTLWG.iEEC1njyIBqJf/ZJXPgbbMmC','olivia@rec.ubc.ca','Vancouver','School',NULL,   15, '2','0',NULL);
-- Volunteers end

-- Organizations
INSERT INTO pvms_organization (name, desc) VALUES ('Pitchn', 'This is Pitchn Solutions.');
INSERT INTO pvms_organization (name, desc) VALUES ('Test', 'Test organization');
INSERT INTO pvms_organization (name, desc) VALUES ('UBC REC', 'This is UBC Recreation');
INSERT INTO pvms_organization (name, desc) VALUES ('The Cave', 'This is Jons Organization.');


--Projects
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'Volunteer Management System', 'To be complete by multiple CPSC319 students at UBC','#FFFFFF');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'Sponsors', 'Ongoing project to obtain more sponsors','#000000');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'Website Relaunch', 'Redesign the Pitchn website.','#111111');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'Promotions', 'A project to promote Pitchn.','#222222');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'Networking', 'Creating new connections in the Startup Company.','#333333');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'Misc', 'Random roles and tasks to be completed','#444444');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (2,'First Project', 'First project created','#444444');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Soccer', 'Handley Cup Soccer League is great','#aaaaaa');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Futsal', 'SRC Futsal league still needs a name','#bbbbbb');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Ball Hockey', 'Bodin Ball Hockey league','#ababab');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Ice Hockey', 'Todd Ice Hockey league is great','#cdcdcd');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Basketball', 'Nitobe Basketball league','#dddddd');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Volleyball', 'Cross Volleyball has multiple leagues.','#121212');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Dodgeball', 'The is an amazing league to play.','#efefef');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Football', 'The Point Grey football league runs Sunday nights.','#000000');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Ultimate', 'The Ultimate league is not the ultimate league.','#22222');
INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (3,'Storm the Wall', 'Storm the wall is March 23-25th.','#2e2e2e');

--Project files
INSERT INTO pvms_file(project_id, file_name, file_size, file_data) VALUES(1,'example.txt',19,'This is an example.');
INSERT INTO pvms_file(project_id, file_name, file_size, file_data) VALUES(1,'example2.txt',24,'This is another example.');
INSERT INTO pvms_file(project_id, file_name, file_size, file_data) VALUES(1,'example3.txt',28,'This is yet another example.');

--Roles
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (1, 'Web Developer', 'First.', '#FFFFFF');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (1, 'PHP Programmer', 'First.', '#000000');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (1, 'Marketing Assistant', 'First.', '#111111');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (1, 'Sponsorship Assistant', 'First.', '#222222');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (6, 'First Role', 'First role created.', '#FFFFFF');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (16, 'Route Patrol', 'First role created.', '#FFFFFF');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (16, 'Wall Spotter', 'First role created.', '#000000');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (16, 'DJ && MC', 'First role created.', '#111111');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (16, 'Cycle Transition', 'First role created.', '#222222');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (16, 'Pool Transition', 'First role created.', '#333333');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Communications Assistant Director', 'First role created.', '#444444');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Media Assistant Director', 'First.', '#555555');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Eligibility Assistant Director', 'First.', '#666666');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Scheduling Assistant Director', 'First.', '#777777');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Social Assistant Director', 'First.', '#8888888');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Referee Development Assistant Director', 'First .', '#aaaaaa');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Referee CoordinatorAssistant Director', 'First .', '#bbbbbb');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (7, 'Community Assistant Director', 'First.', '#cccccc');

--Role onboarding pages
INSERT INTO pvms_onboarding(role_id, onboarding_welcome, onboarding_instructions, onboarding_contact) VALUES(1,'Welcome!', 'get work done', 'kimjongun@wpk.kp');
INSERT INTO pvms_onboarding(role_id, onboarding_welcome, onboarding_instructions, onboarding_contact) VALUES(1,'Welcome!', 'get work done', 'kimjongun@wpk.kp');
INSERT INTO pvms_onboarding(role_id, onboarding_welcome, onboarding_instructions, onboarding_contact) VALUES(1,'Welcome!', 'get work done', 'kimjongun@wpk.kp');

-- Tasks
INSERT INTO pvms_task(role_id, name, desc) VALUES(1, 'Create new UI', 'This task needs to be completed.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(4, 'Get Sponsorship', 'Contact smaller companies to get earn sponsorships.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(2, 'Update Database', 'Add more volunteers.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(3, 'Meet with Jason', 'Meeting is at Pitchn HQ in Downtown Vancouver on Monday at noon.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(2, 'Hand in documents', 'This task needs to be completed.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(5, 'A Task', 'Do stuff.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(5, 'Another Task', 'Do more.');
INSERT INTO pvms_task(role_id, name, desc) VALUES(5, 'Yet another Task', 'Do even more.');

--Organization and Manager Relationship
INSERT INTO pvms_organization_manager(user_id, org_id) VALUES (3, 1);
INSERT INTO pvms_organization_manager(user_id, org_id) VALUES (4, 2);
INSERT INTO pvms_organization_manager(user_id, org_id) VALUES (13, 3);
INSERT INTO pvms_organization_manager(user_id, org_id) VALUES (14, 4);

--Organziation and Volunteer Relationship
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('6','1');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('7','1');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('8','1');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('9','1');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('10','1');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('12','1');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('15','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('16','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('17','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('18','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('19','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('20','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('21','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('22','3');
INSERT INTO "pvms_user_organization" ("user_id","org_id") VALUES ('23','3');

INSERT INTO pvms_user_organization(user_id, org_id) VALUES (5,2);
INSERT INTO pvms_user_role(user_id, role_id) VALUES (5, 1);

CREATE TABLE pvms_csv(csv BLOB);
CREATE TABLE pvms_skill(skill NOT NULL PRIMARY KEY, frequency INTEGER DEFAULT 1);

--Skills
INSERT INTO pvms_skill (name) VALUES ('Accounting');
INSERT INTO pvms_skill (name) VALUES ('Advertising');
INSERT INTO pvms_skill (name) VALUES ('Branding');
INSERT INTO pvms_skill (name) VALUES ('Business Strategy');
INSERT INTO pvms_skill (name) VALUES ('Communications');
INSERT INTO pvms_skill (name) VALUES ('Copywriting');
INSERT INTO pvms_skill (name) VALUES ('Design');
INSERT INTO pvms_skill (name) VALUES ('Education');
INSERT INTO pvms_skill (name) VALUES ('Entrepreneurship');
INSERT INTO pvms_skill (name) VALUES ('Event Planning');
INSERT INTO pvms_skill (name) VALUES ('Finance');
INSERT INTO pvms_skill (name) VALUES ('Fundraising');
INSERT INTO pvms_skill (name) VALUES ('Human Resources');
INSERT INTO pvms_skill (name) VALUES ('Legal');
INSERT INTO pvms_skill (name) VALUES ('Marketing');
INSERT INTO pvms_skill (name) VALUES ('Multimedia');
INSERT INTO pvms_skill (name) VALUES ('Online Marketing');
INSERT INTO pvms_skill (name) VALUES ('Photography');
INSERT INTO pvms_skill (name) VALUES ('Project Management');
INSERT INTO pvms_skill (name) VALUES ('Public Relations');
INSERT INTO pvms_skill (name) VALUES ('Sales');
INSERT INTO pvms_skill (name) VALUES ('Social Media');
INSERT INTO pvms_skill (name) VALUES ('Technology');
INSERT INTO pvms_skill (name) VALUES ('Software Engineering');
INSERT INTO pvms_skill (name) VALUES ('School');

INSERT INTO pvms_skill (name) VALUES ('Parkour');
