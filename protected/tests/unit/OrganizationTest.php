<?php

class OrganizationTest extends CDbTestCase
{
	public $fixtures=array();
	
	public function testDb()
	{
		$model = Organization::model()->findByPk(1);
		$this->assertEquals($model->name, "Pitchn");
	}
	
	public function testManagerDeletion()
	{
		$model = Organization::model()->findByPk(1);
		$this->assertEquals($model->name, "Pitchn");
		$manageremail = $model->getManager()->email;
		$model->delete();
		$this->assertEquals(User::model()->findByAttributes(array('email'=>'sean@pitchn.ca')), null);
		
	}
}
