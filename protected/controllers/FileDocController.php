<?php

class FileDocController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','download'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
 	 * Creates a new model.
 	 * If creation is successful, the browser will be redirected to the 'view' page.
 	 */
	public function actionCreate()
	{
		////Yii::log('FileDoc create action begun', 'warning', 'FileDoc');
        
		$model=new FileDoc; // remember: this is a local var

        if(isset($_POST['FileDoc']))
		{
            $model->attributes=$_POST['FileDoc'];
            Yii::log('FileDoc uploadedfile before set from cuploadedfile getinstance: '.$model->uploadedfile, 'warning', 'FileDoc');
            ////$tempattribute = 'uploadedfile';
            ////Yii::log('getinstancebyname: '.(CHtml::resolveName($model, $tempattribute)), 'warning', 'FileDoc'); // => "(...) FileDoc[uploadedfile]"
            $model->uploadedfile=CUploadedFile::getInstance($model,'uploadedfile'); //TODO: what's going on with getInstance and the model and the attribute name??? how is the binding to FileDoc[uploadedfile] specific enough?!?!?!
            Yii::log('FileDoc uploadedfile after set from cuploadedfile getinstance: '.$model->uploadedfile, 'warning', 'FileDoc');
            if($model->save())
            {
    	        ////Yii::log('file to be saved in path: '.Yii::getPathOfAlias('webroot').'/assets/tempupload/'.$model->uploadedfile->name, 'warning', 'FileDoc');
                //$model->uploadedfile->saveAs(Yii::getPathOfAlias('webroot').'/assets/tempupload/'.$model->uploadedfile->name); // uncomment and modify if you want to save the file on the filesystem
                ////Yii::log('FileDoc create action ended with redir', 'warning', 'FileDoc');
                $this->redirect(array('view','id'=>$model->id)); // redirect to success page
            }
        }

        ////Yii::log('FileDoc create action ended', 'warning', 'FileDoc');
		$this->render('create',array(
			'model'=>$model,
		));

	}

	public function actionDownload()
	{
		$id = $_POST['id'];
		Yii::log('downloadmodel input: id:'.$id, 'warning', 'FileDoc');

		$dataProvider=new CActiveDataProvider('FileDoc', array('criteria'=>array('condition'=>'id='.$id,),));
		$model = $dataProvider->getData()[0];
		Yii::log('downloadmodel db: id:'.$model->id, 'warning', 'FileDoc');
		Yii::log('downloadmodel db: file_name:'.$model->file_name, 'warning', 'FileDoc');
		Yii::log('downloadmodel db: file_size:'.$model->file_size, 'warning', 'FileDoc');
		Yii::log('downloadmodel db: file_data:'.$model->file_data, 'warning', 'FileDoc');

		//echo CHtml::script("window.alert('id is: ".$id."');"); //works: this is how you create a popup
		// note: documentation on sendFile: http://www.yiiframework.com/doc/api/1.1/CHttpRequest#sendFile-detail
		Yii::app()->getRequest()->sendFile($model->file_name,$model->file_data); //TODO: put actual useful file data here //getRequest returns the request component of Yii
		
		//Yii::log('download: after workhorse code', 'warning', 'FileDoc'); //NOTE: it seems like nothing after the sendFile gets reached due to terminate (?)
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileDoc']))
		{
			$model->attributes=$_POST['FileDoc'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('FileDoc');
		$this->renderModal('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FileDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FileDoc']))
			$model->attributes=$_GET['FileDoc'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FileDoc the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FileDoc::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FileDoc $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-doc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
