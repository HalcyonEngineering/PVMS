<?php 

$form = $this->beginWidget(
    'CActiveForm', 
    array(
        'id'=>'add-volunteer-manual-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true,),
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )
); 

echo '<h2>By CSV</h2>';

echo CHtml::link('Download the template, then upload below', $csvModel->getCsvTemplateUrl());
echo '<br>';
echo '<br>';
echo '<br>';

echo $form->fileField($csvModel, 'csv');
echo $form->error($csvModel, 'csv');
echo CHtml::submitButton('Submit');

$this->endWidget();

?>
