<?php

$dbFile=dirname(__FILE__).'/pvms.sqlite';
$sqlFile=dirname(__FILE__).'/schema.sqlite.sql';

@unlink($dbFile);
$db=new PDO('sqlite:'.$dbFile);
$sqls=file_get_contents($sqlFile);
foreach(explode(';',$sqls) as $sql)
{
	if(trim($sql)!=='')
		$db->exec($sql);
}

echo "DB (probably) (re)generated successfully";