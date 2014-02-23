
<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"90px", "height"=>"90px"));
    $volunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/wlm.png', "", array("width"=>"90px", "height"=>"90px"));
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png', "", array("width"=>"85px", "height"=>"60px"));
    $reportIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/tasks.png', "", array("width"=>"97px", "height"=>"100px"));

    
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel' => false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$projectIcon,
                                               'items'=> array(
                                                               array('label'=>'List of Projects', 'url'=>array('project/index')),
                                                               array('label'=>'Project', 'url'=>'#'),
                                                               )),
                                         array('label'=>$volunteerIcon,
                                               'items'=> array(
                                                               array('label'=>'Add Individual', 'url'=>array('csv/add_volunteers')),
                                                               array('label'=>'Import Volunteers', 'url'=>array('csv/import')),
                                                               array('label'=>'Manage/Find', 'url'=>'#'),
                                                               array('label'=>'Roles', 'url'=>'#'),
                                                               array('label'=>'Tasks', 'url'=>'#'))),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>$reportIcon, 'url' =>array('organization/index')),
                                         //array('label'=>'Email', 'url'=>array('mail/contact')),

                                         ),
                        ));
    
    ?>
