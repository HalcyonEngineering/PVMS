<?php
$this->pageTitle=Yii::app()->name . ' - Import';
$this->breadcrumbs=array(
	'Import',
);
?>

<h1>Import Volunteers by CSV</h1>

<?php $form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'csv-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )
);

echo CHtml::link('Download file here<br><br>', $model->getCsvTemplateUrl());
echo CHtml::image($model->getCsvTemplateImageUrl(), 'This is where the CSV template image would be...');

echo '<br>';
echo '<br>';

echo $form->fileField($model, 'csv');
echo $form->error($model, 'csv');
echo CHtml::submitButton('Submit');

$this->endWidget();

?>
