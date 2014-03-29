<?php
if(isset($embeddedForm) && $embeddedForm){
	$visibility = 'display:none;';
}	else {
	$visibility = 'display:initial;';
}
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'role-onboarding-form', //TODO: merge this into the view.php to avoid code reuse
		'enableAjaxValidation'=>true,
		'htmlOptions'=>array(
			'style'=>$visibility,
		)
	));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary(array($model,$onboardingModel)); ?>
<?php echo $form->hiddenField($model,'project_id'); ?>
<?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>128)); ?>
<?php

	echo $form->colorpickerRow($model,
	                           'colour',
	                           array(
		                           'events'=>array(
			                           'changeColor'=>'js:function(ev){
		                                console.log(ev.color.toHex());
		                                $(".colorpicker-inner").parents(".add-on").css("background-color", ev.color.toHex());
		                           }'
		                           ),
	                           ),
	                           array(
		                           'placeholder'=>'Click here to select a colour',
		                           'prepend'=>"<i class='colorpicker-inner'></i>",
		                           'prependOptions'=>array(
			                           'style'=>"background-color : $model->colour;",
		                           ),
	                           )
	);

?>
<?php echo $form->textAreaRow($model,'desc',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
<?php echo $form->hiddenField($onboardingModel,'role_id'); ?>
<?php echo $form->textAreaRow($onboardingModel,'onboarding_welcome',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
<?php echo $form->textAreaRow($onboardingModel,'onboarding_instructions',array('rows'=>1, 'cols'=>50, 'class'=>'span5')); ?>
<?php echo $form->textAreaRow($onboardingModel,'onboarding_contact',array('rows'=>3, 'cols'=>50, 'class'=>'span5', 'placeholder'=> "Ex. Supervisor: John Smith  Email: johnsmith@pitchn.ca Phone Number: XXX-XXX-XXXX")); ?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>
	<?php
		if (isset($embeddedForm) && $embeddedForm == true) {
			$this->widget('bootstrap.widgets.TbButton',
			              array('buttonType' => 'link',
			                    'type' => 'common', // the chrome of the button
			                    'label' => 'cancel', // text of the button
			                    'htmlOptions' => array(
				                    'onclick'=>"$('#role-onboarding-form').hide();$('.data-display').show();"),
			              ));
		}
	?>
</div>
<?php $this->endWidget(); ?>
