<?php
    $roleIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/roles.png');
    $teamIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/Team.png');
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png');

    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel'=>false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$roleIcon, 'url'=>array('role/index')),
                                         array('label'=>$teamIcon, 'url'=>'#'),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         ),
                        ));
    
    ?>