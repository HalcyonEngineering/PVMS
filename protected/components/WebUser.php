<?php

class WebUser extends CWebUser {

	private $_model;
	private $isAdminAccess = false;

	function getEmail() {
		$user = $this->loadUser(Yii::app()->user->id);
		if ($user === null){
			return null;
		}
		return $user->email;
	}

	function getName(){
		$user = $this->loadUser(Yii::app()->user->id);
		if ($user === null){
			return null;
		}
		return $user->name;
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
		$this->setState("adminAccess", Yii::app()->user->isAdminAccess);
	}
	
	function isAdminAccess() {
		return $this->isAdminAccess;
	}

	/**
	 * Checks if the user has the role.
	 * @param null $id
	 *
	 * @return bool
	 */
	public function hasRole($id){
		$user = $this->loadUser(Yii::app()->user->id);
		if ($id !== null){
			$exists = Yii::app()->db->createCommand()
			                        ->select('*')
			                        ->from('{{user_role}}')
			                        ->where(array('and','role_id=:rid', 'user_id=:uid'), array(':rid'=> $id, ':uid'=>$user->id))
			                        ->queryScalar();
			if ($exists){
				return true;
			}
		}
		return false;
	}

	public function hasProjectAccess($project_id, $write=false){
		$project = Project::model()->with('roles')->together(true)->findByPk($project_id);
		$user = $this->loadUser(Yii::app()->user->id);
		$roles = $user->roles;
		if ($project !== null){
			if ($this->isVolunteer()){
				foreach ($project->roles as $role){
					$result = array_search($role, $roles);
					if ($result !== false) {
						return true;
					}
				}
			} else {
				return $this->isManagerForOrg($project->org_id);
			}
		}
		return false;
	}

	/**
	 * Checks if the user is a manager for the organization.
	 * @param $id
	 *
	 * @return bool
	 */
	public function isManagerForOrg($org_id){
		$user = $this->loadUser(Yii::app()->user->id);
		if ($org_id !== null){
			$exists = Yii::app()->db->createCommand()
			                        ->select('*')
			                        ->from('{{organization_manager}}')
			                        ->where(array('and','org_id=:oid', 'user_id=:uid'), array(':oid'=> $org_id, ':uid'=>$user->id))
			                        ->queryScalar();
			if ($exists){
				Yii::trace("Is manager for org true.");
				return true;
			}
		}
		Yii::trace("Is manager for org false.");
		return false;
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
