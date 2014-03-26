<?php

class ProjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',
				'actions'=>array('index','create','view','update','delete', 'admin'),
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
		if(Yii::app()->user->isManagerForOrg($model->org_id)){
			$dataProvider=new CActiveDataProvider('FileDoc',array('criteria'=>array('condition'=>'project_id='.$id,),));
			$roleDataProvider = UserRole::model()->search($id);
			//CVarDumper::dump($roleDataProvider->getData());
			$this->render('view', array('model'=>$model,
			                        'dataProvider'=>$dataProvider,
			                        'roleDataProvider'=>$roleDataProvider)
			);
		} else {
			throw new CHttpException(403);
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Project;
		//Sets the org id to equal the org of the user.
		$model->org_id = Yii::app()->user->managedOrg->id;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->renderModal('create',array('model'=>$model));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(Yii::app()->user->isManagerForOrg($model->org_id)){
			// Uncomment the following line if AJAX validation is needed
			$this->performAjaxValidation($model);

			if(isset($_POST['Project']))
			{
				$model->attributes=$_POST['Project'];
				if($model->save())
				{
					$this->redirect(array('index'));
				}
			}

			$this->renderModal('update',
			                   array('model'=>$model)
			);
		} else {
			throw new CHttpException(403);
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
			$model = $this->loadModel($id);
			if(!Yii::app()->user->isManagerForOrg($model->org_id)){
				throw new CHttpException(403);
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
		if(isset($_POST['Project'])){
			Yii::log("Project set in index.", CLogger::LEVEL_ERROR);
		}
		$dataCriteria=new CDbCriteria();
		if(Yii::app()->user->ManagedOrg != null){
			$dataCriteria->compare('org_id', Yii::app()->user->managedOrg->id);
		} else {
			throw new CHttpException(403, "Not a manager.");
		}

		$dataProvider=new CActiveDataProvider('Project',array(
			'criteria'=>$dataCriteria,
		    'pagination'=>array('pageSize' => 9),
		));

		$this->renderModal('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Project the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Project $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
