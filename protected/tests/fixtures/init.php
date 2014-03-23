<?php

$dbFile=dirname(__FILE__).'/../../data/pvms-test.sqlite';
$sqlFile=dirname(__FILE__).'/../../data/schema.sqlite.sql';

@unlink($dbFile);
$db=new PDO('sqlite:'.$dbFile);
$sqls=file_get_contents($sqlFile);
foreach(explode(';',$sqls) as $sql)
{
	if(trim($sql)!=='')
		$db->exec($sql);
}