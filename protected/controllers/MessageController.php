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