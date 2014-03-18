<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->role_id),array('view','id'=>$data->role_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onboarding_welcome')); ?>:</b>
	<?php echo CHtml::encode($data->onboarding_welcome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onboarding_instructions')); ?>:</b>
	<?php echo CHtml::encode($data->onboarding_instructions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onboarding_contact')); ?>:</b>
	<?php echo CHtml::encode($data->onboarding_contact); ?>
	<br />


</div>