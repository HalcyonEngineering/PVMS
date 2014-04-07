<?php
// This part is just part of my naive attempt of getting the testEnrollVolunteer test to work
ob_start();

class UserTest extends CDbTestCase
{	
	// We define fixtures here
	// ex [tablename] => [Class]
	// Note that the fixture files we are using are in the form pvms_*.php
	// Where the * is singular, but when we define it is plural, yeah I don't know
	public $fixtures=array(
		'users'=>'User',
	);
	
	
	public function testValidatePassword()
	{
		// To get the AR instance of an object in the database, we call the fixture and the alias of the row
		$user = $this->users('sampleUser');
		$this->assertFalse($user->validatePassword('demo'));
		$this->assertTrue($user->validatePassword('admin'));
	}
	
	public function testDeleteVolunteer()
	{
		// To get the AR instance of an object in the database, we call the fixture and the alias of the row
		$user = $this->users('sampleUser');
		$this->assertTrue($user->delete());
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
		
		$this->assertTrue($model->save());
	}


	public function testCreateNullUser() {
		//$this->setExpectedExceptionFromAnnotation(); 	
		$model = new User();
		$this->assertFalse($model->save());
	}
	
	//There are currently problems with this test due to database relations and
	//Yii functionality
	public function testEnrollVolunteer() {
		$model = $this->users('sampleUser2');
		$this->assertNotNull($model);
		
		$name = 'Tyrone Black';
		$email = 'tyrone.black@solutions.com';
		$location = 'Estonia';
		$skillset = null; 
		$organization = Yii::app()->user->managedOrg;
		$availability = null;
		
		$model->enrollVolunteer($name, $email, $location, $skillset, $organization, $availability);
		
		$user = User::model()->findByAttributes(array('name'=>$name));
		
		$this->assertNotNull($user);
		
		$this->assertTrue($user->name, $name);
	}
	
}