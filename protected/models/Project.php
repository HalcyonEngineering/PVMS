<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property integer $org_id
 * @property string $name
 * @property string $desc
 * @property string $colour
 * @property integer $target
 *
 * The followings are the available model relations:
 * @property Organization $org
 * @property Role[] $roles
 */
class Project extends CActiveRecord
{
	/**
	 * @var string representation of the target date.
	 */
	public $targetString;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{project}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('org_id, name, desc, colour', 'required'),
			array('org_id', 'numerical', 'integerOnly'=>true),
			array('org_id', 'exist', 'className' => 'Organization', 'attributeName'=>'id'),
			array('org_id', 'compare', 'compareValue'=> Yii::app()->user->managedOrg->id,
			      'message' => 'You must be a manager of this organization to add a project.'),
			array('name', 'length', 'max'=>128),
			array('colour', 'match', 'pattern'=>'/#[0-9a-fA-F]{6}/'),
			array('targetString', 'date', 'format'=>'MMMM d yyyy', 'timestampAttribute'=>'target'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, org_id, name, desc, colour, target', 'safe', 'on'=>'search')
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
			'org' => array(self::BELONGS_TO, 'Organization', 'org_id'),
			'roles' => array(self::HAS_MANY, 'Role', 'project_id'),
			'tasks' => array(self::HAS_MANY, 'Task', array('id'=>'role_id'), 'through'=>'roles'),
			'filedocs' => array(self::HAS_MANY, 'FileDoc', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Project ID',
			'org_id' => 'Organization ID',
			'name' => 'Name',
			'desc' => 'Description',
			'colour' => 'Colour',
			'target' => 'Target Completion',
		    'targetString' => 'Target Completion Date',
		);
	}

	public function afterFind(){
		$this->targetString = Yii::app()->dateFormatter->format('MMMM d yyy', $this->target);
		parent::afterFind();
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
		$criteria->compare('org_id',$this->org_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('target',$this->target);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getUnassignedRolesInProject($id){
		$model = Project::model()->with('roles', 'roles.users')->together()->findByPk($id);
		$emptyRoles = array();
		foreach($model->roles as $role){
			if (count($role->users) === 0){
				$emptyRoles[] = $role;
			}
		}
		return $emptyRoles;
	}
	/**
	 *
	 * Returns an array of information about the target date.
	 * @return array An array of values.<br \>
	 *               <br \>
	 * targetString contains a formatted string of the target date.<br \>
	 * dateTime returns the DateTime object of the target date.<br \>
	 * dateTimeInterval is the date time interval of the target date compared to the target time<br \>
	 * passedTarget is a boolean that indicates if we've passed the deadline or not.<br \>
	 * daysToTarget is a signed integer about how close you are to your deadline.<br \>
	 * daysString will give you a default time to deadline string.<br \>
	 *
	 */
	public function getTargetDateInfo(){
		$returnedArray = array();
		$dateTime = new DateTime('@'.$this->target);
		$now = new DateTime();
		$dateTimeInterval = $now->diff($dateTime);

		$returnedArray['targetString'] = Yii::app()->dateFormatter->format('EEEE, MMMM d yyyy', $this->target);
		$returnedArray['dateTime'] = $dateTime;
		$returnedArray['dateTimeInterval'] = $dateTimeInterval;

		//If we are past our target, we are behind.
		$returnedArray['passedTarget'] = ($dateTimeInterval->invert == 1);
		$returnedArray['daysToTarget'] = $dateTimeInterval->days;
		if ($returnedArray['passedTarget']){
			$returnedArray['daysToTarget'] *= -1;
		}

		$dayString = ($dateTimeInterval->days <= 1) ? "< 1 day " : $dateTimeInterval->days." days ";
		$dayString .= ($returnedArray['passedTarget']) ? "ago" : "to go";
		$returnedArray['daysString'] = $dayString;
		Yii::trace(CVarDumper::dumpAsString($returnedArray));
		return $returnedArray;

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
