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
    public function registerCsv()
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
                    $volunteer_location = (count($fields) > 3) ? $fields[3] : null;

                    Yii::trace("name: $volunteer_name, email: $volunteer_email, skills: $volunteer_skills, location: $volunteer_location");
                    $this->enrollVolunteer($volunteer_name, $volunteer_email, $volunteer_skills, $volunteer_location);
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
    public function enrollVolunteer($name, $email, $skills, $location)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        //$user->skills = $skills;
        //$user->location = $location;
        $user->type = User::VOLUNTEER;
        $user->newPassword = 'temporary'; //should have randomly generated pass

        ////$user->validate();
        //$user->save('false');
        //Yii::trace(vardump($user));
        if($user->validate())
        {
            // Has the password before saving it.
            $user->password = $user->hashPassword($user->newPassword);
            Yii::trace("TRYING TO SAVE USER.");
            $user->save();
        }
        else
        {
            Yii::trace("OH NOES!");
        }
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