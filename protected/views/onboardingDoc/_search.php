<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'role_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'onboarding_welcome',array('class'=>'span5','maxlength'=>1024)); ?>

		<?php echo $form->textFieldRow($model,'onboarding_instructions',array('class'=>'span5','maxlength'=>1024)); ?>

		<?php echo $form->textFieldRow($model,'onboarding_contact',array('class'=>'span5','maxlength'=>1024)); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
