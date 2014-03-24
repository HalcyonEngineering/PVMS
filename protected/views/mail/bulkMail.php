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

	echo $form->textFieldRow($model,'subject');

	echo $form->textAreaRow($model, 'body');

?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton',
	                    array('buttonType'=>'submit',
	                          'type'=>'primary',
	                          'label'=>'Send'));
	?>
</div>