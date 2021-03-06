<?php

class NotificationController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('readAll','unread', 'read','readOnSelect', 'index', 'delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if(Yii::app()->request->isPostRequest)
		{
			if (Yii::app()->user->id !== $model->user_id){
				throw new CHttpException(403, "You do not have permission to delete this message.");
			}
			// we only allow deletion via POST request
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider= Notification::search_All();
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Notification the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Notification::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Notification $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='notification-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionReadAll(){
        $user = User::model()->findByPk(Yii::app()->user->id);
        $notify = $user->notifications;
        foreach ($notify as $notification){
            $notification->read_status = Notification::STATUS_READ;
            $notification->save();
        }

    $this->redirect(array('/notification/index'));
    }

    public function actionUnread($noti_id){
        $notification = Notification::model()->findByPk($noti_id);
	    if(Yii::app()->user->id !== $notification->user_id){
		    throw new CHttpException(403,
		                             "You cannot set the status of a notification that does not belong to you."
		    );
	    }
            $notification->read_status = Notification::STATUS_UNREAD;
            $notification->save();
        $this->redirect(array('/notification/index'));
    }

    public function actionRead($noti_id){
    $notification = Notification::model()->findByPk($noti_id);
	    if(Yii::app()->user->id !== $notification->user_id){
		    throw new CHttpException(403,
		                             "You cannot set the status of a notification that does not belong to you."
		    );
	    }
    $notification->read_status = Notification::STATUS_READ;
    $notification->save();
    $this->redirect(array('/notification/index'));
    }

    public function actionReadOnSelect($noti_id){
        $notification = Notification::model()->findByPk($noti_id);
	    if(Yii::app()->user->id !== $notification->user_id){
		    throw new CHttpException(403,
		                             "You cannot read a notification that does not belong to you."
		    );
	    }
        $notification->read_status = Notification::STATUS_READ;
        $notification->save();
        echo CHtml::script("window.location.href = '$notification->link';");
    }
}
