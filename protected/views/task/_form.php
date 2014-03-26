<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'task-form',
	'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php
	/**
	 * $form TbActiveForm
	 */
	echo $form->errorSummary($model); ?>

	<?php if (isset($model->role_id)) {
				echo $form->hiddenField($model,'role_id');
			} else {
				echo $form->textFieldRow($model,'role_id',array('class'=>'span5'));
			}  ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'expected',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'actual',array('class'=>'span5', 'append'=>' Hours'));

	?>

	<?php
	$taskStatus = Lookup::items('TaskStatus');
	if (Yii::app()->user->isVolunteer()){
		unset($taskStatus[3]);
	}
	echo $form->dropDownListRow($model, 'status', $taskStatus);

	?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
