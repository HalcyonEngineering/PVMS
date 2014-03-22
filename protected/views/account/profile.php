<?php
echo CHtml::encode('In these roles:');
	foreach ($model->roles as $role) {
		$this->renderPartial('/role/_view', array ('data' => $role));
	}

	echo CHtml::encode('Helping these orgs:');
	foreach ($model->organizations as $org) {
		$this->renderPartial('/organization/_view', array ('data' => $org));
	}
	if(Yii::app()->user->isManager()){
		echo CHtml::encode('Managing this org:');
		$this->renderPartial('/organization/_view', array('data' => $model->managedOrg));
	}

?>
