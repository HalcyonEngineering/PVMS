<?php

/**
 * This is the model class for table "{{organization}}".
 *
 * The followings are the available columns in table '{{organization}}':
 * @property integer $id
 * @property string $name
 * @property string $desc
 *
 * The followings are the available model relations:
 * @property User[] $managers
 * @property Project[] $projects
 * @property User[] $users
 */
class Organization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{organization}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, desc', 'required'),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, desc', 'safe', 'on'=>'search'),
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
			'managers' => array(self::MANY_MANY, 'User', '{{organization_manager}}(org_id, user_id)'),
			'projects' => array(self::HAS_MANY, 'Project', 'org_id'),
			'roles' => array(self::HAS_MANY, 'Role', array('id'=>'project_id'), 'through' => 'projects'),
			'users' => array(self::MANY_MANY, 'User', '{{user_organization}}(org_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Organization ID',
			'name' => 'Name',
			'desc' => 'Description',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function search_Orgs()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 	public function BeforeDelete(){
		if(!$this->manager->delete()){
			Yii::app()->end();
		}
		else{
			return parent::BeforeDelete();
		}
		
		//$this->manager->delete();
	} 
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Organization the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return User The manager of this organization.
	 */
	public function getManager(){
		if (count($this->managers) !== 0){
			return $this->managers[0];
		} else {
			return null;
		}
	}

	/**
	 * @todo Finish checks.
	 * @param int $id Manager's id.
	 * @return boolean Whether the user is a manager for this organization.
	 */
	public static function isManager($manager_id){
		return false;
	}
}
