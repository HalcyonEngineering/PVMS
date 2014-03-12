
<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/projects.png');
    $managerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/managevolunteers.png');
    $addVolunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/addvolunteers.png');
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png');
    $reportIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/Report.png');

    
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel' => false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$projectIcon,'url'=>array('project/admin')),
                                         array('label'=>$managerIcon,'url'=>array('volunteer/search')),
                                         array('label'=>$addVolunteerIcon,'url'=>array('volunteer/add')),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>$reportIcon, 'url' =>'#'),
                                         ),
                        ));
    
    ?>
