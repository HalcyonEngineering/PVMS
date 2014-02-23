<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
                  array('label'=>'List Project','url'=>array('index')),
                  array('label'=>'Manage Project','url'=>array('admin')),
                  array('label'=>'Create Project','url'=>array('create')),
);
?>

<h1>Create Project</h1>

<?php echo $this->renderPartial('/project/_form', array('model'=>$model)); ?>
