<?php

$status = ($data->read_status == 1) ? 'small_read' : 'small_unread';
echo "<div class='smallNotification $status'>";
?>


<!--	<b><?php /*echo CHtml::encode($data->getAttributeLabel('description')); */?>:</b>-->
	<?php echo CHtml::encode($data->description); ?>
	<br />

<!--	<b><?php /*echo CHtml::encode($data->getAttributeLabel('timestamp')); */?>:</b>-->
	<?php echo CHtml::encode(Yii::app()->dateFormatter->formatDateTime($data->timestamp), 'YY/DD/MM'); ?>
	<br />

<!--	<b><?php /*echo CHtml::encode($data->getAttributeLabel('link')); */?>:</b>
	<?php /*echo CHtml::encode($data->link); */?>
	<br />-->

    <?php ($data->read_status == 1) ? 'read' : 'unread'; ?>
</div>