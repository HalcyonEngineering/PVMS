		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Notifications', 'url'=>array('post/index')),
                array('label'=>'Projects', 'url'=>array('site/page', 'view'=>'projects')),
				array('label'=>'Calendar', 'url'=>array('site/page', 'view'=>'calendar')),
                array('label'=>'Email', 'url'=>array('mail/contact')),
				array('label'=>'Settings', 'url'=>array('account/settings')),
				array('label'=>'About', 'url'=>array('site/page', 'view'=>'about')),
			),
		)); ?>
