<?php
$this->pageTitle=Yii::app()->name . ' - Import';
$this->breadcrumbs=array(
	'Import',
);
?>

<h1>Import Volunteers HEY KEN</h1>

<p>This is the page used to import or manually add volunteers (CSV)</p>

<?php $form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'csv-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )
);

//echo $form->labelEx($model, 'csv');
//echo $form->fileField($model, 'csv');
//echo $form->error($model, 'csv');

//echo CHtml::submitButton('Submit');

$this->endWidget();

?>
