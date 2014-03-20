<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Task','url'=>array('index')),
array('label'=>'Manage Task','url'=>array('admin')),
);
?>

<h1>Create Task</h1>


<?php 	
	if (isset($model->role_id)) {
		echo '<h1> in role: ';
		echo $model->role_id;
		echo '</h1>';
	}
	echo $this->renderPartial('/task/_form', array('model'=>$model)); ?>
