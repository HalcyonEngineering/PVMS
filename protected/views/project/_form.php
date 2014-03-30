<?php
/**
 * @var $this ProjectController
 * @var $form TbActiveForm
 * @var $model Project
 */

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'project-form',
	'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php

echo $form->errorSummary($model);

echo $form->hiddenField($model, 'org_id');

echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128));

echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span5'));

echo $form->colorpickerRow($model,
                           'colour',
                           array(
	                           'events'=>array(
		                           'changeColor'=>'js:function(ev){
		                                console.log(ev.color.toHex());
		                                $(".colorpicker-inner").parents(".add-on").css("background-color", ev.color.toHex());
		                           }'
	                           ),
                           ),
                           array(
	                           'placeholder'=>'Click here to select a colour',
	                           'prepend'=>"<i class='colorpicker-inner'></i>",
                               'prependOptions'=>array(
	                               'style'=>"background-color : $model->colour;",
                               ),
                           )
);

echo $form->datepickerRow($model,
                          'targetString',
                          array(),
                          array(
	                          'hint'=>'Leave blank for indefinite',
	                          'prepend' => '<i class="icon-calendar" id="mydatepicker""></i>'
                          ));

?>

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
