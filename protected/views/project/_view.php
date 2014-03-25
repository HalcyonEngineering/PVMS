<div class="tile-view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>
		<!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>-->
		<h3><b><?php echo CHtml::link(CHtml::encode($data->name),array('/project/view','id'=>$data->id)); ?></b></h3>
        <div class="tile-top">
	    <!--<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>-->
	    <?php echo CHtml::encode($data->desc); ?>
	    <br />  <br />

		<!--<b><?php echo CHtml::encode("Organization " . $data->org->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->org->name), array('/organization/view', 'id'=>$data->org->id)); ?>
		<br />  <br />-->
       </div>
      <div class="tile-bottom">
        <b><?php echo CHtml::encode($data->getAttributeLabel('target').":"); ?></b><br />
		<?php echo CHtml::encode($data->target); ?></br>

		<?php

		$this->renderPartial('/task/_progressBar',array('data'=>$data));
		?>

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

	</div>
</div>
