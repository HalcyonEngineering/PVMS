<?php

class WebUser extends CWebUser {

	private $_model;
	public $isAdminAccess = false;

	function getEmail() {
		$user = $this->loadUser(Yii::app()->user->id);
		if ($user === null){
			return null;
		}
		return $user->email;
	}

	function getFullName() {
		$user = $this->loadUser(Yii::app()->user->id);
		if ($user === null){
			return null;
		}
		return $user->fullName;
	}

	function isAdmin() {
		$user = $this->loadUser(Yii::app()->user->id);

		return !$this->isGuest && ($user->type == User::ADMINISTRATOR);
	}

	function isManager() {
		$user = $this->loadUser(Yii::app()->user->id);

		return !$this->isGuest && ($user->type == User::MANAGER);
	}

	function getManagedOrg(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $user->managedOrg;
	}

	function isVolunteer() {
		$user = $this->loadUser(Yii::app()->user->id);

		return !$this->isGuest && ($user->type == User::VOLUNTEER);
	}
	
	function setAdminAccess() {
		$this->isAdminAccess = true;
	}
	
	function isAdminAccess() {
		return $this->isAdminAccess;
	}


	protected function loadUser($id = null) {
		if ($this->_model === null) {
			if ($id !== null) {
				$this->_model = User::model()->findByPk($id);
			}
		}

		return $this->_model;
	}
}

?>
