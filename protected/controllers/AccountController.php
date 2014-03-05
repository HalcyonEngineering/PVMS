<?php

class AccountController extends Controller
{
	public $layout = 'column1';
	public $defaultAction = 'login';

	/**
	 * Makeshift attempt to login through admin account as current user.
	 * @TODO Request admin password. Check access.
	 */
	public function actionAdmin() {
		if (!Yii::app()->user->isGuest) {
			$identity = new AccessIdentity(Yii::app()->user->id, new UserIdentity('admin', 'admin'));
			Yii::app()->user->login($identity);
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
	
	/**
	* Second login admin attempt
	* @TODO UI handle case for denied access and Not admin
	*/
	public function actionAdminLogin($userID) {
	// First check that the manager has allowed admin access
		if (User::model()->findByPk($userID)->adminAccess == 1) { 
			if (Yii::app()->user->isAdmin()) {
				$identity = new AccessIdentity($userID, new UserIdentity('admin', 'admin'));
				Yii::app()->user->login($identity);
				$this->redirect(Yii::app()->user->returnUrl);
			}
			else {
				echo "Not an admin";
			}
		}
		else {
			echo "Manager has not enabled admin access";
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH') || !CRYPT_BLOWFISH)
			throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");

		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegister() {
		$model = new User('register');

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-register-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//If registration information was supplied.
		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->validate()) {
				//Hash the password before saving it.
				$model->password = $model->hashPassword($model->newPassword);
				$identity = new UserIdentity($model->email, $model->newPassword);

				if ($model->save() && $identity->authenticate()) {
					Yii::app()->user->login($identity);
					Yii::app()->user->setFlash('success', 'Account successfully created.');
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}

		}
		$this->render('register', array ('model' => $model));
	}

	public function actionReset()
	{
		$this->render('reset');
	}

	public function actionSettings()
	{
		if (Yii::app()->user->isGuest) {
			Yii::app()->user->loginRequired();
		}
		$model = User::model()->findByPk(Yii::app()->user->id);
		$model->setScenario('settings');

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-settings-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// If new settings were supplied.
		if (isset($_POST['User'])) {
			$_email = $model->email;
			$model->attributes = $_POST['User'];

			if ($model->validate()) {
				$_identity = new UserIdentity($_email, $model->origPassword);

				if (!$_identity->authenticate()) {
					Yii::app()->user->setFlash('error', 'Incorrect password.');
				} else {
					// Show new password.
					$_password = $model->newPassword;
					//Hash the password before saving it.
					if ($model->newPassword !== '') {
						$model->password = $model->hashPassword($model->newPassword);
					}
					
					if ($model->save()) {
						// Update email if it changed.
						$_identity->username=$model->email;
						Yii::app()->user->login($_identity);
						Yii::app()->user->setFlash('success', 'Account successfully changed.');
					}
				}

			}

		}

		$this->render('settings', array('model' => $model));
	}

	/**
	 * View profile.
	 */
	public function actionProfile(){

		$model = User::model()->findByPk(Yii::app()->user->id);
		$this->render('profile', array('model' => $model));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
