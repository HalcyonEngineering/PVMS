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

<h1>Create FileDoc</h1>

<?php /*if (isset($project_id)) {
			echo '<h1> in project: ';
			echo $model->project_id;
			echo '</h1>';
			echo $this->renderPartial('_form',array('model'=>$model, 'project_id'=>$project_id)); 
		} else {
			echo $this->renderPartial('_form',array('model'=>$model));
		}*/

	if (isset($model->project_id)) {
		echo '<h1> in project: ';
		echo $model->project_id;
		echo '</h1>';
	}
	echo $this->renderPartial('_form',array('model'=>$model));
?>