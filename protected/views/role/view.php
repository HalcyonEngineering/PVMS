<?php if(Yii::app()->user->isManager()){
	$projectName = $model->project->name;
	$this->breadcrumbs=array(
		"$projectName"=>array('project/view', 'id'=>$model->project->id),
		$model->name,
	);
} ?>

<h1>
<?php
	$this->widget('bootstrap.widgets.TbEditableField',
	              array(
		              'type'=>'text',
		              'model'=>$model,
		              'attribute'=>'name',
		              'apply'=>false,
	              )
	);


?>
</h1>

<p><?php
	$this->widget('bootstrap.widgets.TbEditableField',
	              array(
		              'type'=>'textarea',
		              'model'=>$model,
		              'attribute'=>'desc',
		              'apply'=>false,
	              )
	);

	?></p>

<h1>OnboardingDoc model:</h1>
<?php
if ($onboardingModel != null){
	$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$onboardingModel,
	'attributes'=>array(
	    'onboarding_welcome',
	    'onboarding_instructions',
	    'onboarding_contact',
	),
	));
}
?>
<?php
	$taskDataProvider = new CActiveDataProvider('Task', array ('criteria' => array ('condition' => 'role_id=' . $model->id,),));
	$this->renderPartial('/task/_tasks', array ('dataProvider' => $taskDataProvider));

?>
<div class="span-9 pull-right" ><!--Buttons-->
<div class="span-3" style="padding:5px;" >
<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
                          'url' => Yii::app()->createUrl("role/index"),
                          'label' => 'Back to Roles',
                          ));
    ?>
</div>
<div class="span-3" style="padding:5px;" >
<?php $this->widget('ModalOpenButton',
                    array(
                      'button_id'=>'list-project-files-btn',
                      'url' => Yii::app()->createUrl("fileDoc/listParentFiles",array("role_id"=>$model->id)),
                      'label' => 'View files in project',
                      'type' => 'common',
                    ));
?>
</div>
<div class="span-3" style="padding:5px;" >
<?php $this->widget('ModalOpenButton',
                    array(
                      'button_id'=>'list-tasks-btn',
                      'url' => Yii::app()->createUrl("task/listTasks",array("role_id"=>$model->id)),
                      'label' => 'View tasks for role',
                      'type' => 'common',
                    ));
?>
</div>
<div class="span-3" style="padding:5px;" >
<?php
if (Yii::app()->user->isManager()){
	$this->widget('ModalOpenButton',
	                    array(
	                      'button_id'=>'create-task-btn',
	                      'url' => Yii::app()->createUrl("task/create",array("role_id"=>$model->id)),
	                      'label' => 'Create task for role',
	                      'type' => 'common',
	                    ));
}
?>
</div>
</div><!--End of Buttons-->
