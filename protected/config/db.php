<?php
// comment the following to disable the sqlite database
return array(
			'connectionString' => 'sqlite:protected/data/pvms.sqlite',
			'tablePrefix' => 'pvms_',
			'initSQLs'=>array(
				// Enable foreign key support.
				'PRAGMA foreign_keys = ON',
			),
			'enableParamLogging'=>true,
		);
// uncomment the following to use a MySQL database		
/*
return array(
	'connectionString' => 'mysql:host=localhost;dbname=blog',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'tablePrefix' => 'tbl_',
);
*/
?>
