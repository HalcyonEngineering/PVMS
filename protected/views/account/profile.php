<?php
	$this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		'alerts'=>array( // configurations per alert type
		                 'success'=>array(), // success, info, warning, error or danger
		                 'error'=>array(), // success, info, warning, error or danger
		),
	));
?>

<div id = "profile">
<?php
	echo CHtml::tag('h1', array(), 'My Profile', false);
	$this->widget('bootstrap.widgets.TbButton',
	              array('buttonType' => 'link',
	                    'type' => 'link', // the chrome of the button
	                    'label' => 'edit', // text of the button
	                    'htmlOptions' => array(
		                    'onclick'=>"$('.form').show();$('#profile').hide();"
	                    ),
	              )
	);
	echo CHtml::closeTag('h1');

	$this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
	    'attributes'=>array(
		    'name',
	        'location',
	        'skillset',
	    ),
	));
?>
</div>
<div class="form" style='display:none;'>
<?php
    $form = $this->beginWidget(
                 'bootstrap.widgets.TbActiveForm',
                 array(
	                 'id'=>'profile-form',
	                 'enableClientValidation'=>true,
	                 'clientOptions'=>array('validateOnSubmit'=>true,),
	                 'enableAjaxValidation'=>false,
                 )
    );
?>

<h2>Update Profile</h2>
<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row radiogroup">
	<?php
		$avail = array(
			0=>'Not available',
			1=>'Weekdays',
			2=>'Weekends',
			3=>'Weekdays & Weekends',
		);
		echo $form->radioButtonListRow($model, 'availability', $avail,
		                               array('labelOptions'=>array('style'=>'font: normal 11pt Calibri;'))
		);
	?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'location'); ?>
	<?php $this->widget('CAutoComplete', array(
		'model'=>$model,
		'attribute'=>'location',
		'url'=>array('/volunteer/suggestLocation'),
		'multiple'=>true,
		'htmlOptions'=>array( 'placeholder'=>"City name only"),
	)); ?>
	<p class="hint">Separate multiple cities with commas.</p>
	<?php echo $form->error($model,'location'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'skillset'); ?>
	<?php $this->widget('CAutoComplete', array(
		'model'=>$model,
		'attribute'=>'skillset',
		'url'=>array('/volunteer/suggestSkillset'),
		'multiple'=>true,
		'htmlOptions'=>array('placeholder'=>"Separate with commas"),
	)); ?>
	<p class="hint">Please separate different skills with commas.</p>
	<?php echo $form->error($model,'skillset'); ?>
</div>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Update',
	)); ?>
	<?php
		$this->widget('bootstrap.widgets.TbButton',
		              array('buttonType' => 'link',
		                    'type' => 'common', // the chrome of the button
		                    'label' => 'cancel', // text of the button
		                    'htmlOptions' => array(
			                    'onclick'=>"$('.form').hide();$('#profile').show();"),
		              ));
	?>
</div>

<?php $this->endWidget(); ?>

</div>