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
            array('csv', 'file', 'allowEmpty' => 'false', 'types' => 'csv'),
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

    /**
     * Given the filepath to a csv, parses the csv and adds users to the database
     * It's assumed that the csv will have at least a name and email column.
     * @param filepath of the local csv file
     */
    public function register_csv()
    {
        $username = Yii::app()->user->name; //User::model()->findByPk(Yii::app()->user->name);
        $filepath = dirname(__FILE__) . "/../../assets/" . "$username" . "_import.csv";
        $this->csv->saveAs($filepath);

        $file = fopen($filepath, 'r');
        if ($file)
        {
            fgetcsv($file); // skip the first row, which has the labels
            while(($fields = fgetcsv($file)) !== false)
            {
                if(count($fields) >= 2)
                {
                    $volunteer_name = $fields[0]; 
                    $volunteer_email = $fields[1];
                    $volunteer_skills = (count($fields) > 2) ? $fields[2] : null;

                    Yii::trace("name: $volunteer_name, email: $volunteer_email, skills: $volunteer_skills");
                    //enroll_volunteer($volunteer_name, $volunteer_email, $volunteer_skills);
                }
            }
        }
    }

    /**
     * Given the name, email, and skillset of the volunteer, enrolls the volunteer in the database
     * @param volunteer name
     * @param volunteer email
     * @param volunteer skills
     */
    public function enroll_volunteer($name, $email, $skills)
    {

    }
}
