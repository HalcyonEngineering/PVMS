<?php
$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Organization','url'=>array('index')),
array('label'=>'Manage Organization','url'=>array('admin')),
);
?>

<h1>Create Organization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>