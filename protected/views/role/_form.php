<?php 
	if (isset($defaultToForm) && $defaultToForm == true) {
		$formVisibilityDefault = 'display:initial';
		$displayVisibilityDefault = 'display:none';
	} else {
		$formVisibilityDefault = 'display:none';
		$displayVisibilityDefault = 'display:initial';
	}
?>

<div class="toggle-button" style="display:initial">
	<?php 
	if (isset($displayButton)) {
		if ($displayButton == true) {
			$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'link',
														    'type' => 'primary', // the chrome of the button
														    'label' => 'edit', // text of the button
														    'htmlOptions' => array('onclick'=>"$('.form-rows').toggle();$('.data-display').toggle();$('.toggle-button').toggle();"),
		    ));
		} 
	}
	?>
</div>

<div class="form-rows" style="<?php echo $formVisibilityDefault?>">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'role-onboarding-form', //TODO: merge this into the view.php to avoid code reuse
	'enableAjaxValidation'=>true,
	)); ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary(array($model,$onboardingModel)); ?>
	<?php echo $form->hiddenField($model,'project_id'); ?>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>
	<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->colorpickerRow($model,'colour'); ?>
	<?php echo $form->hiddenField($onboardingModel,'role_id'); ?>
	<?php echo $form->textAreaRow($onboardingModel,'onboarding_welcome',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->textAreaRow($onboardingModel,'onboarding_instructions',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->textAreaRow($onboardingModel,'onboarding_contact',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>

<div class="data-display" style="<?php echo $displayVisibilityDefault?>">
	<h1>Role model:</h1>
	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	    'name',
	    'desc',
	),
	)); ?>
	<h1>OnboardingDoc model:</h1>
	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$onboardingModel,
	'attributes'=>array(
	    'onboarding_welcome',
	    'onboarding_instructions',
	    'onboarding_contact',
	),
	)); ?>
</div>
