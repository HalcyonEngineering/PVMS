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
	//This part below needs to be improved. It's not quite done and pretty hacky.
	$this->widget('bootstrap.widgets.TbButton',
	              array(
		              'buttonType'=> 'ajaxSubmit',
		              'label'=>($model->isNewRecord ? 'Create' : 'Save') . " Fancy",
		              'type' => 'submit',
		              //url has to be outside ajax options so it doesn't get overwritten.
		              // YiiBooster doesn't have a check to see if url exists in ajax first.
		              'url'=>"js:$(this).attr('href')",
		              'htmlOptions'=>array(
			              'id'=>'project-submit',
			              'href' =>Yii::app()->createUrl("project/".($model->isNewRecord ? "create" : "update?id=$model->id")),

		              ),
		              'ajaxOptions'=>array(
			              'type'=>'POST',
			              // ajax post will use 'url' specified above
			              'update'=>'#modal-body',
		              ),
	              ));

?>

</div>

<?php $this->endWidget(); ?>
