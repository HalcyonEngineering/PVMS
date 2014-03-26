<?php
/* @var $this AccountController */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>
<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<?php echo $form->textFieldRow($model,'username'); ?>


	<?php echo $form->passwordFieldRow($model,'password'); ?>
        <p class="hint">
            You can also register <?php echo CHtml::link('here', array('account/register')) ?>
        </p>
	</div>

		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>


	<div class="form-actions">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
