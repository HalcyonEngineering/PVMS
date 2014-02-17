<?php

class SiteTest extends WebTestCase
{
	public function testContact()
	{
		$this->open('site/contact');
		$this->assertTextPresent('Contact Us');
		$this->assertElementPresent('name=ContactForm[name]');

		$this->type('name=ContactForm[name]','tester');
		$this->type('name=ContactForm[email]','tester@example.com');
		$this->type('name=ContactForm[subject]','test subject');
		$this->clickAndWait("//input[@value='Submit']");
		$this->assertTextPresent('Body cannot be blank.');
	}
}
?>