<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'file-doc-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'project_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'file_name',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'file_size',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'file_data',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
