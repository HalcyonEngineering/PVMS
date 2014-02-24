<?php
	$curUser=User::model()->findByPK(Yii:app()->user->id)
	echo CHtml::encode('Notification');
	foreach ($curUser->notifications as $notification) {
		$this->renderPartial('/notification/_notification', array ('data' => $notification));
	}
?>