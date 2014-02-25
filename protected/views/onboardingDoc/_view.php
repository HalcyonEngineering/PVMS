<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->role_id),array('view','id'=>$data->role_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('markdown')); ?>:</b>
	<?php echo CHtml::encode($data->markdown); ?>
	<br />


</div>