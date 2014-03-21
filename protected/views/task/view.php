<?php
/**
 * @var $model Task
 */
$projectName = $model->role->project->name;
$roleName = $model->role->name;
$this->breadcrumbs=array(
	"$projectName"=>array('project/view', 'id'=>$model->role->project->id),
	"$roleName" =>array('role/view','id'=>$model->role->id),
	$model->name,
);
?>
<h1>View Task #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'role_id',
		'name',
		'desc',
		'expected',
		'actual',
),
)); ?>
