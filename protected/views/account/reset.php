<?php
/* @var $this AccountController */

$this->breadcrumbs=array(
	'Account'=>array('/account'),
	'Reset',
);
?>

<?php
// Render them all with single `TbAlert`
$this->widget('bootstrap.widgets.TbAlert', array(
	'block' => true,
	'fade' => true,
	'closeText' => '&times;', // false equals no close link
	'events' => array(),
	'htmlOptions' => array(),
	'userComponentId' => 'user',
	'alerts' => array( // configurations per alert type
	// success, info, warning, error or danger
		'success' => array('closeText' => '&times;'),
		'info', // you don't need to specify full config
		'warning' => array('block' => false, 'closeText' => false),
		'error' => array('block' => false)
		),
	)
);
?>

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
		array('buttonType' => 'submit', 'label' => 'Submit')
		);
	?>
</div>
 
<?php 
$this->endWidget();
unset($form);
?>
