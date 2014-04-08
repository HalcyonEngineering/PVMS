<?php
ob_start();
// This file is mostly just for reference
// Will use as reference in our transition to using fixtures
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
	
	public function testEnrollVolunteer() {
		$this->assertTrue(Yii::app()->user->isGuest);
        $identity = new UserIdentity('manager@pitchn.ca', 'manager');
        $identity->authenticate();
        Yii::app()->user->login($identity);
		$model = User::model()->findByAttributes(array('email'=>'manager@pitchn.ca'));
		$this->assertNotNull($model);
		
		$name = 'Tyrone Black';
		$email = 'tyrone.black@solutions.com';
		$location = 'Estonia';
		$skillset = null; 
		$organization = Yii::app()->user->managedOrg;
		$availability = null;
		
		echo "test enroll";
		$model->enrollVolunteer($name, $email, $location, $skillset, $organization, $availability);
		
		$user = User::model()->findByAttributes(array('name'=>$name));
		
		$this->assertNotNull($user);
		
		$this->assertTrue($user->name, $name);
		
		
	}
}	
?>