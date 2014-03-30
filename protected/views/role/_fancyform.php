<?php
	/**
	 * RoleController $this
	 * Role $model
	 * OnboardingDoc $onboardingDoc
	 *
	 */
	$purifier = new CHtmlPurifier();
?>

<div class="data-display">
	<h1><?php echo $purifier->purify($model->name);
			if (Yii::app()->user->isManager()){
				$this->widget('bootstrap.widgets.TbButton',
				              array('buttonType' => 'link',
				                    'type' => 'link', // the chrome of the button
				                    'label' => 'edit', // text of the button
				                    'htmlOptions' => array(
					                    'onclick'=>"$('#role-onboarding-form').show();$('.data-display').hide();"
				                    ),
				              )
				);
			}
		?></h1>
	<?php
		echo $purifier->purify(nl2br($model->desc));
	?>
	<br />
	<br />
<?php $this->renderPartial('/onboardingDoc/_view', array('model'=>$onboardingModel)); ?>

<br />
	<br />

</div>

<?php
	if(Yii::app()->user->isManager()){
		$this->renderPartial('/role/_form',
		                     array('model'=>$model,
		                           'onboardingModel'=>$onboardingModel,
		                           'embeddedForm'=>true));
	}
?>
