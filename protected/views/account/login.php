<?php
/* @var $this AccountController */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>
<div class="Login-content">
	<div class="Login-wallpaper">
	<?php
		$this->widget('bootstrap.widgets.TbAlert', array(
			'alerts'=>array(
			    'error',
			),

		));
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
	<?php
		//echo '<p class="hint">';
		//echo "You can also register ".CHtml::link('here', array('account/register'));
		//echo '</p>';
	?>
	</div>

		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
	<div class="form-actions">
		<?php echo CHtml::submitButton('Login');?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
</div>