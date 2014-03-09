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

	<?php $this->widget('bootstrap.widgets.TbButton',
	                    array(
		                    'label'=> 'Edit Project',
		                    'type' => 'primary',

		                    'htmlOptions'=>array(
			                    //Generate a unique id for each button.
			                    //Required to prevent id conflicts with the modal window.
			                    'id'=>'edit-project-'.$data->id,
			                    'href' => Yii::app()->createUrl("project/update", array("id"=>$data->id)),
			                    'ajax'=>array(
				                    'type'=>'POST',
				                    // ajax post will use 'url' specified above
				                    'url'=>"js:$(this).attr('href')",
				                    'update'=>'#project-modal-body',
				                    'complete'=>"$('#project-modal').modal('show')",
			                    ),
		                    ),
	                    ));

	?>
</div>
