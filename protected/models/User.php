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
	const DISABLED     	= 3;

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
            array('type', 'unsafe', 'except' => 'register, disable'),
            array('newPassword, verifyPassword', 'safe', 'on'=>'settings'),
            array('origPassword', 'required', 'on'=> 'settings'),
            array('type, newPassword, verifyPassword', 'required', 'on' => 'register'),
            //array('type', 'in', 'on' => 'register, disable', 'range' => array(User::VOLUNTEER, User::MANAGER, User::ADMINISTRATOR,  User::DISABLED)),

            // Skills and causes
            array('skillset', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Skillset can only includes skills, which must be word characters.'),
            array('skillset', 'normalizeSkillset'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, location, skillset', 'safe', 'on'=>'search'),
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
            'managedOrgs' => array(self::MANY_MANY, 'Organization', '{{organization_manager}}(user_id, org_id)'),
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

    public function behaviors() {
        return array('EAdvancedArBehavior' => array(
                'class' => 'application.extensions.EAdvancedArBehavior'));
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

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('name',$this->name, true);
            $criteria->compare('email',$this->email, true);
            $criteria->compare('location',$this->location, true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    public function search_volunteers_in_org($org)
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('name',$this->name, true);
            $criteria->compare('location',$this->location);
            $criteria->compare('skillset',$this->skillset, true);

            // User has to be a volunteer
            $criteria->compare('type', User::VOLUNTEER, true);

            // User's organizations[] must have one that matches $org
            // Join the user table with the organization table
            $criteria->with = array('organizations');
            $criteria->together = true;
            $criteria->compare('organizations.name', $org->name, true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }
	
	public function search_volunteers()
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('name',$this->name, true);
            $criteria->compare('location',$this->location);
            $criteria->compare('skillset',$this->skillset, true);

            // User has to be a volunteer
            $criteria->compare('type', User::VOLUNTEER, true);
			
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    // The username is an email.
    public function getUsername() {
        return parent::__get('email');
    }

    public function getFullName() {
        return parent::__get('name');
    }

	public function getManagedOrg(){
		if (count($this->managedOrgs) !== 0){
			return $this->managedOrgs[0];
		} else {
			return null;
		}
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

    /**
     * Given the name, email, and skillset of the volunteer, enrolls the volunteer in the database
     * @param volunteer name
     * @param volunteer email
     * @param volunteer location
     * @param volunteer skillset
     */
    public static function enrollVolunteer($name, $email, $location, $skillset, $organization)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->location = $location;
        $user->skillset = $skillset;

        $user->newPassword = 'temporary'; //should have randomly generated pass, email user
        $user->organizations = array($organization);

        if($user->validate())
        {
            // Has the password before saving it.
            $user->password = $user->hashPassword($user->newPassword);
            $user->save();
        }
    }

}
