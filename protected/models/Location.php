<?php

class Location extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'pvms_location':
     * @var integer $id
     * @var string $name
     * @var integer $frequency
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function search()
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id, true);
            $criteria->compare('name',$this->name, true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{location}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('frequency', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>32),
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
            'id' => 'Id',
            'name' => 'Name',
            'frequency' => 'Frequency',
        );
    }

    /**
     * Returns location names and their corresponding weights.
     * Only the location with the top weights will be returned.
     * @param integer the maximum number of location that should be returned
     * @return array weights indexed by location names.
     */
    public function findLocationWeights($limit=20)
    {
        $models=$this->findAll(array(
            'order'=>'frequency DESC',
            'limit'=>$limit,
        ));

        $total=0;
        foreach($models as $model)
            $total+=$model->frequency;

        $location=array();
        if($total>0)
        {
            foreach($models as $model)
                $location[$model->name]=8+(int)(16*$model->frequency/($total+10));
            ksort($location);
        }
        return $location;
    }

    /**
     * Suggests a list of existing location matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of location to be returned
     * @return array list of matching location names
     */
    public function suggestLocation($keyword,$limit=20)
    {
        $location=$this->findAll(array(
            'condition'=>'name LIKE :keyword',
            'order'=>'frequency DESC, Name',
            'limit'=>$limit,
            'params'=>array(
                ':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
            ),
        ));
        $names=array();
        foreach($location as $location)
            $names[]=$location->name;
        return $names;
    }

    public static function string2array($location)
    {
        return preg_split('/\s*,\s*/',trim($location),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($location)
    {
        return implode(', ',$location);
    }

    public function updateFrequency($oldLocation, $newLocation)
    {
        $oldLocation=self::string2array($oldLocation);
        $newLocation=self::string2array($newLocation);
        $this->addLocation(array_values(array_diff($newLocation,$oldLocation)));
        $this->removeLocation(array_values(array_diff($oldLocation,$newLocation)));
    }

    public function addLocation($location)
    {
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$location);
        $this->updateCounters(array('frequency'=>1),$criteria);
        foreach($location as $name)
        {
            if(!$this->exists('name=:name',array(':name'=>$name)))
            {
                $location=new Location;
                $location->name=$name;
                $location->frequency=1;
                $location->save();
            }
        }
    }

    public function removeLocation($location)
    {
        if(empty($location))
            return;
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$location);
        $this->updateCounters(array('frequency'=>-1),$criteria);
        $this->deleteAll('frequency<=0');
    }
}
