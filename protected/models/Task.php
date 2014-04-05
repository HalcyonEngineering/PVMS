<?php

/**
 * This is the model class for table "{{task}}".
 *
 * The followings are the available columns in table '{{task}}':
 * @property integer $id
 * @property integer $role_id
 * @property string $name
 * @property string $desc
 * @property integer $expected
 * @property integer $actual
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Role $role
 */
class Task extends CActiveRecord
{

	const STATUS_IN_PROGRESS = 1;
	const STATUS_COMPLETE_PENDING = 2;
	const STATUS_COMPLETE_VERIFIED = 3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{task}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, name, status, desc', 'required'),
			array('role_id, expected, actual', 'numerical', 'integerOnly'=>true, 'min'=>0, 'tooSmall'=>'{attribute} must be greater than {min}'),
			array('role_id', 'exist', 'className' => 'Role', 'attributeName'=>'id'),
			array('name', 'length', 'max'=>128, 'on' => 'update, insert'),
			array('role_id, name, desc', 'unsafe', 'on'=>'volunteerUpdate'),
			array('desc', 'safe', 'except'=>'volunteerUpdate'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role_id, name, desc, expected, actual, status', 'safe', 'on'=>'search'),
		        array('status', 'in', 'range'=>array(1,2), 'on'=>'volunteerUpdate'),
		        array('status', 'in', 'range'=>array(1,2,3), 'on'=>'update'),
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
			'id' => 'Task ID',
			'role_id' => 'Role ID',
			'name' => 'Name',
			'desc' => 'Details',
			'expected' => 'Expected Time (Hours)',
			'actual' => 'Actual Time (Hours)',
			'status' => 'Status',
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
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('expected',$this->expected);
		$criteria->compare('actual',$this->actual);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
