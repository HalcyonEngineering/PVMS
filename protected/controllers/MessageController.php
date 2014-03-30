<?php

class MessageController extends Controller
{
	public function actionBulkMail()
	{
		$model = new Mail("bulk");
		//This first entry is from another page.
		if(isset($_POST['selectedIds'])){
			$model->bulkUserId = serialize($_POST['selectedIds']);
			$this->render('bulkMail', array('model'=>$model));
		//This is for submit attempts to the same page.
		} else if (isset($_POST['Mail'])) {
			$model->attributes = $_POST['Mail'];
			$model->name = Yii::app()->user->name;
			$model->email = Yii::app()->user->email;
			if ($model->validate()){
				$result = unserialize($model->bulkUserId);
				foreach($result as $userId){
					$model->Remail = User::model()->findByPk($userId)->email;
					$model->sendMail();
				}
			}
			$this->render('bulkMail', array('model'=>$model));
		} else {
			throw new CHttpException(400, "No users selected.");
		}

	}

	public function actionCompose(){
		$model = new Message('compose');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Message'])){
			$model->attributes=$_POST['Message'];
			$model->sender_id=Yii::app()->user->id;
			//Duplicate the message per user.
			foreach($model->targets as $user_id){
				$perUser = new Message();
				$perUser->attributes = $model->attributes;
				$perUser->user_id=$user_id;

				$perUser->validate();
				$perUser->save();
			}
		}
		$this->render('compose', array('model'=>$model));
	}

	public function actionInbox(){
		$model = new Message('search');

		$this->render('inbox', array('dataProvider'=>$model->searchInbox()));
	}

	public function actionOutbox(){
		$model = new Message('search');

		$this->render('outbox', array('dataProvider'=>$model->searchOutbox()));
	}
	/**
	 * Performs the AJAX validation.
	 * @param Role $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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