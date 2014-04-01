<?php

	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'message-form',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>true,
	));
?>
	<h2>Compose Message</h2>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php

	echo $form->errorSummary($model);
	$listTargets = CHtml::listData(User::model()->findAll(), 'id', 'name');
	echo $form->select2Row($model, 'targets', array(
		'data'=>$listTargets,
		'options'=>array(

		),
		'htmlOptions'=>array(
			'multiple'=>'multiple',
		),
	));

	echo $form->textFieldRow($model, 'subject');

	echo $form->textAreaRow($model, 'body');

?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
		    'label'=>'Send Message',
		));
		?>
	</div>

<?php
	$this->endWidget();
?>
