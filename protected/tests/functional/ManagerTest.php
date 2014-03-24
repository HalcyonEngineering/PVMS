<?php

class AccountTest extends WebTestCase
{
	public function testLoginLogout()
	{
		$this->open('');
		// ensure the user is logged out
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout');

		// test login process, including validation
		$this->pause(1000);
		$this->clickAndWait('link=Login');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','sean@pitchn.ca');
		$this->pause(1000);
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','manager');
		$this->pause(1000);
		$this->clickAndWait("//input[@value='Login']");
		$this->pause(1000);
		$this->assertTextNotPresent('Exception');
		$this->assertTextPresent('Welcome, Sean');
		$this->assertElementPresent('id=create-project-btn');
		$this->click("//a[@id='create-project-btn']");
		//"Cancer Run"
		//"Running away from cancer"
		//#f30d0d
		
		// Creating the project in the modal
		
		$this->click("//a[@id='create-project-btn']");
		$this->pause(1000);
		$this->click("//button[@id='project-submit']");
		$this->pause(1000);
		$this->assertTextPresent('Name cannot be blank');
		$this->assertTextPresent('Description cannot be blank');
		
		$this->click("//input[@name='Project[name]']");
		$this->assertElementPresent('name=Project[name]');
		$this->type('name=Project[name]', 'Cancer Run');
		$this->pause(1000);
		
		
		$this->assertElementPresent('name=Project[desc]');
		$this->type('name=Project[desc]', 'Running away from cancer');
		$this->pause(1000);
		
		$this->assertElementPresent('name=Project[colour]');
		$this->type('name=Project[colour]', '#f30d0d');
		$this->assertTextNotPresent('Colour is invalid.');
		$this->pause(1000);
		
		$this->assertElementPresent('name=Project[target]');
		$this->type('name=Project[target]', '03/19/2014');
		$this->pause(1000);
		$this->clickAndWait("//button[@id='project-submit']");

		$this->assertTextNotPresent('Name cannot be blank');
		$this->assertTextNotPresent('Description cannot be blank');
		$this->assertTextPresent('Cancer Run');

		//Test clicking organization
		//$this->clickAndWait("//*[@src='/PVMS/images/wlm.png']");
		$this->pause(5000);

		// test logout process
		$this->assertTextNotPresent('Login');
	}
}
?>