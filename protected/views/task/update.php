<?php
/**
 * @var $model Task
 */
$projectName = $model->role->project->name;
$roleName = $model->role->name;
$this->breadcrumbs=array(
	"$projectName"=>array('project/view', 'id'=>$model->role->project->id),
	"$roleName" =>array('role/view','id'=>$model->role->id),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>
	<h1>Update Task <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>