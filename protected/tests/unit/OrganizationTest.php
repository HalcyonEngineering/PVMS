<?php

class OrganizationTest extends CDbTestCase
{
	public function testDb()
	{
		$model = Organization::model()->findByPk(1);
		$this->assertEquals($model->name, "Pitchn");
	}
}
