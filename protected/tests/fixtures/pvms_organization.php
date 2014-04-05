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
	'sampleOrg'=>array(
		'id'=>'1',
		'name'=>'sampleOrgName',
                'desc'=>'sampleOrgDesc',
	),
);

