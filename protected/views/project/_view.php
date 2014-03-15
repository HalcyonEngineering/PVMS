<div class="view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>

		<!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>-->
		<h3><b><?php echo CHtml::link(CHtml::encode($data->name),array('/project/view','id'=>$data->id)); ?></b></h3>
		<br />

	    <!--<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>-->
	    <?php echo CHtml::encode($data->desc); ?>
	    <br />  <br />

		<!--<b><?php echo CHtml::encode("Organization " . $data->org->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->org->name), array('/organization/view', 'id'=>$data->org->id)); ?>
		<br />  <br />-->

		<b><?php echo CHtml::encode($data->getAttributeLabel('target')); ?>:</b>
		<?php echo CHtml::encode($data->target);?>	<br /><br />

		<?php
		$this->widget('ModalOpenButton',
		              array('label' => 'Edit Project',
		                    'type' => 'link',
		                    'button_id'=>'edit-project-'.$data->id,
		                    'url' => Yii::app()->createUrl("project/update", array("id"=>$data->id))
		              )
		);

		?>
	</div>
</div>
