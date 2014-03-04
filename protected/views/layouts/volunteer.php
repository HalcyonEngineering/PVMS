<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"70px", "height"=>"50px"));
    $volunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/wlm.png', "", array("width"=>"70px", "height"=>"50px"));
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png', "", array("width"=>"70px", "height"=>"50px"));
    $reportIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/tasks.png', "", array("width"=>"70px", "height"=>"50px"));

    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel'=>false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>'Roles', 'url'=>'#'),
                                         array('label'=>'Team', 'url'=>'#'),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         ),
                        ));
    
    ?>