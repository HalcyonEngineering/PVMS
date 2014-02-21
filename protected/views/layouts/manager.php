<?php
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>'Projects', 'url'=>array('site/page', 'view'=>'projects')),
                                         array('label'=>'Volunteers', 'url'=>array('site/page', 'view'=>'import')),
                                         array('label'=>'Calendar', 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>'Reports', 'url' =>array('organization/index')),
                                         //array('label'=>'Email', 'url'=>array('mail/contact')),
                                         ),
                        ));
    
    ?>