<div class="tile-view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>

<h3 style="margin: 0px;"> <b><?php echo CHtml::link(CHtml::encode($data->name),array('/role/view','id'=>$data->id)); ?></b></h3>

<font size=1>
<?php echo CHtml::encode($data->project->name); ?>
</font>
<br /><br />


	<?php echo CHtml::encode($data->desc); ?>
	<br /><br />


<b><?php echo CHtml::encode('Project Description'); ?>:</b>
<?php echo CHtml::encode($data->project->desc); ?>
<br /><br />

<div class="tile-bottom">
	<b><?php echo CHtml::encode('Number of Volunteers'); ?>:</b>
	<?php echo CHtml::encode(count($data->users)); ?>
	<br /><br />
	<?php
		$this->renderPartial('/task/_progressBar',array('data'=>$data));
	?>

<?php
    Yii::import('bootstrap.helpers.TbHtml');
    $this->widget('bootstrap.widgets.TbButton',
                  array('label' => TbHtml::icon(TbHtml::ICON_TRASH),
                        'type' => 'link',
                        'buttonType' => 'sumbit',
                        'encodeLabel' =>false,
                        'url'=>'Yii::app()->createUrl("volunteer/remove",array("id"=>$data->id))',
                        )
                  );
    ?>


</div></div>
</div>
