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
		$this->pause(2000);
		$this->clickAndWait('link=Login');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','admin@pitchn.ca');
		$this->pause(2000);
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','admin');
		$this->pause(2000);
		$this->clickAndWait("//input[@value='Login']");
		$this->pause(5000);
		$this->assertTextNotPresent('Password cannot be blank.');

		//Test clicking organization
		$this->clickAndWait("//*[@src='/PVMS/images/wlm.png']");
		$this->pause(5000);

		// test logout process
		$this->assertTextNotPresent('Login');
	}
}
?>