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
$auth=Yii::app()->authManager;
/**
 * @var $auth CPhpAuthManager
 */
$auth->clearAll();

$role=$auth->createRole('Volunteer','Volunteer', 'return Yii::app()->user->hasRole($params{\'role_id\']);');

$role=$auth->createRole('Manager', 'Manager', 'return true;');
$role->addChild('Volunteer');

$role=$auth->createRole('Admin');


$auth->save();


?>
