

<?php
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>'Projects', 'url'=>array('site/page', 'view'=>'projects')),
                                         array('label'=>'Calendar', 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>'Email', 'url'=>array('mail/contact')),
                                         array('label'=>'About', 'url'=>array('site/page', 'view'=>'about')),
                                         //array('label'=>'Email', 'url'=>array('mail/contact')),
                                         ),
                        ));
    
    ?>