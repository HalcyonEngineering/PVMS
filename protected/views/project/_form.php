<?php
/**
 * @var $this ProjectController
 * @var $form bootstrap.widgets.TbActiveForm
 * @var $model Project
 */

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'project-form',
	'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'org_id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

<?php echo $form->colorpickerRow($model,'colour'); ?>

<?php echo $form->datepickerRow($model,'target'); ?>

<div class="form-actions">

<?php
	$this->widget('ModalSubmitButton',
	              array(
		              'label'=>($model->isNewRecord ? 'Create' : 'Save'),
		              'modelName' => 'project')
	);
?>

</div>

<?php $this->endWidget(); ?>
