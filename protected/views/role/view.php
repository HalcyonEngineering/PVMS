<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Role','url'=>array('index')),
array('label'=>'Create Role','url'=>array('create')),
array('label'=>'Update Role','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Role','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Role','url'=>array('admin')),
array('label'=>'Create Task','url'=>array('createTask', 'id'=>$model->id)),

);
?>

<h1>View Role #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'project_id',
		'name',
		'desc',
),
));


?>
