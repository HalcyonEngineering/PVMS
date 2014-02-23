<?php
$this->breadcrumbs=array(
	'Organizations',
);

$this->menu=array(
array('label'=>'List Organization','url'=>array('index')),
array('label'=>'Manage Organization','url'=>array('admin')),
array('label'=>'Create Organization','url'=>array('create')),
);
?>

<h1>Organizations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
