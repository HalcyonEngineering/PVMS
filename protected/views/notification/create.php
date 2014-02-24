<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Notification','url'=>array('index')),
array('label'=>'Manage Notification','url'=>array('admin')),
);
?>

<h1>Create Notification</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>