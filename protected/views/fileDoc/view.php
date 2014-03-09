<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List FileDoc','url'=>array('index')),
array('label'=>'Create FileDoc','url'=>array('create')),
array('label'=>'Update FileDoc','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete FileDoc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FileDoc','url'=>array('admin')),
);
?>

<h1>View FileDoc #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'project_id',
		'file_name',
		'file_size',
		'file_data',
),
)); ?>
