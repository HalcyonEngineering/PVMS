<?php

/**
 * The following are the available columns in table '{{role}}':
 * @property integer $id // not null
 * @property integer $project_id // not null
 * @property string $name // not null
 * @property string $desc // not null
 * @property string $colour // not null
 */
return array(
	// We can set aliases to database rows which makes it easier to call specific entries
	// in our test
	'sampleRole'=>array(
		"id"=>'1',
		"project_id"=>'1',
		"name"=>'Sample Role 1 Name',
		"desc"=>'Sample Role 1 Description',
		"colour"=>'#FF0000',
	),
	'sampleRole2'=>array(
		"id"=>'2',
		"project_id"=>'2',
		"name"=>'Sample Role 2 Name',
		"desc"=>'Sample Role 2 Description',
		"colour"=>'#00FF00',
	),
	'sampleRole3'=>array(
		"id"=>'10',
		"project_id"=>'1',
		"name"=>'Sample Role 2 Name',
		"desc"=>'Sample Role 2 Description',
		"colour"=>'#00FF00',
	),
);
