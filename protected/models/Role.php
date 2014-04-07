<?php

/**
 * This is the model class for table "{{role}}".
 *
 * The followings are the available columns in table '{{role}}':
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 * @property string $desc
 * @property string $colour
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Task[] $tasks
 * @property User[] $users
 */
class Role extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{role}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, name, desc, colour', 'required'),
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('project_id', 'exist', 'className' => 'Project', 'attributeName'=>'id'),
			array('name', 'length', 'max'=>128),
			array('colour', 'match', 'pattern'=>'/#[0-9a-fA-F]{6}/'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, name, desc', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'tasks' => array(self::HAS_MANY, 'Task', 'role_id'),
			'users' => array(self::MANY_MANY, 'User', '{{user_role}}(role_id, user_id)'),
			'onboardingDoc' => array(self::HAS_ONE, 'OnboardingDoc', 'role_id'),
			'org' => array(self::BELONGS_TO, 'Organization', array('org_id'=>'id'), 'through'=>'project'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Role ID',
			'project_id' => 'Project ID',
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
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function search_in_organization($org) {
            $criteria=new CDbCriteria;
            $criteria->compare('id',$this->id);

            // Role's project's organization must equal to $org
            $criteria->with = array('project');
            $criteria->together = true;
            $criteria->compare('project.org_id', $org->id, true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Role the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
