<?php 
    $form = $this->beginWidget(
        'CActiveForm', 
        array(
            'id'=>'add-volunteer-manual-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array('validateOnSubmit'=>true,),
            'enableAjaxValidation'=>false,
        )
    ); 
?>

<h2>By Form</h2>
<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($userModel); ?>

<div class="row">
    <?php echo $form->labelEx($userModel,'name'); ?>
    <?php echo $form->textField($userModel,'name'); ?>
    <?php echo $form->error($userModel,'name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'email'); ?>
    <?php echo $form->emailField($userModel,'email'); ?>
    <?php echo $form->error($userModel,'email'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'location'); ?>
    <?php echo $form->textField($userModel,'location', array('size' => 30, 'maxlength' => 30)); ?>
    <?php echo $form->error($userModel,'location'); ?>
</div>

<?php echo $form->labelEx($userModel, 'availability'); ?>
<div class="row checkbox">
    <?php echo CHtml::checkBox('Morning', true);  echo ' Morning<br>'; ?>
    <?php echo CHtml::checkBox('Evening', true);  echo ' Evening<br>'; ?>
    <?php echo CHtml::checkBox('Weekdays', true); echo ' Weekdays<br>'; ?>
    <?php echo CHtml::checkBox('Weekends', true); echo ' Weekends<br>'; ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'skillset'); ?>
    <?php $this->widget('CAutoComplete', array(
        'model'=>$userModel,
        'attribute'=>'skillset',
        'url'=>array('suggestSkillset'),
        'multiple'=>true,
        'htmlOptions'=>array('size'=>50),
    )); ?>
    <p class="hint">Please separate different skills with commas.</p>
    <?php echo $form->error($userModel,'skillset'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>
