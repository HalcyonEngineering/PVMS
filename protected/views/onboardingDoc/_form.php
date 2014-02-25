<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'onboarding-doc-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'role_id',array('class'=>'span5')); ?>

	<?php echo $form->markdownEditorRow($model,'markdown',array('height' => '200px')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
