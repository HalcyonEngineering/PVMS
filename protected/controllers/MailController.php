<?php

class MailController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
			      'actions'=>array('contact'),
			      'user'=>array('@'),
			),
			array('deny',  // deny all users
			      'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{// TODO: remove this code if not necessary, or update it to use the model sendMail() function if it is necessary
		$user = User::model()->findByPk(Yii::app()->user->id);
		$model=new Mail;
		if(isset($_POST['Mail']))
		{
			$model->attributes=$_POST['Mail'];
			$model->name=$user->name;
			$model->email=$user->email;
			if($model->validate())
			{
				if($model->sendMail()){
					Yii::app()->user->setFlash('success','Your mail has been sent');
				} else {
					Yii::app()->user->setFlash('error','Your mail was not sent');
				}
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

}