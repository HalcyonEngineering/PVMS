<?php

/**
 * The followings are the available columns in table '{{task}}':
 * @property integer $id // not null
 * @property integer $role_id // not null
 * @property string $name // not null
 * @property string $desc
 * @property integer $expected
 * @property integer $actual
 * @property integer $status // not null (default 1)
 */
return array(
	// We can set aliases to database rows which makes it easier to call specific entries
	// in our test
	'sampleTask'=>array(
		"id"=>'1',
		"role_id"=>'10',
		"name"=>'Sample Task Name',
		"desc"=>'sampleTaskDesc',
		"expected"=>null,
		"actual"=>null,
		"status"=>Task::STATUS_IN_PROGRESS,
	),
	'sampleTask2'=>array(
		"id"=>'2',
		"role_id"=>'20',
		"name"=>'Sample Task 2 Name',
		"desc"=>'sampleTask2Desc',
		"expected"=>null,
		"actual"=>null,
		"status"=>Task::STATUS_IN_PROGRESS,
	),
);
