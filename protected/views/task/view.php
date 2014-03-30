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
<h1>Task: <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		
		'name',
		'desc',
		'expected',
		'actual',
),
)); ?>
