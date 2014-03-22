<?php

$status = ($data->read_status == 1) ? 'small_read' : 'small_unread';
echo CHtml::tag('div', array('class'=>"smallNotification ".$status));
?>

	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime($data->timestamp), 'YY/DD/MM'); ?>
	<br />

    <a href="<?php echo CHtml::encode($data->link); ?>" id="my_a" ><span id="span_read"></span></a>
<?php
echo CHtml::closeTag("div");

?>
