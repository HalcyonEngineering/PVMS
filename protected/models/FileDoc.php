<?php

/**
 * This is the model class for table "{{file}}".
 *
 * The followings are the available columns in table '{{file}}':
 * @property integer $id
 * @property integer $project_id
 * @property string $file_name
 * @property integer $file_size
 * @property string $file_data
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class FileDoc extends CActiveRecord
{
	public $uploadedfile; // stores a reference to a CUploadedFile
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uploadedfile', 'file', 'types'=>'txt,doc,docx','safe'=>true, 'maxSize'=>16*1024*1024, 'allowEmpty'=>true, 'tooLarge'=>'{attribute} is too large to be uploaded. Maximum size is 16MB.'),
			array('uploadedfile', 'required'),
			array('project_id', 'required'),
			array('project_id', 'exist', 'className'=>'Project','attributeName'=>'id'),
			array('project_id, file_size', 'numerical', 'integerOnly'=>true),
			array('file_name', 'length', 'max'=>256),
			array('file_data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, file_name, file_size, file_data', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'file_name' => 'File Name',
			'file_size' => 'File Size',
			'file_data' => 'File Data',
		    'uploadedfile'=> 'Upload File Here',
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
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_size',$this->file_size);
		$criteria->compare('file_data',$this->file_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
    * Before the normal rest of the save happens, we use the data from the CuploadedFile in $uploadedfile
    * to fill our model variables with the name, size, type and data of the file it represents
    */
    public function beforeSave()
    {
        if($file=CUploadedFile::getInstance($this,'uploadedfile')) //TODO: ?!?!?!
        {
            $this->file_name=$file->name;
            $this->file_size=$file->size;
            //$this->file_type=$file->type;
            //Yii::log('FileDoc doc save tempname: '.$file->tempName, 'warning', 'FileDoc');
            $this->file_data=file_get_contents($file->tempName); //the rest of the stuff we can read directly off the file, but we have to fetch the data out of the file's temporary location on the server
        }
 
    	return parent::beforeSave(); //overriding, should call parent too
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FileDoc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
