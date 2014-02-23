<?php

class WebUser extends CWebUser {

	private $_model;

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

	function managedOrg(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $user->managedOrg;
	}

	function isVolunteer() {
		$user = $this->loadUser(Yii::app()->user->id);

		return !$this->isGuest && ($user->type == User::VOLUNTEER);
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
