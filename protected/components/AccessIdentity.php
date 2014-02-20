<?php

class AccessIdentity extends CUserIdentity{

	/**
	 * @var User $_user
	 */
	public $id;
	private $_adminIdentity;
	private $_user;

	/**
	 * @param integer $id id of the user you wish to access
	 * @param UserIdentity $identity an administrator's identity.
	 */
	public function __construct($id, UserIdentity $adminIdentity){
		$this->id=$id;
		$this->loadAccessUser();
		$this->_adminIdentity=$adminIdentity;
	}

	public function authenticate(){
		return $this->_adminIdentity->authenticate();
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->_adminIdentity->username . ' as ' . $this->_user->username;
	}

	private function loadAccessUser() {
		if ($this->_user === null){
			if ($this->id !== null){
				$this->_user = User::model()->findByPk($this->id);
			}
		}
		return $this->_user;
	}
} 
