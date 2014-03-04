<?php
$this->breadcrumbs=array(
	'File Docs',
);

$this->menu=array(
array('label'=>'Create FileDoc','url'=>array('create')),
array('label'=>'Manage FileDoc','url'=>array('admin')),
);
?>

<h1>File Docs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
