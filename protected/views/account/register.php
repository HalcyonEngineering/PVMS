<?php
/* @var $this AccountController */
/* @var $model User */
/* @var $form CActiveForm */
$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
    'Register',
);?>

<?php if(Yii::app()->user->hasFlash('register.success')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('register.success'); ?>
</div>
<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
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

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		<?php echo $form->passwordField($model,'newPassword'); ?>
		<?php echo $form->error($model,'newPassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verifyPassword'); ?>
		<?php echo $form->passwordField($model,'verifyPassword'); ?>
		<?php echo $form->error($model,'verifyPassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model, 'type',
            array(
                $model::VOLUNTEER=>'Volunteer',
                $model::MANAGER=> 'Manager',
                $model::ADMINISTRATOR=>'Administrator',
            )) ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->