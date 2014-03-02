<?php

/**
 * This is the model class for table "{{skill}}".
 *
 * The followings are the available columns in table '{{skill}}':
 * @property string $skill
 */
class Skill extends CActiveRecord
{
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
        return array(
            array('skill', 'required'),
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
            'skill' => 'Skill',
        );
    }

    /**
     * Returns skill name and their corresponding weights.
     * Only the skills with the top weights will be returned.
     * @param integer the maximum number of skills that should be returned
     * @return array weights indexed by skills names.
     */
    public function findSkillWeights($limit=20)
    {
        $models = $this->findAll(array('order' => 'frequency DESC', 'limit' => $limit));

        $total = 0;
        foreach($models as $model) {$total += $model->frequency;}

        $skils = array();
        if($total > 0)
        {
            foreach($models as $model)
            {
                $skills[$model->name] = 8 + (int)(16*$model->frequency/($total+10);
            }
            ksort($skills);
        }
        return $skills;
    }
        
    /**
     * Suggests a list of existing skills matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of skills to be returned
     * @return array list of matching skill names
     */
    public function suggestSkills($keyword, $limit=20)
    {
        $skills = $this->findAll(array(
            'condition'=>'name LIKE :keyword',
            'order'=>'frequency DESC, Name',
            'limit'=>$limit,
            'params'=>array(
                ':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
            ),
        ));
        $names = array();
        foreach($skills as $skill) {$names[] = $skill->name;}

        return $names;
    }

    public static function string2array($skills)
    {
        return preg_split('/\s*,\s*/',trim($skills),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($skills)
    {
        return implode(', ',$skills);
    }

    public function updateFrequency($oldSkills, $newSkills)
    {
        $oldSkills = self::string2array($oldSkills);
        $newSkills = self::string2array($newSkills);
        $this->addSkills(array_values(array_diff($newSkills, $oldSkills)));
        $this->removeSkills(array_values(array_diff($oldSkills, $newSkills)));
    }

    public function addSkills($skills)
    {
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$skills);
        $this->updateCounters(array('frequency'=>1),$criteria);
        foreach($skills as $name)
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

    public function removeSkills($skills)
    {
        if(empty($skills))
            return;
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$skills);
        $this->updateCounters(array('frequency'=>-1),$criteria);
        $this->deleteAll('frequency<=0');
    }
}
