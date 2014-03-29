<?php

$dbFile=dirname(__FILE__).'/pvms.sqlite';
$testdbFile=dirname(__FILE__).'/test-pvms.sqlite';
$sqlFile=dirname(__FILE__).'/schema.sqlite.sql';

@unlink($dbFile);
$db=new PDO('sqlite:'.$dbFile);
$sqls=file_get_contents($sqlFile);
foreach(explode(';',$sqls) as $sql)
{
	if(trim($sql)!=='')
		$db->exec($sql);
}

@unlink($testdbFile);
$db=new PDO('sqlite:'.$testdbFile);
$sqls=file_get_contents($sqlFile);
foreach(explode(';',$sqls) as $sql)
{
	if(trim($sql)!=='')
		$db->exec($sql);
}
echo "DB (probably) (re)generated successfully";