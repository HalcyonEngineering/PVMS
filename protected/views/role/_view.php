<div class="tile-view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>

<h3 style="margin: 0px;"> <b><?php echo CHtml::encode($data->name); ?></b></h3>

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
    $this->widget(
                  'bootstrap.widgets.TbButton',
                  array(
                        'label' => 'View',
                        'type' => 'primary',
                        'url' => array('/role/view','id'=>$data->id),
                        )
                  );
    ?>

<?php
    Yii::import('bootstrap.helpers.TbHtml');
    $this->widget('bootstrap.widgets.TbButton',
                  array('icon' => TbHtml::ICON_TRASH,
                        'type' => 'link',
                        'buttonType' => 'link',
                        'url'=> Yii::app()->controller->createUrl('/volunteer/removeFromRole',
                                                                  array("volunteer_id"=>Yii::app()->user->id, "role_id"=>$data->id)),
                        'htmlOptions'=>array(
                                             'class' => 'pull-right',
                                             'confirm' => 'Do you want to opt-out of this role?',
                                             'title' => 'Opt Out of Role',
                                             'data-toggle'=>'tooltip'),
                        )
                  );
    ?>


</div></div>
</div>
