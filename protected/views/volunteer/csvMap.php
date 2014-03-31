<?php 
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array(), // success, info, warning, error or danger
            'error'=>array(), // success, info, warning, error or danger
        ),
    ));
?>

<?php
    $this->pageTitle=Yii::app()->name . ' - CSV Mapping';
?>
<h1>Csv Mapping</h1>
<p style="width: 75%;">Choose your CSV mapping here:</p>

<?php
    echo CVarDumper::dumpAsString($csvModel->getFirstRow($csvModel->getTempName()));
?>
    
<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'csv-upload-form',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($csvModel); ?>

        <?php echo 'First Name:'; ?>
        <br>
	<?php echo CHtml::dropDownList('first-name-csv', '', $csvModel->getFirstRow($csvModel->getTempName())) ?>
        <br>
        <br>
        <?php echo 'Last Name'; ?>
        <br>
	<?php echo CHtml::dropDownList('last-name-csv', '', $csvModel->getFirstRow($csvModel->getTempName())) ?>
        <br>
        <br>
        <?php echo 'Email'; ?>
        <br>
	<?php echo CHtml::dropDownList('email-csv', '', $csvModel->getFirstRow($csvModel->getTempName())) ?>
        <?php echo CHtml::hiddenField('tempName', $csvModel->getTempName()); ?>
</div>

<div class="form-actions">
	<?php echo CHtml::submitButton('Submit', array('id'=>'upload')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
