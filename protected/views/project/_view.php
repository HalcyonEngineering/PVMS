<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('/project/view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode("Organization " . $data->org->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->org->name), array('/organization/view', 'id'=>$data->org->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('colour')); ?>:</b>
	<?php echo CHtml::encode($data->colour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('target')); ?>:</b>
	<?php echo CHtml::encode($data->target); ?>
	<br />

	<?php
	$this->widget('ModalOpenButton',
	              array('label' => 'Edit Project',
	                    'type' => 'primary',
	                    'button_id'=>'edit-project-'.$data->id,
	                    'url' => Yii::app()->createUrl("project/update", array("id"=>$data->id))
	              )
	);

	?>
</div>
