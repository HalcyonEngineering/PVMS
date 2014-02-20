		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                array('label'=>'Projects', 'url'=>array('site/page', 'view'=>'projects')),
				array('label'=>'Calendar', 'url'=>array('site/page', 'view'=>'calendar')),
                array('label'=>'Email', 'url'=>array('mail/contact')),
				array('label'=>'About', 'url'=>array('site/page', 'view'=>'about')),
			),
		)); ?>
