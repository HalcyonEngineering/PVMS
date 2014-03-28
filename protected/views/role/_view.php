<div class="tile-view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>

<h3> <b><?php echo CHtml::link(CHtml::encode($data->name),array('/role/view','id'=>$data->id)); ?></b></h3>
    <br />



	<?php echo CHtml::encode($data->desc); ?>
	<br /><br />

    <b><?php echo CHtml::encode('Project'); ?>:</b>
    <?php echo CHtml::encode($data->project->name); ?>
    <br /><br />

<b><?php echo CHtml::encode('Project Description'); ?>:</b>
<?php echo CHtml::encode($data->project->desc); ?>
<br /><br />


	<b><?php echo CHtml::encode('Number of Volunteers'); ?>:</b>
	<?php echo CHtml::encode(count($data->users)); ?>
	<br />
	<?php
		$this->renderPartial('/task/_progressBar',array('data'=>$data));
	?>



<?php
    /* Trying to workout opt out functionality
    Yii::import('bootstrap.helpers.TbHtml');
    $this->widget('bootstrap.widgets.TbButton',
                  array('label' => TbHtml::icon(TbHtml::ICON_TRASH),
                        'type' => 'link',
                        'encodeLabel' =>false,
                        'url'=>'Yii::app()->createUrl("volunteer/remove",array("id"=>$data->id))',
                        )
                  );*/
    ?>


</div>
</div>
