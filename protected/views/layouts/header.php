
<?php
$Notification_dataprovider = new CActiveDataProvider('Notification');

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
        'brand' => CHtml::image(Yii::app()->getBaseUrl().'/images/Pitchn-Logo-Mark-317x150.png', "", array("width"=>"70px", "height"=>"50px")),
        'brandUrl' => '#',
        'collapse' => false, // requires bootstrap-responsive.css
        'fixed' => 'top',
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'encodeLabel' => false,
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                    array('label' => 'Notifications',
                        'url' => '#',
                        'items' => array(
                            array('label' => $nWidget),   //THIS SECTION WILL REQUIRE LIST OF NOTIFICATIONS GENERATION
                            '---',
                            array('label' => 'View All Notifications', 'url' => array('notification/index')),
                        ),
                    ),
                    array('label' => 'Messages',
                        'url' => '#',
                        'items' => array(
                            array('label' => 'Inbox', 'url' => array('site/page', 'view'=>'messages')),   //THIS NEWS TO SHOW NUMBER OF UNREAD MESSAGES
                            array('label' => 'Send Email', 'url' => array('mail/contact')),
                        ),),


                    array(
                        'label' => 'Hello ('.Yii::app()->user->name.')',
                        'url' => '#',
                        'items' => array(
                            array('label' => 'My Profile', 'url' => array('account/profile')),
                            array('label'=>'Settings', 'url'=>array('account/settings')),
                            array('label' => 'Help', 'url' => '#'),
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
