<?php
	/**
	 * @var $form TbActiveForm
	 * @var $model Mail
	 */
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',
	                         array('id'=>'role-form',
	                               'enableAjaxValidation'=>false,
	                         ));
	echo $form->errorSummary($model);
	echo $form->hiddenField($model, 'bulkUserId');
	echo $form->textFieldRow($model,'subject');

	echo $form->textAreaRow($model, 'body');
	Yii::log("BULKMAILLOGGER".CVarDumper::dumpAsString($model), "error");
?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton',
	                    array('buttonType'=>'submit',
	                          'type'=>'primary',
	                          'label'=>'Send'));
	?>
</div>
<?php
	$this->endWidget();
?>