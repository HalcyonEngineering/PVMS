<?php

/**
 * This is the model class for table "{{notification}}".
 *
 * The followings are the available columns in table '{{notification}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property integer $timestamp
 * @property string $link
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Notification extends CActiveRecord
{
    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{notification}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, description, link', 'required'),
			array('user_id, timestamp, read_status', 'numerical', 'integerOnly'=>true),
			array('description, link', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, description, timestamp, link', 'safe', 'on'=>'search'),
                        array('timestamp','default', 'value'=>time(), 'setOnEmpty'=>false,'on'=>'insert')
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Notification ID',
			'user_id' => 'To',
			'description' => 'Description',
			'timestamp' => 'Time Sent',
			'link' => 'Link',
            'read_status' => 'Read',
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

    //this method is made to return all the unread notifications of the current user.
    public function search_unread() //THIS WILL BE USED FOR THE NOTIFICATION BUTTON AND DROPDOWN
	{

		$criteria=new CDbCriteria;
		$criteria->compare('user_id',Yii::app()->user->id,true);
		$criteria->compare('read_status',0,true);

		return new CActiveDataProvider('Notification', array(
			'criteria'=>$criteria,
		));
	}

    public static function search_All() //THIS WILL BE USED FOR THE NOTIFICATION LOG
    {

        $criteria=new CDbCriteria;
        $criteria->compare('user_id',Yii::app()->user->id,true);
        $criteria->order = 'timestamp DESC';

        return new CActiveDataProvider('Notification', array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    /**
     * @param int $userID - UserID of the account that the notification is sent to
     * @param string $description - description of  the notification
     * @param string $link - redirect link to notification location
     */
    public static function notify($userID,  $description, $link) //USED TO CREATE NEW NOTIFICATION
    {
        $_notify = new Notification();  //make new notification

        $_notify->user_id = $userID; // add user ID of notification receiver
        $_notify->description = $description; // add description of the notification
        $_notify->link = $link; //add link to notification source
        $_notify->timestamp = time(); //system generates current timestamp to be stored.*/
        if ($_notify->validate()) { //check if notification object validates
            Yii::trace("Notify validated.");
            $_notify->save();    //add to database

        }
    }

	/**
	 * Notifies every user in the array.
	 *
	 * @param array $users - Array of Users to send the notifications to.
	 * @param string $description - description of  the notification
	 * @param string $link - redirect link to notification location
	 */
	public static function notifyAll($users, $description, $link){
		foreach ($users as $user){
			Notification::notify($user->id, $description, $link);
		}
	}

    public function read() //makes the notification "read"
    {
       $this->read_status = 1;
       $this->save();
    }

    public static function unread($notification_ID) //makes the notification "read"
    {
        $notification = Notification::model()->findByPk($notification_ID); // finds the notification with the right ID
        $notification->read_status = 0; //set read to 1 to show read.
        $notification->update(array('read_status')); //update entity
    }

}
