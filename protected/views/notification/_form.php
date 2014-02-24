<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'notification-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'timestamp',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'source',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>128)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
