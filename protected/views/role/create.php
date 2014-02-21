<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Role','url'=>array('index')),
array('label'=>'Manage Role','url'=>array('admin')),
);
?>

<h1>Create Role</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>