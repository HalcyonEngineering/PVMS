<div class="view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>

    <!-- <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>-->
<h3> <b><?php echo CHtml::link(CHtml::encode($data->name),array('/role/view','id'=>$data->id)); ?></b></h3>
    <br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('/role/view','id'=>$data->id)); ?>
	<br />-->

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />-->

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>-->
	<?php echo CHtml::encode($data->desc); ?>
	<br /><br />

    <b><?php echo CHtml::encode('Project'); ?>:</b>
    <?php echo CHtml::encode($data->project_id); ?>
    <br /><br />

	<b><?php echo CHtml::encode('Number of Volunteers'); ?>:</b>
	<?php echo CHtml::encode(count($data->users)); ?>
	<br />
	<?php
		$this->renderPartial('/task/_progressBar',array('data'=>$data));
	?>
</div>
</div>
