<?php
/* @var $this AccountController */
/* @var $model User */
/* @var $form bootstrap.widgets.TbActiveForm */
$this->pageTitle=Yii::app()->name . ' - Password Reset';
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

<h1><?php echo "Password Reset"; ?></h1>

<p>
	Please enter your new password below.
</p>

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

    <?php echo $form->errorSummary($model); ?>
<table>
<tr>
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
