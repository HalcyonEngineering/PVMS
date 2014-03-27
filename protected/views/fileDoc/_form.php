<?php // used by create.php, update.php ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'file-doc-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php if (isset($model->project_id)) {
				echo $form->hiddenField($model,'project_id');
			} else {
				echo $form->textFieldRow($model,'project_id',array('class'=>'span5'));
			}  ?>
	
	<?php echo $form->fileFieldRow($model,'uploadedfile',array(),array('label'=>'')); ?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
