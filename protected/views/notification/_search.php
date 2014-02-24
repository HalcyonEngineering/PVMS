<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'timestamp',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'source',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'read_status',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
