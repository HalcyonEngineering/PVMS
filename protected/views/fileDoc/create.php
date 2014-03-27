<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List FileDoc','url'=>array('index')),
array('label'=>'Manage FileDoc','url'=>array('admin')),
);

?>

<h1>Upload Document</h1>

<?php
	echo $this->renderPartial('_form',array('model'=>$model));
?>