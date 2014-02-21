<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Task','url'=>array('index')),
array('label'=>'Create Task','url'=>array('create')),
array('label'=>'Update Task','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Task','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Task','url'=>array('admin')),
);
?>

<h1>View Task #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'role_id',
		'name',
		'desc',
		'expected',
		'actual',
),
)); ?>
