<?php

class MessageController extends Controller
{
	public $defaultAction='inbox';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
			      'actions'=>array('bulkMail'),
			      'expression'=> 'Yii::app()->user->isManager()',
			),
			array('allow',
			      'actions'=>array('compose', 'inbox', 'relational', 'outbox', 'delete'),
			      'users'=>array('@')
			),
			array('deny',  // deny all users
			      'users'=>array('*'),
			),
		);
	}

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
            Yii::app()->user->setFlash('success', 'Your message has been sent.');
            $this->redirect(array('message/outbox'));
		}
		$this->renderModal('compose', array('model'=>$model));
        
	}

	public function actionInbox(){
		$model = new Message('search');
		if(isset($_GET['Message'])){
			$model->attributes=$_GET['Message'];
		}
		$this->render('inbox', array('model'=>$model));
	}

	public function actionRelational($id)
	{
		$model = $this->loadModel($id);
		if ($model->user_id === Yii::app()->user->id){
			$model->status = Message::STATUS_READ;
			$model->save();
		}
		$this->renderPartial('_view', array(
			'data'=>$model,
		));
	}

	public function actionOutbox(){
		$model = new Message('search');
		$model->unsetAttributes();
		if(isset($_GET['Message'])){
			$model->attributes=$_GET['Message'];
		}
		$this->render('outbox', array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			if(!Yii::app()->user->id ===($model->user_id)){
				throw new CHttpException(403, "You cannot delete this message.");
			}
			// we only allow deletion via POST request
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('inbox'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Role the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
}