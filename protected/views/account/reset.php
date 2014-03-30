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
	Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.
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
		array('buttonType' => 'submit', 'label' => 'Reset Password', 'type' => 'success')
		);
	?>
</div>
 
<?php 
$this->endWidget();
unset($form);
?>
