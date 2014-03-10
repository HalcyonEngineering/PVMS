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
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
