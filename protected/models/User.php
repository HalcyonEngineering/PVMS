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
    * @property integer $availability
    * @property string $type
    * @property string $profile
    *
    * The followings are the available model relations:
    * @property Message[] $messages
    * @property Message[] $sentMessages
    * @property Notification[] $notifications
    * @property Organization[] $organizations
    * @property Organization $managedOrg
    * @property Role[] $roles
    */

    public $origPassword;
    public $newPassword;
    public $verifyPassword;

    private $_oldSkillset;
    private $_oldLocation;

    const ADMINISTRATOR 	= 0;
    const MANAGER       	= 1;
    const VOLUNTEER     	= 2;
    const DISABLED              = 3;
    const DISABLEDVOLUNTEER     = 4;

    const AVAILABLE_NONE        = 0;
    const AVAILABLE_WEEKDAYS    = 1;
    const AVAILABLE_WEEKENDS    = 2;
    const AVAILABLE_ALL         = 3;

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
            array('name', 'match', 'pattern'=>'/[A-Za-z][A-Za-z -.]*[A-Za-z.]/'),
            array('name, origPassword, email, newPassword', 'length', 'max'=>128),
            array('origPassword, verifyPassword, newPassword', 'length', 'min'=>6),
            array('verifyPassword', 'compare', 'compareAttribute' => 'newPassword', 'on' => 'register, settings'),
            // Do not allow changes to type unless we are registering.
            array('type', 'unsafe', 'except' => 'register, disable'),
            array('newPassword, verifyPassword', 'safe', 'on'=>'settings'),
            array('origPassword', 'required', 'on'=> 'settings'),
            array('type, newPassword, verifyPassword', 'required', 'on' => 'register'),
            array('type', 'in', 'range' => array(User::VOLUNTEER, User::MANAGER, User::ADMINISTRATOR,  User::DISABLED)),

            // Location and causes
            array('location', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Location can only includes skills, which must be word characters.'),
            array('location', 'normalizeLocation'),

            // Skills and causes
            array('skillset', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Skillset can only includes skills, which must be word characters.'),
            array('skillset', 'normalizeSkillset'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, location, skillset, availability', 'safe', 'on'=>'search'),
        );
    }

  /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
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
            'availability' => 'Availability',
            'type' => 'Type',
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

            // Name needs to be disambiguated from 
            $criteria->compare('t.name',$this->name, true);
            $criteria->compare('location',$this->location, true);
            $criteria->compare('skillset',$this->skillset, true);
            $criteria->compare('availability',$this->availability, true);

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
	
    public function search_volunteers_in_org_adv($org, $args)
    {

            $criteria=new CDbCriteria;
            $criteria->compare('id',$this->id);

            // Name needs to be disambiguated from 
            if ($args['User']['username'] !== '') {
                $criteria->compare('t.name', $args['User']['username'], true);
            }

            if ($args['Skill']['id']) {
                $wanted_s_id = $args['Skill']['id'];
                $wanted_s = Skill::model()->findByPk($wanted_s_id)->name;
                $criteria->compare('skillset', $wanted_s, true);
            }

            if ($args['Location']['id'] !== '') {
                $wanted_location_id = $args['Location']['id'];
                $wanted_location = Location::model()->findByPk($wanted_location_id)->name;
                $criteria->compare('location', $wanted_location);
            }

            if ($args['User']['availability'] !== '') {
                $criteria->compare('availability', $args['User']['availability']);
            }

            // User has to be a volunteer
            $criteria->compare('type', User::VOLUNTEER);

            // User's organizations[] must have one that matches $org
            // Join the user table with the organization table
            // samething with roles
            $criteria->with = array('organizations', 'roles');
            $criteria->together = true;
            $criteria->compare('organizations.name', $org->name, true);

            // User's roles[] must have one that matches project
            if ($args['Project']['id'] !== '') {
                $criteria->compare('roles.project_id', $args['Project']['id']);
            }

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }
	
	public function search_volunteers()
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

	    $criteria=new CDbCriteria;
	    // User has to be a volunteer
	    $criteria->compare('type', User::VOLUNTEER);
	    $criteria->compare('type', User::DISABLEDVOLUNTEER, false, 'OR');

	    $criteria->compare('id',$this->id);
	    $criteria->compare('name',$this->name, true);
	    $criteria->compare('email', $this->email, true);
	    $criteria->compare('location',$this->location, true);
	    $criteria->compare('skillset',$this->skillset, true);


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

    // Normalizes the manager-entered Location.
    public function normalizeLocation($attribute, $params) {
        $this->location = Skill::array2string(array_unique(Skill::string2array($this->location)));
    }

    // Normalizes the manager-entered skillset.
    public function normalizeSkillset($attribute, $params) {
        $this->skillset = Skill::array2string(array_unique(Skill::string2array($this->skillset)));
    }

    protected function afterFind() {
        parent::afterFind();
        $this->_oldSkillset = $this->skillset;
        $this->_oldLocation = $this->location;
    }

    protected function afterSave() {
        parent::afterSave();
        Skill::model()->updateFrequency($this->_oldSkillset, $this->skillset);
        Location::model()->updateFrequency($this->_oldLocation, $this->location);
    }

    protected function afterDelete() {
        parent::afterDelete();
        Skill::model()->updateFrequency($this->skillset, '');
    }

    /**
     * Given the name, email, and skillset of the volunteer, enrolls the volunteer in the database
     * @param string $name
     * @param string $email
     * @param string $location
     * @param string $skillset
     * @param Organization $organization
     * @param int $availability
     */
    public static function enrollVolunteer($name, $email, $location, $skillset, $organization, $availability)
    {
        // If the email does not exist in the database, create a new volunteer
        $user = User::model()->findByAttributes(array('email'=>$email));
        if ($user === null) {
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->location = $location;
            $user->skillset = $skillset;
            $user->availability = $availability;

            $characters = 'ABCDEF1234567890';
            $pass = '';
                for ($i = 0; $i < 6; $i++) {
                    $pass .= $characters[rand(0, strlen($characters) - 1)];
            }

            $user->newPassword = $pass; //should have randomly generated pass, email user
            $user->organizations = array($organization);

            if($user->validate())
            {
                // Hash the password before saving it.
                $user->password = $user->hashPassword($user->newPassword);
                if ($user->save()) {
                    User::emailWelcome($user);
                    Notification::notify($user->id, "Welcome " . $user->name . 
                        ", you've been added as a member of  " . $organization->name . ".", '#');
                    return true;
                } else {
                    return false;
                }
            }
        // @todo Abstract save/notify/return logic
        } else {
            // Just update the organization, don't change anything else
            $new_orgs = $user->organizations;
            array_push($new_orgs, $organization);
            $user->organizations = $new_orgs;
            if ($user->save()) {
                Notification::notify($user->id, "Welcome " . $user->name . 
                    ", you've been added as a member of  " . $organization->name . ".", '#');
                return true;
            } else {
                return false;
            }
        }
    }

    public static function emailWelcome($user) {
        $mail = new Mail;
        $mail->name = 'Pitch\'n';
        $mail->email = 'noreply@pitchin.ca';
        $mail->Remail = $user->email;
        $mail->subject = 'Welcome to Pitch\'n!';
        $mail->body = "Welcome to Pitch'n!\n\nPlease login with this email address:\n".$user->email."\n\nYour password is:\n".$user->newPassword."\n\nYou can log in at http://chivalry.cloudapp.net/PVMS\n\nThank you!\nPitch'n Team";
        $mail->sendMail();
    }

    public static function assignToRole($volunteer_ids, $role_id) {
        $new_role = Role::model()->findByPk($role_id);
        $count = 0;

        foreach ($volunteer_ids as $vid) {
            $model = User::model()->findByPk($vid);

            // Only add role if the volunteer is not already enrolled AND is a volunteer
            if (!in_array($new_role, $model->roles) && $model->type == User::VOLUNTEER) {

                // Make another array with existing roles + new_role
                $new_roles = $model->roles;
                array_push($new_roles, $new_role);
                $model->roles = $new_roles;
                if ($model->save()) {
                    $note_url = Yii::app()->getBaseUrl(true).'/role/view?id='.$role_id;
                    Notification::notify($model->id, 'A new role has been assigned for you!', $note_url);
                    $count += 1;
                }
            }
        }
        return $count;
    }

    public static function removeFromRole($volunteer_id, $role_id) {
        $volunteer = User::model()->findByPk($volunteer_id);

        // remove ONLY the one role the volunteer is in
        $role = Role::model()->findByPk($role_id);
        $new_roles = $volunteer->roles;
        $pos = array_search($role, $new_roles);
        unset($new_roles[$pos]);
        $volunteer->roles = $new_roles;

        $volunteer->save();
    }

    public static function removeFromOrg($volunteer_id, $org) {
        $volunteer = User::model()->findByPk($volunteer_id);

        // remove all roles which the volunteer is participating
        $volunteer->roles = array();

        // remove ONLY the one organization the volunteer is in
        $new_orgs = $volunteer->organizations;
        $pos = array_search($org, $new_orgs);
        unset($new_orgs[$pos]);
        $volunteer->organizations = $new_orgs;

        $volunteer->save();
    }

    public static function availabilityString($availability) {
        if ($availability == 0) return 'Not Available';
        if ($availability == 1) return 'Weekdays';
        if ($availability == 2) return 'Weekends';
        if ($availability == 3) return 'Weekdays & Weekends';
    }
}
