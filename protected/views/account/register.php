<?php
	/* @var $this AccountController */
	/* @var $model User */
	/* @var $form TbActiveForm */
	$this->pageTitle=Yii::app()->name . ' - Register';
	$this->breadcrumbs=array(
		'Register',
	);?>

<?php if(Yii::app()->user->hasFlash('success')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>

<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-register-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name'); ?>

	<?php echo $form->emailFieldRow($model,'email'); ?>

	<?php echo $form->passwordFieldRow($model,'newPassword'); ?>

	<?php echo $form->passwordFieldRow($model,'verifyPassword'); ?>

	<?php echo $form->dropDownListRow($model, 'type',
	                                  array(
		                                  $model::VOLUNTEER=>'Volunteer',
		                                  $model::MANAGER=> 'Manager',
		                                  $model::ADMINISTRATOR=>'Administrator',
	                                  ))
	?>
</div>

<div class="form-actions">
	<?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
