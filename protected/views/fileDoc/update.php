<?php
$this->breadcrumbs=array(
	$model->project->name=>array('/project/view', 'id'=>$model->project->id),
	$model->file_name=>array('/fileDoc/view','id'=>$model->id),
	'Update',
);

	?>

	<h1>Update Document <?php echo $model->file_name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>