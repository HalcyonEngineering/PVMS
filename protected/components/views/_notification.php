<?php

$status = ($data->read_status == 1) ? 'small_read' : 'small_unread';
echo CHtml::tag('div', array('class'=>"smallNotification ".$status));
?>

	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime($data->timestamp), 'YY/DD/MM'); ?>
	<br />

    <a href="<?php echo Yii::app()->createUrl('notification/readOnSelect',array('noti_id' =>$data->id)); ?>" id="my_a" style="line-height: 0px;"><span id="span_read2"></span></a>
<?php
echo CHtml::closeTag("div");

?>
