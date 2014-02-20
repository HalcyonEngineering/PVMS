
<?php
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'type' => 'list',
                        'items' => array(
                                         array('label'=>'Notifications', 'url'=>array('post/index'), 'itemOptions' => array('class' => 'active')
                                               
                                               ),
                                         array('label'=>'Projects', 'url'=>array('site/page', 'view'=>'projects')),
                                         array('label'=>'Calendar', 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>'Add Volunteers', 'url'=>array('site/page', 'view'=>'import')),
                                         array('label'=>'Email', 'url'=>array('mail/contact')),
                                         array('label'=>'Settings', 'url'=>array('account/settings')),
                                         array('label'=>'About', 'url'=>array('site/page', 'view'=>'about')),
                                         array('label'=>'Example Code', 'url' =>array('organization/index')),
                                         ),
                        ));
    
    ?>