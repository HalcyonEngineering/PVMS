

<?php
class CController
{
    public function createAbsoluteUrl($route, $params)
    {
        return dslfkjd;
    }
}
?>

<?php
// This part is just part of my naive attempt of getting the testEnrollVolunteer test to work
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
	// This test involves a function that mail
	/*
	public function testEnrollVolunteer() {
		// This portion of this code logs a manager to satisfy the
		// authentication of 
		$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
		Yii::app()->setComponent('session', $mockSession);
		
		$user = $this->users('sampleUser2');
		$identity = new UserIdentity($user->email, 'admin');
		$this->assertTrue($identity->authenticate());
		$this->assertTrue(Yii::app()->user->login($identity));
			
		$model = $this->users('sampleUser2');
		$this->assertNotNull($model);
		
		$newUser = new User();
		$newUser->name = 'Tyrone Black';
		$newUser->email = 'tyrone.black@solutions.com';
		$newUser->location = 'Estonia';
		$newUser->skillset = null; 
		$organization = Yii::app()->user->managedOrg;
		$newUser->availability = null;
		
		$model->enrollVolunteer($newUser, $organization);
		
		$user = User::model()->findByAttributes(array('name'=>$name));
		
		$this->assertNotNull($user);
		
		$this->assertTrue($user->name, $name);
		Yii::app()->session->destroy();
	}
	*/
	
	public function testSearchUser() { 	
		$model = $this->users('sampleUser2');
		$search = $model->search();
		$this->assertNotNull($search);
	}
	
	public function testSearchVolInOrg() { 
		$model = $this->users('sampleUser2');
		$model->search_volunteers_in_org($model->getManagedOrg());
	}
	
	/* Incomplete test due to the need for arguments
	public function testSearchVolInOrgAdv() { 
		$model = $this->users('sampleUser2');
		$model->search_volunteers_in_org_adv($model->getManagedOrg(), NULL);
	}
	*/
	
	public function testSearchVolunteer() { 
		$model = $this->users('sampleUser2');
		$model->search_volunteers();
	}
	public function testGetUsername() { 
		$model = $this->users('sampleUser2');
		$model->getUsername();
	}
	
	public function testGetFullName() { 
		$model = $this->users('sampleUser2');
		$model->getFullName();
	}
	public function testGetManagedOrg() { 
		$model = $this->users('sampleUser2');
		$model->getManagedOrg();
	}
	
	public function testGetManagedOrgNull() { 
		$model = $this->users('sampleUser');
		$model->getManagedOrg();
	}
	
	/* Can't test due to email
	public function testEmailWelcome() {
		$model = $this->users('sampleUser2');
		$model->emailWelcome($model);
	}
	*/

	/* Problem with creating URL
	public function testRemoveFromRole() {
		$model = $this->users('sampleUser2');
		$model->assignToRole(array(3), 1);
		$model->removeFromRole(array(3), 1);
		
	}
	*/
	
	/* Incomplete test
	public function testRemoveFromOrg() {
		$model = $this->users('sampleUser2');
		$model->removeFromOrg(array(3), 1);
	}
	*/
	
	public function testAvaiabilityString() {
		$model = $this->users('sampleUser2');
		$this->assertEquals($model->availabilityString(User::AVAILABLE_NONE), 'Not Available');
		$this->assertEquals($model->availabilityString(User::AVAILABLE_WEEKDAYS), 'Weekdays');
		$this->assertEquals($model->availabilityString(User::AVAILABLE_WEEKENDS), 'Weekends');
		$this->assertEquals($model->availabilityString(User::AVAILABLE_ALL), 'Weekdays & Weekends');
	}
}	
?>