<?php

class User extends CActiveRecord
{
	/**
	 * This is the model class for table "{{user}}".
	 *
	 * The followings are the available columns in table '{{user}}':
	 * @property integer $id
	 * @property string $name
	 * @property string $password
	 * @property string $email
	 * @property string $type
	 * @property string $profile
	 *
	 * The followings are the available model relations:
	 * @property Messages[] $messages
	 * @property Messages[] $messages1
	 * @property Notifications[] $notifications
	 * @property Post[] $posts
	 * @property UserOrg[] $userOrgs
	 * @property UserRole[] $userRoles
	 * @property Organization[] $orgs
	 * @property Role[] $roles
	 */

	public $origPassword;
	public $newPassword;
	public $verifyPassword;
	public $adminAccess;

	public $orgs;
	public $roles;
	const ADMINISTRATOR = 0;
	const MANAGER       = 1;
	const VOLUNTEER     = 2;


	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email', 'required'),
            array('email', 'unique'),
			array('adminAccess', 'boolean', 'on' => 'settings'),
			array('adminAccess', 'safe'),
            array('email', 'email'),
			array('name, origPassword, email, newPassword', 'length', 'max'=>128),
            array('origPassword, verifyPassword, newPassword', 'length', 'min'=>6),
            array('verifyPassword', 'compare', 'compareAttribute' => 'newPassword', 'on' => 'register, settings'),
            // Do not allow changes to type unless we are registering.
            array('type', 'unsafe', 'except' => 'register'),
            array('newPassword, verifyPassword', 'safe', 'on'=>'settings'),
            array('origPassword', 'required', 'on'=> 'settings'),
            array('type, newPassword, verifyPassword', 'required', 'on' => 'register'),
            array('type', 'in', 'on' => 'register', 'range' => array(User::VOLUNTEER, User::MANAGER, User::ADMINISTRATOR)),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
			'userOrgs' => array(self::HAS_MANY, 'UserOrg', 'user_id'),
			'userRoles' => array(self::HAS_MANY, 'UserRole', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'name' => 'Name',
			'password' => 'Hidden Password (DO NOT EXPOSE)',
            'origPassword' => 'Password',
            'newPassword' => 'New Password',
            'verifyPassword' => 'Verify Password',
			'email' => 'Email',
			'profile' => 'Profile',
            'type' => 'Type',
			'adminAccess' => 'Allow Admin Access'
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

    // The username is an email.
    public function getUsername(){
        return parent::__get('email');
    }

	public function getFullName(){
		return parent::__get('name');
	}

	/**
	 * @return Organization[] the organizations the user is a part of.
	 */
	public function getOrgs() {
		if ($this->orgs === null) {
			foreach ($this->userOrgs->org as $k => $org) {
				$this->orgs[$k] = $org;
			}
		}

		return $this->orgs;
	}

	/**
	 * @return Role[] the roles the user has.
	 */
	public function getRoles() {
		if ($this->roles === null) {
			foreach ($this->userRole->role as $k => $role) {
				$this->roles[$k] = $role;
			}
		}

		return $this->roles;
	}
}
