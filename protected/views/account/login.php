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
			    'error', 'success'
			),

		));
		?>
<h1>Login</h1>


<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->textFieldRow($model,'username'); ?>


	<?php echo $form->passwordFieldRow($model,'password'); ?>

	<?php
		//echo '<p class="hint">';
		//echo "You can also register ".CHtml::link('here', array('account/register'));
		//echo '</p>';
	?>
	</div>

		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
<div>
<?php $this->widget(
                    'bootstrap.widgets.TbButton',
                    array(
                          'label' => 'Submit',
                          'type' => 'success',
                          'buttonType'=> 'submit',
                          )
                    );?>
</div>
	  <a href = <?php echo Yii::app()->getBaseUrl(true) . '/account/reset' ?> > 
       <font size=1px > Forgot your password? </font>
      </a>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
</div>