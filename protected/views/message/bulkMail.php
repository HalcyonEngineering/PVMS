<?php
	/**
	 * @var $form TbActiveForm
	 * @var $model Mail
	 */
    echo "<h1> Bulk Mail </h1>";
    echo "<p> Compose your message below to be sent to the selected volunteers.</p>";
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',
	                         array('id'=>'role-form',
	                               'enableAjaxValidation'=>false,
	                         ));
	echo $form->errorSummary($model);
	echo $form->hiddenField($model, 'bulkUserId');
	echo $form->textFieldRow($model,'subject', array('style'=>'width: 776px;'));

	echo $form->textAreaRow($model, 'body', array('style'=>'width: 776px; height: 300px; resize: none;'));
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