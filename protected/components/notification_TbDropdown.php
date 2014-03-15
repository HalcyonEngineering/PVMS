<?php

Yii::import('bootstrap.widgets.TbDropdown');

class notification_TbDropdown extends TbDropdown
{
    /**
     *### .init()
     *
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        //$notify_criteria=new CDbCriteria;
        //$notify_criteria->compare('user_id', Yii::app()->user->getId(),true);
        //The above section is a DBCriteria called "notify_criteria" used to select the notification entities with criteria of having the currently login ID.
        //$Notification_dataprovider = new CActiveDataProvider('Notification',array('criteria'=>$notify_criteria,));
        //$notificationIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/Notificationbutton.png', 'notification', array('class'=>'img-circle'));
        //$this->htmlOptions['class'] .= 'dropdown-menu';
        //$this->htmlOptions['data-toggle'] .= 'tooltip';
        //$this->htmlOptions['title'] .= '347';
    }
}

