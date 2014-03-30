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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','listTasks','delete'),
				'users'=>array('@'),
			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($role_id = null)
	{
		$model=new Task;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id)); // this is what we would normally do, but we have to reroute it to make the role workflow workflow
				Notification::notifyAll($model->role->users,
				"Your manager has added a new task.",
					Yii::app()->createUrl('/role/view', array('id'=>$model->role_id))
				);
				$this->redirect(array('/role/view','id'=>$model->role_id));
		}

		if(isset($role_id)) {
			$model->role_id = $role_id;
			$model->actual = 0;
		}

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
			$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Render a modal showing all Tasks for the role id passed in
	 */
	public function actionListTasks($role_id)
	{
		$dataProvider=new CActiveDataProvider('Task',array('criteria'=>array('condition'=>'role_id='.$role_id,),));
		if (Yii::app()->user->isVolunteer()) {
			$this->renderModal('_tasks',array('dataProvider'=>$dataProvider,
												'template'=>'{view}{update}',));
		} else {
			$this->renderModal('_tasks',array('dataProvider'=>$dataProvider,
												'template'=>'{view}{update}{delete}',));
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
