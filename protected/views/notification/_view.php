<?php
/*
 *  @var $this NotificationController
 */
  $status = ($data->read_status == 1) ? 'read' : 'unread';
   echo "<div class='view $status'>";
    ?>
<div class="span-1 pull-right last">
    <?php
    if ($data->read_status == Notification::STATUS_READ){
        $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'label' => '.',
            'type' => 'default',
            'size' => 'mini',
            'tooltip' => true,
            'url'=>$this->createURL('/notification/unread',array('noti_id'=>$data->id)),
            'tooltipOptions' => array(
                'placement' => 'top',
                'title' => 'Tooltip title',
                'delay' => array(
                    'show' => 0,
                    'hide' => 0,
                ),
            ),
            'htmlOptions' => array(
                'title' => 'Mark as  "Unread"',
            ),
        )
    );
    }

    if ($data->read_status == Notification::STATUS_UNREAD){
        $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => '.',
                'type' => 'success',
                'size' => 'mini',
                'tooltip' => true,
                'url'=>$this->createURL('/notification/read',array('noti_id'=>$data->id)),
                'tooltipOptions' => array(
                    'placement' => 'top',
                    'title' => 'Tooltip title',
                    'delay' => array(
                        'show' => 0,
                        'hide' => 0,
                    ),
                ),
                'htmlOptions' => array(
                    'title' => 'Mark as  "Read"',
                ),
            )
        );
    }

    ?>
</div>

    <b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
    <?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime($data->timestamp), 'YY/DD/MM'); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

<a href="<?php echo Yii::app()->createUrl('notification/readOnSelect',array('noti_id' =>$data->id)); ?>"><span id="span_read"></span></a>

</div>
