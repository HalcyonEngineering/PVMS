<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	$model->project_id=>array('view','id'=>$model->project_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FileDoc','url'=>array('index')),
	array('label'=>'Create FileDoc','url'=>array('create')),
	array('label'=>'View FileDoc','url'=>array('view','id'=>$model->project_id)),
	array('label'=>'Manage FileDoc','url'=>array('admin')),
	);
	?>

	<h1>Update FileDoc <?php echo $model->project_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>