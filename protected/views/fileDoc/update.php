<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FileDoc','url'=>array('index')),
	array('label'=>'Create FileDoc','url'=>array('create')),
	array('label'=>'View FileDoc','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FileDoc','url'=>array('admin')),
	);
	?>

	<h1>Update FileDoc <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>