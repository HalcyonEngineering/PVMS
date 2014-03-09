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

<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?php echo $form->colorpickerRow($model,'colour'); ?>

<?php echo $form->datepickerRow($model,'target'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'ajaxSubmit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>

	<?php
		//This part below needs to be improved. It's not quite done and pretty hacky.
		$this->widget('bootstrap.widgets.TbButton',
	                    array(
		                    'label'=>$model->isNewRecord ? 'Create' : 'Save' . " Fancy",
		                    'type' => 'submit',

		                    'htmlOptions'=>array(
			                    'data-toggle' => 'modal',
			                    'data-target' => '#project-modal',
			                    'href' =>Yii::app()->createUrl("project/".($model->isNewRecord ? "create" : "update?id=$model->id")),
			                    'ajax'=>array(
				                    'type'=>'POST',
				                    // ajax post will use 'url' specified above
				                    'url'=>"js:$(this).attr('href')",
				                    'update'=>'#project-modal-body',
				                    'complete'=>"$('#project-modal').modal({show : true})",
			                    ),
		                    ),
	                    ));

	?>
</div>

<?php $this->endWidget(); ?>
