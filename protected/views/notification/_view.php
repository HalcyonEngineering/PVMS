<?php
/*
 *  @var $this NotificationController
 */
  $status = ($data->read_status == 1) ? 'read' : 'unread';
   echo "<div class='view $status'>";
    ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
    <?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime($data->timestamp), 'YY/DD/MM'); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

    <a href="<?php echo CHtml::encode($data->link); ?>"><span id="span_read"></span></a>


<div align="right">
<?php
 $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'label' => '.',
        'type' => 'success',
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

?>
</div>

</div>

<!--</a>
</html>-->