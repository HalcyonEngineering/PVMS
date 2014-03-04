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
     * @property string $location
     * @property string $skillset
     * @property string $causes
     * @property string $type
     * @property string $profile
     *
     * The followings are the available model relations:
     * @property Messages[] $messages
     * @property Messages[] $sentMessages
     * @property Notifications[] $notifications
     * @property Post[] $posts
     * @property Organization[] $organizations
     * @property Organization $managedOrg
     * @property Role[] $roles
     */

    public $origPassword;
    public $newPassword;
    public $verifyPassword;
    public $adminAccess;

    private $_oldSkillset;

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

            // Skills and causes
            array('skillset', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Skillset can only includes skills, which must be word characters.'),
            array('skillset', 'normalizeSkillset'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
            'organizations' => array(self::MANY_MANY, 'Organization', '{{user_organization}}(user_id, org_id)'),
            'roles' => array(self::MANY_MANY, 'Role', '{{user_role}}(user_id, role_id)'),
            'managedOrg' => array(self::MANY_MANY, 'Organization', '{{organization_manager}}(user_id, org_id)'),
            'sentMessages' => array(self::HAS_MANY, 'Message', 'sender_id'),
            'messages' => array(self::HAS_MANY, 'Message', 'user_id'),
            'notifications' => array(self::HAS_MANY, 'Notification', 'user_id'),
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
            'location' => 'Location',
            'skillset' => 'Skillset',
            'causes' => 'Causes',
            'profile' => 'Profile',
            'type' => 'Type',
            'adminAccess' => 'Allow Admin Access'
        );
    }

    /**
     * Checks if the given password is correct.
     * @param string $password the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }

    /**
     * Generates the password hash.
     * @param string $password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

    // The username is an email.
    public function getUsername() {
        return parent::__get('email');
    }

    public function getFullName() {
        return parent::__get('name');
    }

    // Normalizes the manager-entered skillset.
    public function normalizeSkillset($attribute, $params) {
        $this->skillset = Skill::array2string(array_unique(Skill::string2array($this->skillset)));
    }

    protected function afterFind() {
        parent::afterFind();
        $this->_oldSkillset = $this->skillset;
    }

    protected function afterSave() {
        parent::afterSave();
        Skill::model()->updateFrequency($this->_oldSkillset, $this->skillset);
    }

    protected function afterDelete() {
        parent::afterDelete();
        Skill::model()->updateFrequency($this->skillset, '');
    }
}
