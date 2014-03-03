
<?php
$Notification_dataprovider = new CActiveDataProvider('Notification');
$notificationIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/messages.png', "", array("width"=>"50px", "height"=>"50px"));
$messagesIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/messages.png', "", array("width"=>"50px", "height"=>"50px"));
    
ob_start();
$this->widget('bootstrap.widgets.TbListView',
    array('dataProvider'=>$Notification_dataprovider, 'itemView'=>'/notification/_notification'));
$nWidget =  ob_get_clean();
//The above widget is used to display a list of notifications in the notification dropdown on the header navbar. Note that at the momment, there are set conditions
//@TODO Add settings on conditions of displayed notificatons

$this->widget(
    'bootstrap.widgets.TbNavbar',
    array(
        'type' => 'inverse',
        'brand' => CHtml::image(Yii::app()->getBaseUrl().'/images/Pitchn-Logo-Mark-317x150.png', "", array("width"=>"140px", "height"=>"100px")),
        'brandUrl' => '#',
        'collapse' => false, // requires bootstrap-responsive.css
        'fixed' => 'top',
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'encodeLabel' => false,
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                                 
                // This is the Notifications Drop Down Menu
                    array('label' => $notificationIcon,
                        'url' => '#',
                        'items' => array(
                            array('label' => $nWidget),   //THIS SECTION WILL REQUIRE LIST OF NOTIFICATIONS GENERATION
                            '---',
                            array('label' => 'View All Notifications', 'url' => array('notification/index')),
                        ),
                    ),
                                 
                // This is the messages Drop Down Menu
                    array('label' => $messagesIcon,
                        'url' => '#',
                        'items' => array(
                            array('label' => 'Inbox', 'url' => array('site/page', 'view'=>'messages')),   //THIS NEWS TO SHOW NUMBER OF UNREAD MESSAGES
                            array('label' => 'Send Email', 'url' => array('mail/contact')),
                        ),),
 '---',
                // This is the User Drop Down Menu
                    array(
                        'label' => Yii::app()->user->name,
                        'url' => '#',
                        'items' => array(
                            array('label' => 'My Profile', 'url' => array('account/profile')),
                            array('label'=>'Take a Tour', 'url'=>'#'),
                            array('label'=>'FAQ', 'url'=>'#'),
                            array('label'=>'Settings', 'url'=>array('account/settings')),
                            array('label' => 'Signout', 'url' => array('account/logout')),
                        ),
                        'visible'=>!Yii::app()->user->isGuest,
                    ),
                    array('label'=>'Login', 'url'=>array('account/login'), 'visible'=>Yii::app()->user->isGuest),
                ),
            ),
        ),
    )
);


?>
