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
echo 'If you\'re not sure what to upload, download a CSV example ';
echo CHtml::link('<b>here</b>', $csvModel->getCsvTemplateUrl());
echo '.';
echo '<br>';
echo '<br>';
echo '<br>';

echo $form->fileField($csvModel, 'csv');
echo $form->error($csvModel, 'csv');

echo '<br>';

echo CHtml::submitButton('Submit');

$this->endWidget();

?>
