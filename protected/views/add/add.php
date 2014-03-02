<?php
$this->pageTitle=Yii::app()->name . ' - Import';
$this->breadcrumbs=array(
	'Import',
);
?>

<h1>By CSV</h1>

<p>You must fill out a CSV template file, then upload the file to us</p>
<p>You can download the template file here</p>

<p>[Insert screenshot of CSV Template here]</p>

<?php $form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'csv-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )
);

echo $form->labelEx($model, 'csv');
echo $form->fileField($model, 'csv');
echo $form->error($model, 'csv');

echo CHtml::submitButton('Submit');

$this->endWidget();

?>
