<?php

class RoleController extends Controller
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
			        'actions'=>array('view', 'index'),
			        'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
			      'actions'=>array('update','create', 'delete'),
			      'expression'=>'Yii::app()->user->isManager()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$onboardingModel = $model->onboardingDoc;
		if (isset($_POST['Role']) && isset($_POST['OnboardingDoc']) && $this->getCurUser()->isManagerForOrg($model->project->org_id))
		{
			$model->attributes=$_POST['Role'];
			$onboardingModel->attributes=$_POST['OnboardingDoc'];
			if($model->validate() && $onboardingModel->validate()){
				if($model->save() && $onboardingModel->save()){
					Yii::app()->user->setFlash('success', "Updated Role and Onboarding.");
				}
			}
			// else, if the user does not have this role, they are not allowed.
		} elseif (!$this->getCurUser()->hasRole($id) && !$this->getCurUser()->isManagerForOrg($model->project->org_id)){
			throw new CHttpException(403, "You are not allowed to view this role.");
		}

		$this->render('view',array('model'=>$model,
		                           'onboardingModel'=>$onboardingModel,));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($project_id)
	{
		$model=new Role;
		$onboardingModel=new OnboardingDoc;
		$model->project_id = $project_id;
		$project_model = Project::model()->findByPk($project_id);
		if (Yii::app()->user->isManagerForOrg($project_model->org_id)) {
			// Uncomment the following line if AJAX validation is needed
			$this->performAjaxValidation($model,$onboardingModel);

			if(isset($_POST['Role']) && isset($_POST['OnboardingDoc']))
			{
				$model->attributes=$_POST['Role'];
				if ($model->save()) {
					$onboardingModel->attributes=$_POST['OnboardingDoc'];
					$onboardingModel->role_id = $model->id; // we're chaining it on
					$onboardingModel->save();

					$this->redirect(array('view','id'=>$model->id));
				}
			}

			$this->renderModal('create',array('model'=>$model,
			                                  'onboardingModel'=>$onboardingModel,));
		} else {
			throw new CHttpException(403, "You do not have permission to create a role in this project.");
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$onboardingModel=$model->onboardingDoc;
		if (Yii::app()->user->isManagerForOrg($model->project->org_id)){
			// Uncomment the following line if AJAX validation is needed
			 $this->performAjaxValidation($model, $onboardingModel);

			if(isset($_POST['Role']) && isset($_POST['OnboardingDoc']))
			{
				$model->attributes=$_POST['Role'];
				$onboardingModel->attributes=$_POST['OnboardingDoc'];
				if($model->validate() && $onboardingModel->validate()){
					if($model->save() && $onboardingModel->save())
						$this->redirect(array('view','id'=>$model->id));
				}
			}
			$this->render('update',array(
				'model'=>$model,
			));
		} else {
			throw new CHttpException(403, 'You are not authorized to perform this action.', 403);
		}
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
			if (Yii::app()->user->isManagerForOrg($model->project->org_id)){
				$users=$model->users;
				$roleName = $model->name;
				$model->delete();
				Notification::notifyAll($users, "You have been removed from role \"$roleName\" because it has been deleted.", '#');
			} else {
				throw new CHttpException(403, 'You are not authorized to perform this action', 403);
			}
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('role/index'));
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
		if(Yii::app()->user->isVolunteer()){
			$models = User::model()->findByPk(Yii::app()->user->id)->roles;
		} elseif (Yii::app()->user->isManager()){
			$models = Yii::app()->user->managedOrg->roles;
		} else {
			throw new CHttpException(403, "You should not have any assigned roles.");
		}
		$dataProvider=new CActiveDataProvider('Role',array('data'=>$models));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
		$model=Role::model()->with('onboardingDoc')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Role $model the model to be validated
	 */
	protected function performAjaxValidation($model,$onboardingModel)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='role-onboarding-form')
		{
			echo CActiveForm::validate($model);
			echo CActiveForm::validate($onboardingModel);
			Yii::app()->end();
		}
	}
}
