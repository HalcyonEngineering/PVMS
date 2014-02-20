<?php
$this->breadcrumbs=array(
	'Organizations',
);

$this->menu=array(
array('label'=>'Create Organization','url'=>array('create')),
array('label'=>'Manage Organization','url'=>array('admin')),
);
?>

<h1>Organizations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
