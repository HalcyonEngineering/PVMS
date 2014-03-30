<div class="form">
<?php
    $form = $this->beginWidget(
                 'bootstrap.widgets.TbActiveForm',
                 array(
	                 'id'=>'add-volunteer-manual-form',
	                 'enableClientValidation'=>true,
	                 'clientOptions'=>array('validateOnSubmit'=>true,),
	                 'enableAjaxValidation'=>false,
                 )
    );
?>

<h2>By Form</h2>
<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name'); ?>


	<?php echo $form->emailFieldRow($model,'email'); ?>


<div class="row radiogroup">
	<?php
		$status = array(
			0=>'Not available',
			1=>'Weekdays',
			2=>'Weekends',
			3=>'Weekdays & Weekends',
		);
		$model->availability = 0;
		echo $form->radioButtonListRow($model, 'availability', $status,
		                               array('labelOptions'=>array('style'=>'font: normal 11pt Calibri;'))
		);
	?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'location'); ?>
	<?php $this->widget('CAutoComplete', array(
		'model'=>$model,
		'attribute'=>'location',
		'url'=>array('suggestLocation'),
		'multiple'=>true,
		'htmlOptions'=>array('size'=>50, 'placeholder'=>"City name only"),
	)); ?>
	<p class="hint">Separate multiple cities with commas.</p>
	<?php echo $form->error($model,'location'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'skillset'); ?>
	<?php $this->widget('CAutoComplete', array(
		'model'=>$model,
		'attribute'=>'skillset',
		'url'=>array('suggestSkillset'),
		'multiple'=>true,
		'htmlOptions'=>array('size'=>50, 'placeholder'=>"Separate with commas"),
	)); ?>
	<p class="hint">Please separate different skills with commas.</p>
	<?php echo $form->error($model,'skillset'); ?>
</div>

<div class="row buttons">
	<?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>

</div>