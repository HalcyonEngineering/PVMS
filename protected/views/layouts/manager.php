
<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"50px", "height"=>"50px"));
    $managerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/managevolunteers.png', "", array("width"=>"50px", "height"=>"50px"));
    $addVolunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/addvolunteers.png', "", array("width"=>"50px", "height"=>"50px"));
    $calendarIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/calendar.png', "", array("width"=>"50px", "height"=>"50px"));
    $reportIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/Report.png', "", array("width"=>"50px", "height"=>"50px"));

    
    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel' => false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$projectIcon,'url'=>array('project/index')),
                                         array('label'=>$managerIcon,'url'=>array('csv/import')),
                                         array('label'=>$addVolunteerIcon,'url'=>array('volunteer/add')),
                                         array('label'=>$calendarIcon, 'url'=>array('site/page', 'view'=>'calendar')),
                                         array('label'=>$reportIcon, 'url' =>array('organization/index')),
                                         ),
                        ));
    
    ?>
