<?php

/**
 * The following are the available columns in table '{{project}}':
 * @property integer $id // not null
 * @property integer $org_id // not null
 * @property string $name // not null
 * @property string $desc // not null
 * @property string $colour // not null
 * @property integer $target
 */
return array(
	// We can set aliases to database rows which makes it easier to call specific entries
	// in our test
	'sampleProject'=>array(
		"id"=>'1',
		"org_id"=>'1',
		"name"=>'Sample Project Name',
		"desc"=>'Sample Project Description',
		"colour"=>'#FF0000',
		"target"=>null,
	),
	'sampleProject2'=>array(
		"id"=>'2',
		"org_id"=>'2',
		"name"=>'Sample Project 2 Name',
		"desc"=>'Sample Project 2 Description',
		"colour"=>'#00FF00',
		"target"=>null,
	),
);
