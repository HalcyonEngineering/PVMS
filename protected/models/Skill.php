<?php

class Skill extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'pvms_skill':
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
        return '{{skill}}';
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
     * Returns skill names and their corresponding weights.
     * Only the skillset with the top weights will be returned.
     * @param integer the maximum number of skillset that should be returned
     * @return array weights indexed by skill names.
     */
    public function findSkillWeights($limit=20)
    {
        $models=$this->findAll(array(
            'order'=>'frequency DESC',
            'limit'=>$limit,
        ));

        $total=0;
        foreach($models as $model)
            $total+=$model->frequency;

        $skillset=array();
        if($total>0)
        {
            foreach($models as $model)
                $skillset[$model->name]=8+(int)(16*$model->frequency/($total+10));
            ksort($skillset);
        }
        return $skillset;
    }

    /**
     * Suggests a list of existing skillset matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of skillset to be returned
     * @return array list of matching skill names
     */
    public function suggestSkillset($keyword,$limit=20)
    {
        $skillset=$this->findAll(array(
            'condition'=>'name LIKE :keyword',
            'order'=>'frequency DESC, Name',
            'limit'=>$limit,
            'params'=>array(
                ':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
            ),
        ));
        $names=array();
        foreach($skillset as $skill)
            $names[]=$skill->name;
        return $names;
    }

    public static function string2array($skillset)
    {
        return preg_split('/\s*,\s*/',trim($skillset),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($skillset)
    {
        return implode(', ',$skillset);
    }

    public function updateFrequency($oldSkillset, $newSkillset)
    {
        $oldSkillset=self::string2array($oldSkillset);
        $newSkillset=self::string2array($newSkillset);
        $this->addSkillset(array_values(array_diff($newSkillset,$oldSkillset)));
        $this->removeSkillset(array_values(array_diff($oldSkillset,$newSkillset)));
    }

    public function addSkillset($skillset)
    {
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$skillset);
        $this->updateCounters(array('frequency'=>1),$criteria);
        foreach($skillset as $name)
        {
            if(!$this->exists('name=:name',array(':name'=>$name)))
            {
                $skill=new Skill;
                $skill->name=$name;
                $skill->frequency=1;
                $skill->save();
            }
        }
    }

    public function removeSkillset($skillset)
    {
        if(empty($skillset))
            return;
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$skillset);
        $this->updateCounters(array('frequency'=>-1),$criteria);
        $this->deleteAll('frequency<=0');
    }
}
