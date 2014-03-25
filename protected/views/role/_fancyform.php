<div class="data-display">
	<h1><?php echo $model->name; ?></h1>
	<?php
		if (Yii::app()->user->isManager()){
			$this->widget('bootstrap.widgets.TbButton',
			              array('buttonType' => 'link',
			                    'type' => 'link', // the chrome of the button
			                    'label' => 'edit', // text of the button
			                    'htmlOptions' => array('onclick'=>"$('#role-onboarding-form').show();$('.data-display').hide();"),
			              )
			);
	}
	?>
	<?php echo $model->desc; ?><br /><br /><br />
	<h4>Onboarding information:</h4>
	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$onboardingModel,
		'attributes'=>array(
			'onboarding_welcome',
			'onboarding_instructions',
			'onboarding_contact',
		),
	)); ?>
</div>

<?php
	if(Yii::app()->user->isManager()){
		$this->renderPartial('/role/_form',
		                     array('model'=>$model,
		                           'onboardingModel'=>$onboardingModel,
		                           'embeddedForm'=>true));
	}
?>
