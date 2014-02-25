<?php
$this->breadcrumbs=array(
	'Onboarding Docs'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List OnboardingDoc','url'=>array('index')),
array('label'=>'Manage OnboardingDoc','url'=>array('admin')),
);
?>

<h1>Create OnboardingDoc</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>