
<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"90px", "height"=>"90px"));
    $volunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/wlm.png', "", array("width"=>"90px", "height"=>"90px"));
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png', "", array("width"=>"85px", "height"=>"30px"));
    $reportIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/tasks.png', "", array("width"=>"90px", "height"=>"90px"));

    
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel' => false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$projectIcon,'url'=>array('project/index')),
                                         array('label'=>$volunteerIcon,'url'=>array('csv/import')),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>$reportIcon, 'url' =>array('organization/index')),
                                         //array('label'=>'Email', 'url'=>array('mail/contact')),

                                         ),
                        ));
    
    ?>
