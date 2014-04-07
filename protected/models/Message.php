<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $sender_id
 * @property string $subject
 * @property string $body
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property User $sender
 * @property User $user
 */
class Message extends CActiveRecord
{

	const STATUS_UNREAD = 0;
	const STATUS_READ = 1;

	var $targets;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, body', 'required'),
			array('user_id, sender_id', 'required', 'except'=>'compose'),
			array('user_id', 'exist', 'className'=>'User', 'attributeName'=>'id'),
			array('targets', 'safe', 'on'=>'compose'),
			array('user_id, sender_id, timestamp', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>128),
		    array('body', 'length', 'max'=>1024),
		    array('timestamp','default', 'value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
		    array('status', 'in', 'range'=>array(Message::STATUS_UNREAD, Message::STATUS_READ)),
		    array('status', 'default', 'value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, sender_id, subject, body, status', 'safe', 'on'=>'search'),

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
			'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
			'recipient' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Recipient',
			'sender_id' => 'Sender',
			'subject' => 'Subject',
			'body' => 'Body',
			'timestamp' => 'Send Time',
		    'status' => 'Status',
		);
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
	public function getTimestampInfo(){
		$returnedArray = array();
		$dateTime = new DateTime('@'.$this->timestamp);
		$dateTimeInterval = $dateTime->diff(new DateTime('@'.time()));

		$returnedArray['DateString'] = Yii::app()->dateFormatter->format('EEEE, MMMM d yyyy', $this->timestamp);
		$returnedArray['dateTime'] = $dateTime;
		$returnedArray['dateTimeInterval'] = $dateTimeInterval;


		if ($dateTimeInterval->y > 0){
			$timeString = $dateTimeInterval->y . (($dateTimeInterval->y == 1) ? " year" : " years");
		} elseif ($dateTimeInterval->m > 0){
			$timeString = $dateTimeInterval->m .(($dateTimeInterval->m == 1) ? " month" : "months");
		} elseif ($dateTimeInterval->d > 0){
			$timeString = $dateTimeInterval->d . (($dateTimeInterval->d == 1) ? " day" : " days");
		} elseif ($dateTimeInterval->i > 0){
		  $timeString = $dateTimeInterval->i . (($dateTimeInterval->i == 1) ? " minute" : " minutes");
		} elseif ($dateTimeInterval->s > 0){
			$timeString = $dateTimeInterval->s . (($dateTimeInterval->s == 1) ? " second" : " seconds");
		}

		$timeString .= " ago";
		$returnedArray['timeString'] = $timeString;
		Yii::trace(CVarDumper::dumpAsString($returnedArray));
		return $returnedArray;
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
	public function searchInbox()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',Yii::app()->user->id);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('t.status', $this->status);
		$criteria->with = array('sender');
		$criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'sender.name',
					'*',
				),
			),
		));
	}

	public function searchOutbox()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('sender_id',Yii::app()->user->id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('t.status', $this->status);
		$criteria->with = array('recipient');
		$criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'recipient.name',
					'*',
				),
			),
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
