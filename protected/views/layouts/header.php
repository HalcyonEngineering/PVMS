
<?php
$Notification_dataprovider = new CActiveDataProvider('Notification');
$notificationIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/Notificationbutton.png', "", array("width"=>"40px", "height"=>"40px"));
$messagesIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/messages.png', "", array("width"=>"40px", "height"=>"40px"));
    
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
	     'brand' => CHtml::image(Yii::app()->getBaseUrl().'/images/Pitchn-Logo-Mark-317x150.png', "Pitch'n", array("width"=>"140px", "height"=>"100px")),
	     'brandOptions' =>  array('style' => 'margin-left: 8%;'),
	     'brandUrl' => 'http://pitchn.ca/',
	     'collapse' => false, // requires bootstrap-responsive.css
	     'fixed' => 'top',
	     'items' => array(
		     array(
			     'class' => 'bootstrap.widgets.TbMenu',
			     'encodeLabel' => false,
			     'htmlOptions' => array('class' => 'pull-right'),
			     'items' => array(

				     // This is the Notifications Drop Down Menu
				     array(
					     'label' => $notificationIcon,
					     'type' => 'primary',
					     'url' => '#',
					     'items' => array( array('label' => $nWidget),   //THIS SECTION WILL REQUIRE LIST OF NOTIFICATIONS GENERATION
					                       '---',
					                       array('label' => 'View All Notifications', 'url' => array('notification/index')),
					     ),//End notifications drop down menu items
					     'visible'=>!Yii::app()->user->isGuest,
					     'htmlOptions' => array(
						     'data-title' => 'A Title',
						     'data-placement' => 'top',
						     'data-content' => "And here's some amazing content. It's very engaging. right?",
						     'data-toggle' => 'popover'),
				     ),//End notifications drop down menu

				     // This is the messages Drop Down Menu
				     array('label' => $messagesIcon,
				           'url' => '#',
				           'items' => array(
					           array('label' => 'Inbox', 'url' => array('site/page', 'view'=>'messages')),   //THIS NEWS TO SHOW NUMBER OF UNREAD MESSAGES
					           array('label' => 'Send Email', 'url' => array('mail/contact')),
				           ),
				           'visible'=>!Yii::app()->user->isGuest,
				     ),//End Messages drop down.

				     '---', //Divider

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
				     ),//End user drop down.

				     array('label'=>'Login',
				           'url'=>array('account/login'),
				           'visible'=>Yii::app()->user->isGuest),//End user login
			     ),//End menu items.
		     ),//End TbMenu
	     ),//End navbar items.
     )//End navbar
);//End widget instantiation


?>
