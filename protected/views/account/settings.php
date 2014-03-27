<?php
/* @var $this AccountController */
/* @var $model User */
/* @var $form bootstrap.widgets.TbActiveForm */
$this->pageTitle=Yii::app()->name . ' - Settings';
?>

<?php
	$this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		'alerts'=>array( // configurations per alert type
		                 'success'=>array(), // success, info, warning, error or danger
		                 'error'=>array(), // success, info, warning, error or danger
		),
	)
);
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'user-settings-form',
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
<table>
<tr>
<td>
	<?php echo $form->textFieldRow($model, 'name'); ?>

	<?php echo $form->emailFieldRow($model, 'email'); ?>

    <?php echo $form->passwordFieldRow($model,'origPassword'); ?>
</td>
<td>
    <?php echo $form->passwordFieldRow($model,'newPassword'); ?>

    <?php echo $form->passwordFieldRow($model,'verifyPassword'); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
</td>
</tr>
</table>
    <?php $this->endWidget();
	unset($form);
	?>

</div><!-- form -->
