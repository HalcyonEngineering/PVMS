<?php
/* @var $this AccountController */

$this->breadcrumbs=array(
	'Account'=>array('/account'),
	'Reset',
);
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
	<?php $this->widget('bootstrap.widgets.TbAlert', array(
		'userComponentId' => 'user',
		'alerts' => array('success'),)
	)
	?>
</div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('error'); ?>
	<?php $this->widget('bootstrap.widgets.TbAlert', array(
		'userComponentId' => 'user',
		'alerts' => array('error'),)
	)
	?>
</div>
<?php endif; ?>

<h1><?php echo "Forgot your password?"; ?></h1>

<p>
	Please enter your email address. A password reset email will be sent.
</p>

<?php
	$form = $this->beginWidget(
		'bootstrap.widgets.TbActiveForm',
		array(
			'id' => 'verticalForm',
			//'htmlOptions' => array('class' => 'well'), // for inset effect
		)
	);
?>


	
<div> 
	<?php echo $form->textFieldRow($model, 'email', array('class' => 'span3'));?>
</div>

<div> 
	<?php
		$this->widget(
		'bootstrap.widgets.TbButton',
		array('buttonType' => 'submit', 'label' => 'Login')
		);
	?>
</div>
 
<?php 
$this->endWidget();
unset($form);
?>
