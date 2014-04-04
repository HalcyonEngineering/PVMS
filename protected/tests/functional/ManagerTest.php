<?php
//$ alias phpunit="/cygdrive/c/xampp/php/php C:/xampp/php/phpunit"
//$ java -jar selenium-server-standalone-2.40.0.jar

class AccountTest extends WebTestCase
{
	public function testLoginLogout()
	{
		$time = 500;
		$this->open('');
		$this->windowFocus();
		$this->windowMaximize(); 
		// ensure the user is logged out
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout');
			
		// test login process, including validation
		// First test the case of invalid password
		$this->pause(2000);
		$this->pause($time);
		//$this->runScript(javascript{window.scrollBy(0,-1000)}");
		$this->clickAndWait('name=yt0');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','manager@pitchn.ca');
		$this->pause($time);
		$this->clickAndWait("//button[@id='Sign_in_button']");
		$this->assertTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','manageer');
		$this->pause($time);
		$this->clickAndWait("//button[@id='Sign_in_button']");
		$this->assertTextPresent('Incorrect username or password.');
		$this->pause($time);
		
		// Now log into the manager account properly
		$this->assertElementPresent('name=LoginForm[username]');
		$this->pause($time);
		$this->type('name=LoginForm[password]','manager');
		$this->pause($time);
		$this->clickAndWait("//button[@id='Sign_in_button']");
		$this->pause($time);
		$this->assertTextNotPresent('Exception');
		$this->assertTextPresent('Hello, Sean Kennedy');
		//Logout
		$this->assertElementPresent('id=login-dropdown');
		
		
		//=================================
		// Creating the project in the modal
		// First attempt to create a project without fields
		//=================================
		
		
		$this->assertElementPresent('id=create-project-btn');
		$this->click("//a[@id='create-project-btn']");
		
		$this->click("//a[@id='create-project-btn']");
		$this->pause(2000);
		$this->click("//button[@type='submit']");
		$this->pause(2000);
		$this->assertTextPresent('Name cannot be blank');
		$this->assertTextPresent('Description cannot be blank');
		
		$this->click("//input[@name='Project[name]']");
		$this->assertElementPresent('name=Project[name]');
		$this->type('name=Project[name]', 'Cancer Run');
		$this->pause($time);
		
		
		$this->assertElementPresent('name=Project[desc]');
		$this->type('name=Project[desc]', 'Running away from cancer');
		$this->pause($time);
		
		$this->assertElementPresent('name=Project[colour]');
		$this->click("//form[@id='project-form']");
		$this->keyPress("//form[@id='project-form']", "\40");
		$this->keyPress("//form[@id='project-form']", "\40");
		$this->keyPress("//form[@id='project-form']", "\40");
		$this->pause(3000);
		$this->type('name=Project[colour]', '#f30d0d');
		$this->assertTextNotPresent('Colour is invalid.');
		$this->pause($time);
		
		$this->assertElementPresent('id=Project_targetString');
		$this->type('id=Project_targetString', 'April 3 2014');
		$this->pause($time);
		$this->clickAndWait("//button[@type='submit']");

		$this->assertTextNotPresent('Name cannot be blank');
		$this->assertTextNotPresent('Description cannot be blank');
		$this->assertTextPresent('Cancer Run');
		
		$this->pause($time);
		
		
		//=================================
		// Test the import of volunteers
		//=================================
		/*
		$this->clickAndWait("//img[@src='/PVMS/images/addvolunteers.png']");
		//$this->pause(1000);
		
		$this->type('name=User[name]','Billy Smith');
		$this->pause($time);
		$this->type('name=User[email]','billy.pitchn@gmail.com');
		$this->pause($time);
		$this->click("//input[@id='User_availability_3']");
		$this->pause($time);
		$this->type('name=User[location]','Burnaby');
		$this->clickAndWait("//input[@type='submit']");
		*/
		
		//=================================
		// Test the assignment of volunteers
		//=================================
		/*
		$this->clickAndWait("//img[@src='/PVMS/images/managevolunteers.png']");
		$this->click("//input[@id='User_availability_0']");
		$this->click("//input[@id='User_availability_1']");
		$this->click("//select[@id='Skill_id']");
		$this->pause($time);
		$this->select("id=Skill_id", "value=24");
		$this->pause($time);
		$this->select("id=Location_id", "value=3");
		$this->pause($time);
		$this->clickAndWait("//input[@id='yt0']");
		$this->pause($time);
		$this->click("//input[@id='selectedIds_0']");
		$this->pause($time);
		$this->select("id=role_list", "value=3");
		$this->pause($time);
		$this->clickAndWait("//input[@id='yt2']");
		*/
		//=================================
		// Test features for Organizations
		//=================================
		
		/*
		$this->clickAndWait("//*[@src='/PVMS/images/projects.png']");
		$this->pause($time);
		$this->clickAndWait("//a[@id='yw2']");
		$this->pause(5000);
		*/
		
		
		//=================================
		// Test logout process
		//=================================
		$this->click("//li[@id='login-dropdown']");
		$this->pause($time);
		$this->click("//a[@href='/PVMS/account/logout']");
		$this->pause($time);
		
		// Now log into the manager account properly
		/*
		$this->type('name=LoginForm[username]','kenneth@pitchn.ca');
		$this->pause($time);
		$this->assertElementPresent('name=LoginForm[username]');
		$this->pause($time);
		$this->type('name=LoginForm[password]','temporary');
		$this->pause($time);
		$this->clickAndWait("//button[@id='Sign_in_button']");
		$this->pause($time);
		$this->assertTextNotPresent('Exception');
		$this->pause(5000);
		//$this->assertTextNotPresent('Login');
		*/
		
	}
}
?>