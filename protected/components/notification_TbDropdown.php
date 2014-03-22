<?php

Yii::import('bootstrap.widgets.TbMenu');

class notification_TbDropdown extends TbMenu {

    /**
     * ### .init()
     *
     * Initializes the widget.
     */
    public $count; //Tada! I don't know when I got typing back. But I just noticed it.
    public $visible = false;

    public function init() {
        if ($this->visible) {
            $notificationIcon = CHtml::image(Yii::app()->getBaseUrl() . '/images/Notificationbutton.png', 'notification', array('class' => 'img-circle', 'id' => 'notification-icon'));
            ob_start();
            $this->renderNotifications();
            $nWidget = ob_get_clean();
            //This is to get the count of notifications CURRENTLY ON THE PAGE. Use totalItemCount to return the total number of data items.

            //$this->count = 3;
            //This is the IF condition test value to see tooltip.


            $this->encodeLabel = false;

            $this->items = array(array(
                    'label' => $notificationIcon,
                    'itemOptions' => array('id' => 'notification-menu'),
                    'type' => 'primary',
                    'url' => '#',
                    'items' => array(array('label' => $nWidget), //THIS SECTION WILL REQUIRE LIST OF NOTIFICATIONS GENERATION
                        '---',
                        array('label' => 'View All Notifications', 'itemOptions' => array('id' => 'link_allNotifications'), 'url' => array('notification/index')),
                    ), //End notifications drop down menu items
                    'visible' => !Yii::app()->user->isGuest,
            )); //End notifications drop down menu

            parent::init();
        }
    }

	public function renderNotifications(){
		$notify_criteria = new CDbCriteria;
        $notify_criteria->compare('user_id', Yii::app()->user->id, true); //TO-DO: Add Criteria to show unread only items
        $notify_criteria->compare('read_status', 0, true);
        $notify_criteria->order = 'timestamp DESC';
        //The above section is a DBCriteria called "notify_criteria" used to select the notification entities with criteria of having the currently login ID.
        $Notification_dataprovider = new CActiveDataProvider('Notification',
            array('criteria' => $notify_criteria,
                'pagination' => array('pageSize' => 10),
            )
        );


		$this->widget('bootstrap.widgets.TbListView',
					  array('dataProvider' => $Notification_dataprovider,
							'itemView' => '/_notification',
                            'template' =>'{items}',
                            'emptyText' => '  No new notifications')
					  );
        $this->count = $Notification_dataprovider->itemCount;
	}
	
    public function run() {
        parent::run();

        if ($this->count > 0 && $this->count < 10 ) {
            echo CHtml::script("$(document).ready(
									function(){ 
										$('#notification-icon').tooltip({trigger : 'manual', title: $this->count,});
										$('#notification-icon').tooltip('show');
									})");
        }
        if ( $this->count == 10 ) {
            echo CHtml::script("$(document).ready(
									function(){
										$('#notification-icon').tooltip({trigger : 'manual', title:  '10+',});
										$('#notification-icon').tooltip('show');
									})");
        }
    }

}
