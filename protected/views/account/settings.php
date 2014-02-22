<?php
/* @var $this AccountController */
/* @var $model User */
/* @var $form CActiveForm */
$this->pageTitle=Yii::app()->name . ' - Settings';
$this->breadcrumbs=array(
    'Settings',
);?>


<?php if(Yii::app()->user->hasFlash('success')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php elseif(Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-settings-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>true,
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
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'origPassword'); ?>
        <?php echo $form->textField($model,'origPassword'); ?>
        <?php echo $form->error($model,'origPassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'newPassword'); ?>
        <?php echo $form->textField($model,'newPassword'); ?>
        <?php echo $form->error($model,'newPassword'); ?>
    </div>
	
    <div class="row">
        <?php echo $form->labelEx($model,'verifyPassword'); ?>
        <?php echo $form->textField($model,'verifyPassword'); ?>
        <?php echo $form->error($model,'verifyPassword'); ?>
    </div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'adminAccess'); ?>
        <?php echo $form->checkBox($model,'adminAccess'); ?>
		<?php echo $form->error($model,'adminAccess'); ?>
    </div
	
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget();
	unset($form);
	?>

</div><!-- form -->