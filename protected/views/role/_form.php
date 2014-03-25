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
														    'type' => 'link', // the chrome of the button
														    'label' => 'edit', // text of the button
														    'htmlOptions' => array('onclick'=>"$('.form-rows').toggle();$('.data-display').toggle();$('.toggle-button').toggle();"),
		    ));
		} 
	}
	?>
</div>

<div class="data-display" style="<?php echo $displayVisibilityDefault?>">
	<h1><?php echo $model->name; ?></h1>
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

<div class="form-rows" style="<?php echo $formVisibilityDefault?>">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'role-onboarding-form', //TODO: merge this into the view.php to avoid code reuse
	'enableAjaxValidation'=>true,
    

	)); ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary(array($model,$onboardingModel)); ?>
	<?php echo $form->hiddenField($model,'project_id'); ?>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>128)); ?>
	<?php echo $form->colorpickerRow($model,'colour'); ?>
	<?php echo $form->textAreaRow($model,'desc',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
	<?php echo $form->hiddenField($onboardingModel,'role_id'); ?>
	<?php echo $form->textAreaRow($onboardingModel,'onboarding_welcome',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
	<?php echo $form->textAreaRow($onboardingModel,'onboarding_instructions',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
	<?php echo $form->textAreaRow($onboardingModel,'onboarding_contact',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
		<?php 
		if (isset($displayButton)) {
			if ($displayButton == true) {
				$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'link',
															    'type' => 'common', // the chrome of the button
															    'label' => 'cancel', // text of the button
															    'htmlOptions' => array('onclick'=>"$('.form-rows').toggle();$('.data-display').toggle();$('.toggle-button').toggle();"),
			    ));
			} 
		}
		?>
	</div>
	<?php $this->endWidget(); ?>
</div>
