<?php
$this->breadcrumbs=array(
	'Onboarding Docs'=>array('index'),
	$model->role_id,
);

$this->menu=array(
array('label'=>'List OnboardingDoc','url'=>array('index')),
array('label'=>'Create OnboardingDoc','url'=>array('create')),
array('label'=>'Update OnboardingDoc','url'=>array('update','id'=>$model->role_id)),
array('label'=>'Delete OnboardingDoc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->role_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage OnboardingDoc','url'=>array('admin')),
);
?>

<h1>View OnboardingDoc #<?php echo $model->role_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'role_id',
		'onboarding_welcome',
		'onboarding_instructions',
		'onboarding_contact',
),
)); ?>
