<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Role','url'=>array('index')),
	array('label'=>'Create Role','url'=>array('create')),
	array('label'=>'View Role','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Role','url'=>array('admin')),
	);
	?>

	<h1>Update Role <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>