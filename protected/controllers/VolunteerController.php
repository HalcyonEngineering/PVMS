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
            if($csvModel->save()) $csvModel->csv2volunteers();
        }
        
        if(isset($_POST['User']))
        {
            $name = $_POST['User']['name'];
            $email = $_POST['User']['email'];
            $location = $_POST['User']['location'];
            $skillset = $_POST['User']['skillset'];

            User::enrollVolunteer($name, $email, $location, $skillset);
        }

        // Pass the two partial views (csv and form) to add
        $csvView = $this->renderPartial('csv', array('csvModel' => $csvModel), true);
        $formView = $this->renderPartial('form', array('userModel' => $userModel), true);
        $this->render('add', array('formView'=>$formView, 'csvView'=>$csvView));
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
        $org_model = new Organization();

        $model->unsetAttributes(); // Clear attributes for search
        $org_model->unsetAttributes(); // Clear attributes for search

        if(isset($_GET['User'])) $model->attributes=$_GET['User'];

        if (isset($_POST['EmailVolunteersButton']))
        {
            if (isset($_POST['selectedIds']))
            {
                foreach ($_POST['selectedIds'] as $id)
                {
                    Yii::trace("user id: $id");
                    //$comment = $this->loadModel($id);
                    //$comment->is_published = 1;
                    //$comment->update(array('is_published'));
                }
            }
        }
        $this->render('search', array('model'=>$model, 'org_model'=>$org_model));
    }

    public function actionEmail()
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
