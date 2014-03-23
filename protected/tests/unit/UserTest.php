<?php
ob_start();

class UserTest extends CDbTestCase
{
	public function testLoginUser() {
		$this->assertTrue(Yii::app()->user->isGuest);
        $identity = new UserIdentity('admin@pitchn.ca', 'admin');
        $identity->authenticate();
        Yii::app()->user->login($identity);
		$this->assertTrue(Yii::app()->user->isAdmin());
	}
	
		public function testCreateUser() {
		$model = new User();
		$this->assertTrue($model->save(false));
	}
}
