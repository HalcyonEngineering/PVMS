<?php

class VolunteerController extends Controller
{
    public $layout = '//layouts/column2';

    public function actionAdd()
    {
        $csvModel = new Csv;
        $userModel = new User;

        if(isset($_POST['Csv']))
        {
            $csvModel->attributes = $_POST['Csv'];
            $csvModel->csv = CUploadedFile::getInstance($csvModel, 'csv');
            if($csvModel->save()) {
                $count = $csvModel->csv2volunteers();
                if ($count['success'] > 0) {
                    Yii::app()->user->setFlash('success',
                        "<strong>".$count['success']." out of ".$count['total']." entries added successfully!</strong> Check the \"Manage Volunteers\" tab.");
                } else {
                    Yii::app()->user->setFlash('error',
                        '<strong>Uh-oh!</strong> No volunteers were added. Were they already in the database?');
                }
            }
       }

        if(isset($_POST['User']))
        {
			$userModel->attributes=$_POST['User'];
            $success = User::enrollVolunteer($userModel, Yii::app()->user->getManagedOrg());

            if ($success) {
                Yii::app()->user->setFlash('success',
                    '<strong>Volunteer added!</strong> Check the "Manage Volunteers" tab!.');
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
        } else {
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
                    $success_count = User::assignToRole($_POST['selectedIds'], $_POST['role_list']);
                    if ($success_count > 0) {
                        Yii::app()->user->setFlash('success', 
                            "<strong>Role assigned!</strong> You assigned $success_count volunteer(s) to the \"$role_name\" role."); 
                    } else {
                        Yii::app()->user->setFlash('error',
                            '<strong>Uh-oh!</strong> Something happened...');
                    }
                }
            }

            Yii::trace("SUPERGLOBAL: ".CVarDumper::dumpAsString($_POST));
            $this->render('search', array('data'=>$data, 'model'=>$model, 'role_model'=>$role_model));
        }
    }

    // Remove volunteer from organization
    public function actionRemove($id)
    {
        User::removeFromOrg($id, Yii::app()->user->getManagedOrg());
        $this->actionSearch();
    }

    public function actionRemoveFromRole($volunteer_id, $role_id) {
        User::removeFromRole($volunteer_id, $role_id);
        $role = Role::model()->findByPk($role_id);
        if (Yii::app()->user->isManager()){
        $this->redirect(array('project/view', 'id'=>$role->project->id));
        }
        else{
            Yii::app()->user->setFlash('success', 'You have removed yourself from role: '.$role->name.'.');
            $this->redirect(array('role/index'));
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
        if($model->setAttribute('type', User::DISABLEDVOLUNTEER)){
                Yii::Log("Setting successful", 'warning');
        }
        else {
                Yii::Log("Setting unsuccessful", 'warning');
        }
        if($model->save(false)){
                Yii::Log("Save successful", 'warning');
        }
        $this->redirect(array('volunteer/search'));
    }
    
    /**
    * Enables the account 
    */
    public function actionVolunteerEnable($userID){
            $model = User::model()->findByPk($userID);
            $model->setScenario("disable");
            if($model->setAttribute('type', User::VOLUNTEER)){
                    Yii::Log("Setting successful", 'warning');
            }
            else {
                    Yii::Log("Setting unsuccessful", 'warning');
            }
            if($model->save(false)){
                    Yii::Log("Save successful", 'warning');
            }
             $this->redirect(array('volunteer/search'));
    }
    
    public function actionDelete()
    {
        $model = new User();
        Yii::trace("POST SUPERGLOBAL:".serialize($_POST));
            if (isset($_POST['selectedIds']))
            {
                foreach ($_POST['selectedIds'] as $id)
                {
                    Yii::trace("user id: $id");
                }
            }
        $this->render('search', array('model'=>$model));
    }
}
