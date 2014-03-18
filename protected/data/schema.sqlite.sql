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
INSERT INTO pvms_user (name, password, email, type) VALUES ('manager','$2a$12$asAXUgsB3jixPd7PA5qrBe1ptevmxrl3eb8J8VuIMJSRVYZok1V/m','manager', 1);
INSERT INTO pvms_user (name, password, email, type) VALUES ('manager2','$2a$12$MO94I98I9ts.psar1DoMBOxfKAZXciOPDwqUF4UJ8P5hua.my5EPO','manager2', 1);
INSERT INTO pvms_user (name, password, email, type) VALUES ('volunteer','$2a$12$J1n3OwZasqX3gsMG6TSzvOHEJleCYyWJ/TNAuxOmAoB/zmiBqskeq','volunteer', 2);

INSERT INTO pvms_organization (name, desc) VALUES ('First Org', 'We are the first here.');
INSERT INTO pvms_organization (name, desc) VALUES ('Second Org', 'We did not finish first.');

INSERT INTO pvms_project(org_id, name, desc, colour) VALUES (1,'First Project', 'First project created.','#FFFFFF');
INSERT INTO pvms_role(project_id, name, desc, colour) VALUES (1, 'First Role', 'First role created.', '#FFFFFF');
INSERT INTO pvms_task(role_id, name, desc) VALUES(1, 'First Task', 'First task created.');

INSERT INTO pvms_onboarding(role_id, onboarding_welcome, onboarding_instructions, onboarding_contact) VALUES(1,'Welcome!', 'get work done', 'kimjongun@wpk.kp');
INSERT INTO pvms_file(project_id, file_name, file_size, file_data) VALUES(1,'example.txt',19,'This is an example.');

INSERT INTO pvms_organization_manager(user_id, org_id) VALUES (3, 1);
INSERT INTO pvms_organization_manager(user_id, org_id) VALUES (4, 2);
INSERT INTO pvms_user_organization(user_id, org_id) VALUES (5,1);
INSERT INTO pvms_user_role(user_id, role_id) VALUES (5, 1);

CREATE TABLE pvms_csv(csv BLOB);
CREATE TABLE pvms_skill(skill NOT NULL PRIMARY KEY, frequency INTEGER DEFAULT 1);

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
INSERT INTO pvms_skill (name) VALUES ('Web Development');