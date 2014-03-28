<div class="tile-view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>
		<h3><b><?php echo CHtml::link(CHtml::encode($data->name),array('/project/view','id'=>$data->id)); ?></b></h3>
        <div class="tile-top">
	    <?php echo CHtml::encode($data->desc); ?>
	    <br />  <br />

       </div>
      <div class="tile-bottom">
<?php if (!empty($data->target)):?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('target').":"); ?></b><br />
	<!-- eeee MMMM d yyyy -->
		<?php
	echo Yii::app()->dateFormatter->format('eeee, MMMM d yyyy', $data->target);



	?></br>
<?php endif; ?>
		<?php

		$this->renderPartial('/task/_progressBar',array('data'=>$data));
		?>

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
</div>
