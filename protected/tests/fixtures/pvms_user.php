<?php
// Fixture are essentially arrays of rows which represent entries in a database table
// Before every unit test, the fixture manager will clear the test database and restore it
// to a state with entries listed in the fixture

// Note that the file names for fixtures is the same as the table name in the database
// hence, pvms_user.php, in the case of this fixture
// If we wanted to create the organization database we would make a file called
// pvms_organization.php

return array(
	// We can set aliases to database rows which makes it easier to call specific entries
	// in our test
	'sampleUser'=>array(
		"id"=>'1',
		"name"=>'Jason Tseng',
		"password"=>'$2a$10$xOHcdC9nHnzQeOYtw3jwUu1Nc87gDo9P9YGQYWLVQNMxJEZqZiL2y',
		"email"=>'admin@pitchn.ca',
		"location"=>null,
		"skillset"=>null,
		"causes"=>null,
		"availability"=>'3',
		"type"=>'0',
		"phoneNumber"=>null,
		"address"=>null,
		"status"=>'0',
	),
	'sampleUser2'=>array(
		"id"=>'2',
		"name"=>'John Tseng',
		"password"=>'$2a$10$xOHcdC9nHnzQeOYtw3jwUu1Nc87gDo9P9YGQYWLVQNMxJEZqZiL2y',
		"email"=>'manager@pitchn.ca',
		"location"=>null,
		"skillset"=>null,
		"causes"=>null,
		"availability"=>'3',
		"type"=>'1',
		"phoneNumber"=>null,
		"address"=>null,
		"status"=>'0',
	),
		'sampleUser3'=>array(
		"id"=>'3',
		"name"=>'Volun Teer',
		"password"=>'$2a$10$xOHcdC9nHnzQeOYtw3jwUu1Nc87gDo9P9YGQYWLVQNMxJEZqZiL2y',
		"email"=>'volunteer@pitchn.ca',
		"location"=>null,
		"skillset"=>null,
		"causes"=>null,
		"availability"=>'3',
		"type"=>'2',
		"phoneNumber"=>null,
		"address"=>null,
		"status"=>'0',
	)
);

