<?php

class Mail extends CFormModel

{
	public $name;
	public $email;
	public $Remail;
	public $subject;
	public $body;
	
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, body, Remail', 'required'),
			// email has to be a valid email address
			array('email, Remail', 'email'),
		);
	}
	
    public function attributeLabels()
	{
		return array(
			'name' => 'Your Name',
			'email' => 'Your Email',
            'Remail' => 'Recipient\'s Email',
			'subject' => 'Email Subject',
			'body' => 'Message',
		);
	}
}