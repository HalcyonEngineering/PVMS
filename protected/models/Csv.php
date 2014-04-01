<?php

/**
 * This is the model class for table "{{csv}}".
 *
 * The followings are the available columns in table '{{csv}}':
 * @property string $csv
 */
class Csv extends CActiveRecord
{
    public $csv;
    public $csvTemplateUrl;
    public $csvTemplateImageUrl;
    public $header;

	/**
	 * @var string Internally used name for the CSV.
	 */
	public $internalName;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{csv}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('csv', 'file', 'allowEmpty' => 'false', 'types' => 'csv', 'safe' => true),
            array('csv', 'required', 'message'=>'You must select a file to upload.'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'csv' => 'Csv',
            'header' => 'Header?',
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

        $criteria->compare('csv',$this->csv,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Csv the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getTempName() {
	return $this->csv->getTempName();
    }

    public function getFirstRow($tempName) {
	$filepath = Yii::getPathOfAlias('application.runtime.tmpcsv').'\\'.$this->internalName;
        $file = fopen($filepath, 'r');
        if ($file)
        {
            return fgetcsv($file); // skip the first row, which has the labels
        }
        return null;
    }

    /**
     * Given the filepath to a csv, parses the csv and adds users to the database
     * It's assumed that the csv will have at least a name and email column.
     */
    public function csv2volunteers($has_header, $internalName, $mappedColumns)
    {
        $count = array('success'=>0, 'total'=>0);

        $org = Yii::app()->user->getManagedOrg();
        // Default availability is weekdays and weekends
        $availability = User::AVAILABLE_ALL;
        $skillset = '';
        $location = '';
		$defaultColumns = array(
			'firstName'=> 0,
			'lastName'=> 1,
			'email'=> 2,
		);
	    $columns = array_merge($defaultColumns, $mappedColumns);
		// We changed the file path so we don't expose file system details to the user.
		$filepath = Yii::getPathOfAlias('application.runtime.tmpcsv').'\\'.$internalName;


        if (file_exists($filepath))
        {
	        $file = fopen($filepath, 'r');
            // skip the first row if user indicates CSV has header.
            if ($has_header) fgetcsv($file);
            while(($fields = fgetcsv($file)) !== false)
            {
                if(isset($fields[$columns['firstName']]) && isset($fields[$columns['lastName']])) {
                    $name = $fields[$columns['firstName']].' '.$fields[$columns['lastName']];
                } else {
                    $count['total'] += 1;
                    continue;
                }

                if(isset($fields[$columns['email']])) {
                    $email = $fields[$columns['email']];
                } else {
                    $count['total'] += 1;
                    continue;
                }


                $model = new User;
	            $model->name = $name;
	            $model->email = $email;
	            $model->location = $location;
	            $model->skillset = $skillset;
	            $model->availability = $availability;

                    if(isset($fields[$columns['phoneNumber']])) {$model->phoneNumber = $fields[$columns['phoneNumber']];}
                    if(isset($fields[$columns['address']])) {$model->address = $fields[$columns['address']];}

                $success = User::enrollVolunteer($model, $org);
                if ($success) $count['success'] += 1;
                $count['total'] += 1;
            }
        }
        return $count;
    }

    /**
     * returns the url of the CSV template
     */
    public function getCsvTemplateUrl()
    {
        if($this->csvTemplateUrl === null)
        {
            $this->csvTemplateUrl = Yii::app()->baseUrl . '/assets/csv_template.csv';
        }
        return $this->csvTemplateUrl;
    }

}
