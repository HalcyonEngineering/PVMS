<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Create',
);

	echo CHtml::openTag('h1');
	if (isset($model)) {
		echo 'Create Task for ';
		echo $model->role->name;
	}
	echo CHtml::closeTag('h1');
	echo $this->renderPartial('/task/_form', array('model'=>$model)); ?>
