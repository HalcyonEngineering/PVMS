<?php
$this->breadcrumbs=array(
	'Projects',
);

$this->menu=array(
                  array('label'=>'List Project','url'=>array('index')),
                  array('label'=>'Manage Project','url'=>array('admin')),
                  array('label'=>'Create Project','url'=>array('create')),
);
?>

<h1>Projects</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
