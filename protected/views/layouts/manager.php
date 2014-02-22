<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"70px", "height"=>"50px"));
    $volunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/wlm.png', "", array("width"=>"70px", "height"=>"50px"));
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png', "", array("width"=>"70px", "height"=>"50px"));
    $reportIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/tasks.png', "", array("width"=>"70px", "height"=>"50px"));

    
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel' => false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$projectIcon, 'url'=>array('site/page', 'view'=>'projects'),
                                               'items'=> array(
                                                               array('label'=>'List of Projects', 'url'=>'#'),
                                                               array('label'=>'Project', 'url'=>'#'),
                                                               )),
                                         array('label'=>$volunteerIcon, 'url'=>array('site/page', 'view'=>'import'),
                                               'items'=> array(
                                                               array('label'=>'Add Individual', 'url'=>'csv/add_volunteers'),
                                                               array('label'=>'Import Volunteers', 'url'=>'csv/import'),
                                                               array('label'=>'Manage/Find', 'url'=>'#'),
                                                               array('label'=>'Roles', 'url'=>'#'),
                                                               array('label'=>'Tasks', 'url'=>'#'))),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>$reportIcon, 'url' =>array('organization/index')),
                                         //array('label'=>'Email', 'url'=>array('mail/contact')),

                                         ),
                        ));
    
    ?>