<?php
$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Organization','url'=>array('index')),
array('label'=>'Create Organization','url'=>array('create')),
array('label'=>'Update Organization','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Organization','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Organization','url'=>array('admin')),
);
?>

<h1>View Organization #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'desc',
),
)); ?>
