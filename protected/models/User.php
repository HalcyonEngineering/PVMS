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

    public $originalPassword;
    public $verifyPassword;

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
			array('name, email, password', 'required'),
            array('verifyPassword, type', 'required', 'on' => 'register'),
            array('type', 'in', 'on' => 'register', 'range' => array('volunteer', 'manager', 'administrator')),
            array('email', 'unique'),
            array('email', 'email'),
			array('name, password, email', 'length', 'max'=>128),
            array('password, verifyPassword', 'length', 'min'=>6),
            array('verifyPassword', 'compare', 'compareAttribute' => 'password', 'on' => 'register'),
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
			'password' => 'Password',
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

    public function getType(){

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
}
