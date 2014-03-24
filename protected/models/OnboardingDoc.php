<?php

/**
 * This is the model class for table "{{onboarding}}".
 *
 * The followings are the available columns in table '{{onboarding}}':
 * @property integer $role_id
 * @property string $onboarding_welcome
 * @property string $onboarding_instructions
 * @property string $onboarding_contact
 *
 * The followings are the available model relations:
 * @property Role $role
 */
class OnboardingDoc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{onboarding}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id', 'unique'),
			array('role_id', 'exist', 'className'=>'Role','attributeName'=>'id'),
			array('onboarding_welcome, onboarding_instructions, onboarding_contact', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('role_id, onboarding_welcome, onboarding_instructions, onboarding_contact', 'safe', 'on'=>'search'),
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
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'onboarding_welcome' => 'Welcome',
			'onboarding_instructions' => 'Instructions',
			'onboarding_contact' => 'Contact Info',
		);
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

		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('onboarding_welcome',$this->onboarding_welcome,true);
		$criteria->compare('onboarding_instructions',$this->onboarding_instructions,true);
		$criteria->compare('onboarding_contact',$this->onboarding_contact,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OnboardingDoc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
