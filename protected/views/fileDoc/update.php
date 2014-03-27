<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	?>

	<h1>Update Document <?php echo $model->file_name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>