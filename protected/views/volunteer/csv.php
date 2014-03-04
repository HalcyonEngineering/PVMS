<?php 
    $form = $this->beginWidget(
        'CActiveForm', 
        array(
            'id'=>'add-volunteer-manual-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array('validateOnSubmit'=>true,),
            'enableAjaxValidation'=>false,
        )
    ); 
?>

<h2>By CSV</h2>

<?php

echo CHtml::link('Download file here<br><br>', $csvModel->getCsvTemplateUrl());
echo CHtml::image($csvModel->getCsvTemplateImageUrl(), 'This is where the CSV template image would be...');

echo '<br>';
echo '<br>';

echo $form->fileField($csvModel, 'csv');
echo $form->error($csvModel, 'csv');
echo CHtml::submitButton('Submit');

$this->endWidget();

?>
