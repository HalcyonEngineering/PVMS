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
	
	/**
	* @expectedException CDbException
	*/
	public function testCreateNullUser() {
		$this->setExpectedExceptionFromAnnotation(); 	
		$model = new User();
		$model->save(false);
	}
	
	public function testCreateUser() {	
		$model = new User();
		$password = $model->hashPassword("kenshiro");
		$model->password = $password;
		$model->setAttributes(
			array(
			'name'=>'Kenshiro Kasumi',
			'email'=>'kenshiro@hokuto.jp',
			)
		);
		$model->save(false);
	}
		
}	
?>