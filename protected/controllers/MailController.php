<?php

class MailController extends Controller
{
	public $layout='column1';
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new Mail;
		if(isset($_POST['Mail']))
		{
			$model->attributes=$_POST['Mail'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				if(mail($model->Remail,$subject,$model->body,$headers)){
					Yii::app()->user->setFlash('contact','Your mail has been sent');
				}else{
				Yii::app()->user->setFlash('error','Your mail was not sent');
				}
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

}