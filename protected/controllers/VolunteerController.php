<?php

class VolunteerController extends Controller
{
    public function actionAdd()
    {
        $csvModel = new Csv;
        $userModel = new User;

        if(isset($_POST['Csv']))
        {
            $csvModel->attributes = $_POST['Csv'];
            $csvModel->csv = CUploadedFile::getInstance($csvModel, 'csv');
            if($csvModel->save()) $csvModel->registerCsv();
        }
        
        //if(isset($_POST['User']))
        //{
        //    $userModel->attributes = $_POST['User'];

        //    //$model->csv = CUploadedFile::getInstance($model, 'csv');
        //    //if($model->save()) $model->registerCsv();
        //}

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
}
