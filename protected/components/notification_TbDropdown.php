<?php

Yii::import('bootstrap.widgets.TbMenu');

class notification_TbDropdown extends TbMenu

{
    /**
     *### .init()
     *
     * Initializes the widget.
     */
    public $count; //Tada! I don't know when I got typing back. But I just noticed it.
    public function init()
    {
        $notify_criteria=new CDbCriteria;
        $notify_criteria->compare('user_id', Yii::app()->user->getId(),true); //TO-DO: Add Criteria to show unread only items
        //The above section is a DBCriteria called "notify_criteria" used to select the notification entities with criteria of having the currently login ID.
        $Notification_dataprovider = new CActiveDataProvider('Notification',array('criteria'=>$notify_criteria,));
        $notificationIcon = CHtml::image(Yii::app()->getBaseUrl().'/images/Notificationbutton.png', 'notification', array('class'=>'img-circle', 'id' =>'notification-icon'));
        ob_start();
        $this->widget('bootstrap.widgets.TbListView',
            array('dataProvider'=>$Notification_dataprovider, 'itemView'=>'/notification/_notification'));
        $nWidget = ob_get_clean();
        //$this->count = $Notification_dataprovider->itemCount;
        //This is to get the count of notifications CURRENTLY ON THE PAGE. Use totalItemCount to return the total number of data items.

        $this->count = 3;
        //This is the IF condition test value to see tooltip.


        $this->encodeLabel = false;
       /* $this->htmlOptions['id'] = 'notification-menu';
        $this->htmlOptions['data-toggle'] = 'tooltip';
        $this->htmlOptions['title'] = $this->count;
        $this->htmlOptions['data-trigger'] = 'manual';
        $this->htmlOptions['data-placement'] = 'top';*/
        $this->items = array(array(
            'label' => $notificationIcon,
            'itemOptions' => array(/*'data-toggle' => 'tooltip',*/ /*'title' =>  $this->count, 'data-trigger' => 'manual', 'data-placement' => 'top', */'id' => 'notification-menu'),
            'type' => 'primary',
            'url' => '#',
            'items' => array( array('label' => $nWidget),   //THIS SECTION WILL REQUIRE LIST OF NOTIFICATIONS GENERATION
                '---',
                array('label' => 'View All Notifications', 'url' => array('notification/index')),
            ),//End notifications drop down menu items
            'visible'=>!Yii::app()->user->isGuest,
        ));//End notifications drop down menu

        parent::init();
    }

    public function run(){
        parent::run();

        if ($this->count>0){
            echo CHtml::script("$('#notification-icon').tooltip({trigger : 'manual', title: $this->count })");
            echo CHtml::script("$('#notification-icon').tooltip('show')");
        }
    }

}



