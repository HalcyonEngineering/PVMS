<?php
    $roleIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"50px", "height"=>"50px"));
    $teamIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/Team.png', "", array("width"=>"50px", "height"=>"50px"));
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png', "", array("width"=>"50px", "height"=>"50px"));

    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel'=>false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$roleIcon, 'url'=>'#'),
                                         array('label'=>$teamIcon, 'url'=>'#'),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         ),
                        ));
    
    ?>