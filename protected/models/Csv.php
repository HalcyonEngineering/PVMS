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
	$filepath = $this->csv->getTempName();
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
    public function csv2volunteers(
        $tempName,
        $firstNameColumn=0,
        $lastNameColumn=1,
        $emailColumn=2
    )
    {
        $count = array('success'=>0, 'total'=>0);

        $org = Yii::app()->user->getManagedOrg();
        // Default availability is weekdays and weekends
        $availability = User::AVAILABLE_ALL;
        $skillset = '';
        $location = '';

	$filepath = $tempName;
        $file = fopen($filepath, 'r');
        if ($file)
        {
            //fgetcsv($file); // skip the first row, which has the labels
            while(($fields = fgetcsv($file)) !== false)
            {
                //if(count($fields) >= 2)
                //{
                //    $name = $fields[0];
                //    $email = $fields[1];
                //    $skillset = (count($fields) > 2) ? $fields[2] : null;
                //    $location = (count($fields) > 3) ? $fields[3] : null;
                //    $availability = 3;
                //    
                //    // Default availability is weekdays and weekends

                if(isset($fields[$firstNameColumn]) && isset($fields[$lastNameColumn])) {
                    $name = $fields[$firstNameColumn].' '.$fields[$lastNameColumn];
                } else {
                    $count['total'] += 1;
                    continue;
                }

                if(isset($fields[$emailColumn])) {
                    $email = $fields[$emailColumn];
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

    /**
     * returns the url of the CSV template image
     */
    public function getCsvTemplateImageUrl()
    {
        if($this->csvTemplateImageUrl === null)
        {
            $this->csvTemplateImageUrl = Yii::app()->baseUrl . '/assets/csv_template.jpg';
        }
        return $this->csvTemplateImageUrl;
    }
}
