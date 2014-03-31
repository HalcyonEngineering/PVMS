<?php 
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm', 
        array(
            'id'=>'add-volunteer-manual-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array('validateOnSubmit'=>true,),
            'enableAjaxValidation'=>true,
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

<div class="row radiogroup">
    <?php
        $status = array(
            0=>'Not available',
            1=>'Weekdays',
            2=>'Weekends',
            3=>'Weekdays & Weekends',
        );
        $userModel->availability = 0;
        echo $form->radioButtonListRow($userModel, 'availability', $status,
            array('labelOptions'=>array('style'=>'font: normal 11pt Calibri;'))
        );
    ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'location'); ?>
    <?php $this->widget('CAutoComplete', array(
        'model'=>$userModel,
        'attribute'=>'location',
        'url'=>array('suggestLocation'),
        'multiple'=>true,
        'htmlOptions'=>array('size'=>50, 'placeholder'=>"City name only"),
    )); ?>
    <p class="hint">Please separate multiple cities with commas.</p>
    <?php echo $form->error($userModel,'location'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'skillset'); ?>
    <?php $this->widget('CAutoComplete', array(
        'model'=>$userModel,
        'attribute'=>'skillset',
        'url'=>array('suggestSkillset'),
        'multiple'=>true,
        'htmlOptions'=>array('size'=>50, 'placeholder'=>"Separate with commas"),
    )); ?>
    <p class="hint">Please separate different skills with commas.</p>
    <?php echo $form->error($userModel,'skillset'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'phoneNumber'); ?>
    <?php echo $form->textField($userModel,'phoneNumber'); ?>
    <?php echo $form->error($userModel,'phoneNumber'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($userModel,'address'); ?>
    <?php echo $form->textField($userModel,'address'); ?>
    <?php echo $form->error($userModel,'address'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>
