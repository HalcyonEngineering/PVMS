<?php
$this->breadcrumbs=array(
	'Onboarding Docs'=>array('index'),
	$model->role_id=>array('view','id'=>$model->role_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List OnboardingDoc','url'=>array('index')),
	array('label'=>'Create OnboardingDoc','url'=>array('create')),
	array('label'=>'View OnboardingDoc','url'=>array('view','id'=>$model->role_id)),
	array('label'=>'Manage OnboardingDoc','url'=>array('admin')),
	);
	?>

	<h1>Update OnboardingDoc <?php echo $model->role_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>