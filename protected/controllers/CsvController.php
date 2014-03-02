<?php

class CsvController extends Controller
{
    public function actionImport()
    {
        $model = new Csv;
        if(isset($_POST['Csv']))
        {
            $model->attributes = $_POST['Csv'];
            $model->csv = CUploadedFile::getInstance($model, 'csv');
            if($model->save()) $model->registerCsv();
        }
        
        $this->render('import', array('model' => $model));
    }
}
