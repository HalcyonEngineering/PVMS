<?php

class TaskController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete, dynamicUpdate', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'update' and 'dynamicUpdate' actions
				'actions'=>array('update', 'dynamicUpdate'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'delete' actions
				'actions'=>array('create','delete'),
				'expression'=>'Yii::app()->user->isManager()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($role_id)
	{
		$model=new Task;
		$roleModel = Role::model()->findByPk($role_id);
		if (!Yii::app()->user->isManagerForOrg($roleModel->org->id)){
			throw new CHttpException(403, "You cannot create a task for this role.");
		}
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->id)); // this is what we would normally do, but we have to reroute it to make the role workflow workflow
				Notification::notifyAll($model->role->users,
				"Your manager has added a new task.",
					Yii::app()->createUrl('/role/view', array('id'=>$model->role_id))
				);
				$this->redirect(array('/role/view','id'=>$model->role_id));
			}
		}

			$model->role_id = $role_id;
			$model->actual = 0;

		$this->renderModal('/task/create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if (!Yii::app()->user->hasRole($model->role_id) && !Yii::app()->user->isManagerForOrg($model->org->id)){
			throw new CHttpException(403, "You do not have permission to update this task.");
		}
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save()){
				$this->taskNotify($model);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 *
	 */
	public function actionDynamicUpdate(){

		if(isset($_POST['pk'])){
				$model = $this->loadModel($_POST['pk']);
				$model->setAttribute($_POST['name'],$_POST['value']);
			if (!Yii::app()->user->hasRole($model->role_id) && !Yii::app()->user->isManagerForOrg($model->org->id)){
				throw new CHttpException(403, "You do not have permission to update this task.");
			}
			if (Yii::app()->user->isVolunteer()){
				$model->setScenario('volunteerUpdate');
			}
			if($model->validate() && $model->save()){
				$generalChange = ($_POST['name'] == 'status') ? false : true;
				$this->taskNotify($model, $generalChange);
				Yii::app()->end(200);
			}
			throw new CHttpException(400, $model->getError($_POST['name']));
		}
		throw new CHttpException(403);
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
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			if(!Yii::app()->user->isManagerForOrg($model->org->id)){
				throw new CHttpException(403, "You do not have permission to delete this task.");
			}
			$roleModel = $model->role;
			$taskName = $model->name;
			if($model->delete()){
				Notification::notifyAll($roleModel->users,
				                        "Task \"$taskName\" has been removed from role \"$roleModel->name\".",
				                        Yii::app()->createAbsoluteUrl('role/view', array('id'=>$roleModel->id)));
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function taskNotify($model, $generalChange=false){
		$url = Yii::app()->createUrl("role/view?id=$model->role_id");
		$statusName = Lookup::item('TaskStatus', $model->status);

		if ($generalChange === true){
			if(Yii::app()->user->isManager()){
				Notification::notifyAll($model->role->users,
				                        "A task has been updated.",
				                        $url
				);
			} elseif (Yii::app()->user->isVolunteer()){
				Notification::notify($model->role->project->org->getManager()->id,
				                     "Your volunteer(s) have updated the time spent working on \"$model->name.\"",
				                     $url
				);
			}
		} else {
			if(Yii::app()->user->isManager()){
				Notification::notifyAll($model->role->users,
				                        "Your manager has marked \"$model->name\" as $statusName.",
				                        $url
				);
			} elseif (Yii::app()->user->isVolunteer()){
				Notification::notify($model->role->project->org->getManager()->id,
				                     "A volunteer has marked \"$model->name\" as $statusName.",
				                     $url
				);
			}
		}
	}
}
