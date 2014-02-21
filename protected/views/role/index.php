<?php
$this->breadcrumbs=array(
	'Roles',
);

$this->menu=array(
array('label'=>'Create Role','url'=>array('create')),
array('label'=>'Manage Role','url'=>array('admin')),
);
?>

<h1>Roles</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
