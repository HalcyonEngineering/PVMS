<br>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'name',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'location',array('class'=>'span3')); ?>
<?php echo '<br>Skillset<br>'; ?>
<?php $this->widget('CAutoComplete', array(
    'model'=>$model,
    'attribute'=>'skillset',
    'url'=>array('suggestSkillset'),
    'multiple'=>true,
    'htmlOptions'=>array('size'=>50),
    'inputClass'=>'span3',
)); ?>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type'=>'primary',
        'label'=>'Search',
)); ?>
</div>

<?php $this->endWidget(); ?>
