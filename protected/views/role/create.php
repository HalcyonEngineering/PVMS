<div><h1>Add Role to <?php echo CHtml::encode($model->project->name)?></h1></div>

<?php echo $this->renderPartial('/role/_form', array('model'=>$model,'onboardingModel'=>$onboardingModel,'displayButton'=>false,'defaultToForm'=>true,)); ?>
