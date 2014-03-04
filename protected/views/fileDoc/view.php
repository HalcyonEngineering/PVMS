<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	$model->project_id,
);

$this->menu=array(
array('label'=>'List FileDoc','url'=>array('index')),
array('label'=>'Create FileDoc','url'=>array('create')),
array('label'=>'Update FileDoc','url'=>array('update','id'=>$model->project_id)),
array('label'=>'Delete FileDoc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->project_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FileDoc','url'=>array('admin')),
);
?>

<h1>View FileDoc #<?php echo $model->project_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'project_id',
		'data',
),
)); ?>
