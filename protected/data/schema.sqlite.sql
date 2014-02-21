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
	type VARCHAR(128) NOT NULL DEFAULT 2,
	profile TEXT
);

CREATE TABLE pvms_post
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	title VARCHAR(128) NOT NULL,
	content TEXT NOT NULL,
	tags TEXT,
	status INTEGER NOT NULL,
	create_time INTEGER,
	update_time INTEGER,
	author_id INTEGER NOT NULL,
	CONSTRAINT FK_post_author FOREIGN KEY (author_id)
		REFERENCES pvms_user (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE pvms_comment
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	content TEXT NOT NULL,
	status INTEGER NOT NULL,
	create_time INTEGER,
	author VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	url VARCHAR(128),
	post_id INTEGER NOT NULL,
	CONSTRAINT FK_comment_post FOREIGN KEY (post_id)
		REFERENCES pvms_post (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE pvms_tag
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  name VARCHAR(128) NOT NULL,
  frequency INTEGER DEFAULT 1
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
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id) ON DELETE CASCADE
);

CREATE TABLE pvms_role
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  proj_id INTEGER NOT NULL,
  name VARCHAR(128) NOT NULL,
  desc TEXT NOT NULL,
  CONSTRAINT FK_proj FOREIGN KEY (proj_id) REFERENCES pvms_project (id) ON DELETE CASCADE
);

CREATE TABLE pvms_task
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  role_id INTEGER NOT NULL,
	name VARCHAR(128) NOT NULL,
	desc TEXT,
	expected INTEGER,
	actual INTEGER,
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id) ON DELETE CASCADE
);

CREATE TABLE notifications
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	user_id VARCHAR(128) NOT NULL,
	description VARCHAR(128) NOT NULL,
	timestamp INTEGER NOT NULL DEFAULT CURRENT_TIMESTAMP,
	source VARCHAR(128) NOT NULL,
	link VARCHAR(128) NOT NULL,
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_role (id) ON DELETE CASCADE
);

CREATE TABLE messages
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	user_id VARCHAR(128) NOT NULL,
	sender_id VARCHAR(128) NOT NULL,
	message_subject VARCHAR(128) NOT NULL,
	message_body VARCHAR(128) NOT NULL,
	timestamp INTEGER NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_role (id) ON DELETE CASCADE
	CONSTRAINT FK_user FOREIGN KEY (sender_id) REFERENCES pvms_role (id) ON DELETE CASCADE
);

--I have no idea if these are correct so I'm doing it the way I taught myself.


CREATE TABLE pvms_org_proj
(
  org_id INTEGER NOT NULL,
  proj_id INTEGER NOT NULL UNIQUE,
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id),
  CONSTRAINT FK_proj FOREIGN KEY (proj_id) REFERENCES pvms_project (id)
);

CREATE TABLE pvms_proj_role
(
  proj_id INTEGER NOT NULL,
  role_id INTEGER NOT NULL UNIQUE,
  CONSTRAINT FK_proj FOREIGN KEY (proj_id) REFERENCES pvms_project (id),
  CONSTRAINT FK_role FOREIGN KEY  (role_id) REFERENCES pvms_role (id)
);

CREATE TABLE pvms_role_task
(
  role_id INTEGER NOT NULL,
  task_id INTEGER NOT NULL UNIQUE,
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id),
  CONSTRAINT FK_task FOREIGN KEY (task_id) REFERENCES pvms_task (id)
);

CREATE TABLE pvms_user_org
(
  user_id INTEGER NOT NULL,
  org_id INTEGER NOT NULL,
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id),
  CONSTRAINT FK_org FOREIGN KEY (org_id) REFERENCES pvms_organization (id)
);

CREATE TABLE pvms_user_role
(
  user_id INTEGER NOT NULL,
  role_id INTEGER NOT NULL,
  CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES pvms_user (id),
  CONSTRAINT FK_role FOREIGN KEY (role_id) REFERENCES pvms_role (id)
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
INSERT INTO pvms_user (name, password, email, type) VALUES ('admin','$2a$10$xOHcdC9nHnzQeOYtw3jwUu1Nc87gDo9P9YGQYWLVQNMxJEZqZiL2y','admin', 2);

INSERT INTO pvms_post (title, content, status, create_time, update_time, author_id, tags) VALUES ('Welcome!','This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.

Feel free to try this system by writing new posts and leaving comments.',2,1230952187,1230952187,1,'yii, blog');
INSERT INTO pvms_post (title, content, status, create_time, update_time, author_id, tags) VALUES ('A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2,1230952187,1230952187,1,'test');

INSERT INTO pvms_comment (content, status, create_time, author, email, post_id) VALUES ('This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', 2);

INSERT INTO pvms_tag (name) VALUES ('yii');
INSERT INTO pvms_tag (name) VALUES ('blog');
INSERT INTO pvms_tag (name) VALUES ('test');

INSERT INTO pvms_organization (name, desc) VALUES ('First Org', 'We are the first here.');
INSERT INTO pvms_organization (name, desc) VALUES ('Second Org', 'We did not finish first.');
