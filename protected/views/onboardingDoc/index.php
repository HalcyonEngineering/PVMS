<?php
$this->breadcrumbs=array(
	'Onboarding Docs',
);

$this->menu=array(
array('label'=>'Create OnboardingDoc','url'=>array('create')),
array('label'=>'Manage OnboardingDoc','url'=>array('admin')),
);
?>

<h1>Onboarding Docs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
