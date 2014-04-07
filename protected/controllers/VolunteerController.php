<?php

class VolunteerController extends Controller
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
			array('allow',
			      'actions' => array('suggestLocation', 'suggestSkillset'),
			      'users'=>array('@'),
			),
			array('allow',
			      'actions'=>array('removeFromRole'),
			      'expression'=>'Yii::app()->user->isVolunteer()',
			),
			array('allow',
			      'actions'=>array('add', 'deleteVolunteer', 'remove', 'removeFromRole', 'search'),
			      'expression'=>'Yii::app()->user->isManager()',
			),
			array('allow',
			      'actions'=>array('deleteVolunteer', 'volunteerDisable', 'volunteerEnable', 'search'),
			      'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
			      'users'=>array('*'),
			),
		);
	}

    public function actionAdd()
    {
        $csvModel = new Csv;
        $userModel = new User;

	$this->performAjaxValidation($userModel);

        if(isset($_POST['Csv']))
        {
            $csvModel->attributes = $_POST['Csv'];
            $csvModel->csv = CUploadedFile::getInstance($csvModel, 'csv');
	        $csvModel->internalName = uniqid(Yii::app()->user->email, true).'.csv';
	        $csvModel->csv->saveAs(Yii::getPathOfAlias("application.runtime.tmpcsv").'\\'.$csvModel->internalName);
            if($csvModel->save()) {
                $this->render('csvMap', array('csvModel'=>$csvModel));
                return;
            }
       }

        // submit button, haven't figured out how to change name yet
        if(isset($_POST['yt0']))
        {
                $has_header = isset($_POST['has_header']);
	        $columns = array(
		    'firstName' => $_POST['first-name-csv'],
	            'lastName' => $_POST['last-name-csv'],
	            'email' => $_POST['email-csv'],
                    'phoneNumber' => $_POST['phone-number-csv'],
                    'address' => $_POST['address-csv']
	        );
                $count = $csvModel->csv2volunteers(
                    $has_header,
                    $_POST['internalName'],
                    $columns
                );
                if ($count['success'] > 0) {
                    Yii::app()->user->setFlash('success',
                        "<strong>".$count['success']." out of ".$count['total']." entries added successfully!</strong> Check the \"Manage Volunteers\" tab.");
                }
	            if ($count['old'] > 0) {
		            Yii::app()->user->setFlash('info',
		                                       "<strong>Uh-oh!</strong> ".$count['old']." volunteers could not be added because they were already in your organization.");
	            }
	            if ($count['error'] > 0) {
                    Yii::app()->user->setFlash('error',
                        "<strong>Uh-oh!</strong> ".$count['error']." volunteers could not be added. Were they already in the database?");
                }
        }

        if(isset($_POST['User']))
        {
	    $userModel->attributes=$_POST['User'];
            $status = User::enrollVolunteer($userModel, Yii::app()->user->getManagedOrg());

            if ($status === 'success') {
                Yii::app()->user->setFlash('success',
                    '<strong>Volunteer added!</strong> Check the "Manage Volunteers" tab!.');
            } elseif ($status === 'old'){
	            Yii::app()->user->setFlash('info',
	            'Volunteer is already part of your organization.');
            } else {
                Yii::app()->user->setFlash('error',
                    '<strong>Uh-oh!</strong> Volunteer could not be added, try again later.');
            }
        }

        Yii::trace("POST SUPERGLOBAL: ".CVarDumper::dumpAsString($_POST));

        // Pass the two partial views (csv and form) to add
        $csvView = $this->renderPartial('csv', array('csvModel' => $csvModel), true);
        $formView = $this->renderPartial('form', array('userModel' => $userModel), true);
        $this->render('add', array('formView'=>$formView, 'csvView'=>$csvView));
    }

    /**
     * Suggests location based on the current user input.
     * This is called via AJAX when the user is entering the project input.
     */
    public function actionSuggestLocation()
    {
        if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
        {
            $location=Location::model()->suggestLocation($keyword);
            if($location!==array())
                echo implode("\n", $location);
        }
    }

    /**
     * Suggests skillset based on the current user input.
     * This is called via AJAX when the user is entering the skillset input.
     */
    public function actionSuggestSkillset()
    {
        if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
        {
            $skillset=Skill::model()->suggestSkillset($keyword);
            if($skillset!==array())
                echo implode("\n", $skillset);
        }
    }

    /**
     * Searches for volunteers
     */
    public function actionSearch()
    {
        $model = new User('search');
        $model->unsetAttributes(); // Clear attributes for search
        
        $org_model = new Organization();
        $org_model->unsetAttributes();

        if(isset($_GET['User'])) $model->attributes=$_GET['User'];

        if(Yii::app()->user->isAdmin()) {
	        $dataProvider = $model->search_volunteers();
            $this->render('admin', array('model'=>$model, 'org_model'=>$org_model, 'dataProvider'=>$dataProvider));
        } elseif(Yii::app()->user->isManager()) {
            $role_model = new Role('search');
            $role_model->unsetAttributes();

            // data should initially contain all the volunteers in an organization
            $o = Yii::app()->user->getManagedOrg();
            $data = $model->search_volunteers_in_org($o);

            if(isset($_POST['User'])) $data = $model->search_volunteers_in_org_adv($o, $_POST);

            if (isset($_POST['selectedIds']) && isset($_POST['role_list']))
            {
                if (!empty($_POST['role_list'])) {
                    Yii::trace('selectedIds: '.serialize($_POST['selectedIds']));
                    Yii::trace('role_list'.serialize($_POST['role_list']));
                    $role_name = Role::model()->findByPk($_POST['role_list'])->name;
                    $count = User::assignToRole($_POST['selectedIds'], $_POST['role_list']);
                    if ($count['new'] > 0) {
                        Yii::app()->user->setFlash('success', 
                            "<strong>Role assigned!</strong> You assigned ".$count['new']." volunteer(s) to the \"$role_name\" role.");
                    }
	                if ($count['old'] > 0){
		                Yii::app()->user->setFlash('info', $count['old']." users already assigned to the role \"$role_name\".");
	                }
	                if ($count['failed'] > 0){
                        Yii::app()->user->setFlash('error',
                            "<strong>Uh-oh!</strong> Could not assign ".$count['failed']." users to the role \"$role_name\".");
                    }
                }
            }

            Yii::trace("SUPERGLOBAL: ".CVarDumper::dumpAsString($_POST));
            $this->render('search', array('data'=>$data, 'model'=>$model, 'role_model'=>$role_model));
        } else {
	        throw new CHttpException(403, "Permission denied");
        }
    }

    // Remove volunteer from organization
    public function actionRemove($id)
    {
        User::removeFromOrg($id, Yii::app()->user->getManagedOrg());
        $this->actionSearch();
    }

    public function actionRemoveFromRole($volunteer_id, $role_id) {
	    $role = Role::model()->findByPk($role_id);
	    if (Yii::app()->user->id === $volunteer_id || Yii::app()->user->isManagerForOrg($role->project->org->id)){
        User::removeFromRole($volunteer_id, $role_id);

        if (Yii::app()->user->isManager()){
	        Notification::notify($volunteer_id,
	                             "You have been removed from the role \"$role->name\".",
	                             Yii::app()->createAbsoluteUrl('role/index')
	        );
        $this->redirect(array('project/view', 'id'=>$role->project->id));
        }
        else{
            Yii::app()->user->setFlash('success', 'You have removed yourself from role: '.$role->name.'.');
	        Notification::notify(
	                    $role->project->org->manager->id,
	                    Yii::app()->user->getName() ."has been opted out of: \"$role->name\".",
		                $this->createAbsoluteUrl('role/view', array('id'=>$role_id))
	        );
            $this->redirect(array('role/index'));
        }
	    } else {
		    throw new CHttpException(403, "Access denied. You do not have sufficient permissions to perform this action.", 403);
	    }
    }
    
    //Delete volunteer
    public function actionDeleteVolunteer($userID)
    {
        $user = Yii::app()->getComponent('user');
        if (Yii::app()->user->isAdmin()){
            $model = User::model()->findByPk($userID);
            $model->delete();
            $this->redirect(array('volunteer/search'));
        }
    }
    
    /**
    * Disables the account 
    */
    public function actionVolunteerDisable($userID){
        $model = User::model()->findByPk($userID);
        $model->setScenario("disable");
        if($model->setAttribute('type', User::DISABLEDVOLUNTEER) && $model->save()){
	        Yii::app()->user->setFlash('success', "Volunteer disabled.");
        }
        $this->redirect(array('volunteer/search'));
    }
    
    /**
    * Enables the account 
    */
    public function actionVolunteerEnable($userID){
            $model = User::model()->findByPk($userID);
            $model->setScenario("enable");
            if($model->setAttribute('type', User::VOLUNTEER) && $model->save()){
	            Yii::app()->user->setFlash('success', "Volunteer disabled.");
            }
             $this->redirect(array('volunteer/search'));
    }

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='add-volunteer-manual-form')
		{
			// Allow non-unique emails for validation.
			// Any users already in the system get an additional organization.
			$model->setScenario('manualEnroll');
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
