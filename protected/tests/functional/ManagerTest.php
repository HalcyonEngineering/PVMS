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
		// First test the case of invalid password
		$this->pause(1000);
		//$this->runScript(javascript{window.scrollBy(0,-1000)}");
		$this->clickAndWait('name=yt0');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','manager@pitchn.ca');
		$this->pause(1000);
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','manageer');
		$this->pause(1000);
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextPresent('Incorrect username or password.');
		$this->pause(1000);
		
		// Now log into the manager account properly
		$this->assertElementPresent('name=LoginForm[username]');
		$this->pause(1000);
		$this->type('name=LoginForm[password]','manager');
		$this->pause(1000);
		$this->clickAndWait("//input[@value='Login']");
		$this->pause(1000);
		$this->assertTextNotPresent('Exception');
		$this->assertTextPresent('Hello, Sean Kennedy');
		
		//"Cancer Run"
		//"Running away from cancer"
		//#f30d0d
		
		//Logout
		$this->assertElementPresent('id=login-dropdown');
		
		// Creating the project in the modal
		// First attempt to create a project without fields
		
		$this->assertElementPresent('id=create-project-btn');
		$this->click("//a[@id='create-project-btn']");
		
		$this->click("//a[@id='create-project-btn']");
		$this->pause(1000);
		$this->click("//button[@type='submit']");
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
		$this->click("//form[@id='project-form']");
		$this->keyPress("//form[@id='project-form']", "\40");
		$this->keyPress("//form[@id='project-form']", "\40");
		$this->keyPress("//form[@id='project-form']", "\40");
		$this->pause(3000);
		$this->type('name=Project[colour]', '#f30d0d');
		$this->assertTextNotPresent('Colour is invalid.');
		$this->pause(1000);
		
		$this->assertElementPresent('name=Project[target]');
		$this->type('name=Project[target]', '03/19/2014');
		$this->pause(1000);
		$this->clickAndWait("//button[@type='submit']");

		$this->assertTextNotPresent('Name cannot be blank');
		$this->assertTextNotPresent('Description cannot be blank');
		$this->assertTextPresent('Cancer Run');
		
		$this->pause(1000);
		
		//Test the import of volunteers
		
		$this->clickAndWait("//img[@src='/PVMS/images/addvolunteers.png']");
		$this->pause(1000);
		
		$this->type('name=User[name]','Billy ');
		
		//Test clicking organization
		//$this->clickAndWait("//*[@src='/PVMS/images/wlm.png']");
		$this->pause(1000);
		
		
		// test logout process
		//$this->assertTextNotPresent('Login');
	}
}
?>