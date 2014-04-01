<?php 

$form = $this->beginWidget(
    'CActiveForm', 
    array(
        'id'=>'add-volunteer-csv-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true,),
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )
); 

echo '<h2>By CSV</h2>';

echo CHtml::link('If you\'re not sure what to upload, download an example here.', $csvModel->getCsvTemplateUrl());
echo '<br>';
echo '<br>';
echo '<br>';

echo $form->fileField($csvModel, 'csv');
echo $form->error($csvModel, 'csv');

echo '<br>';

echo CHtml::submitButton('Submit');

$this->endWidget();

?>
