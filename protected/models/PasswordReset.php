<?php

/**
 * This is the model class for table "{{passwordreset}}".
 *
 * The followings are the available columns in table '{{passwordreset}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $email
 * @property string $hash
 * @property integer $timestamp
 * @property integer $expiry
 *
 * The followings are the available model relations:
 * 
 */
class PasswordReset extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{passwordreset}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, hash, timestamp, expiry', 'required'),
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
			'id' => 'Reset Password ID',
			'user_id' => 'User ID',
			'email' => 'User email',
			'timestamp' => 'Name',
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
	
	protected function beforeSave()
	{
		$model = PasswordReset::model()->findByPk($this->user_id);
		if ($model != null) {
			$model->delete();
		}	
		
		return parent::beforeDelete();
	}
}
