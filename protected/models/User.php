<?php

class User extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $name
	 * @var string $password
	 * @var string $email
     * @var string $type
	 */

	public $origPassword;
	public $newPassword;
	public $verifyPassword;

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
}
