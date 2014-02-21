<?php
$this->breadcrumbs=array(
	'Projects',
);

$this->menu=array(
array('label'=>'Create Project','url'=>array('create')),
array('label'=>'Manage Project','url'=>array('admin')),
);
?>

<h1>Projects</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
