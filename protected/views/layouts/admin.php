<?php
    $projectIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/folder.png', "", array("width"=>"50px", "height"=>"50px"));
    $volunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/wlm.png', "", array("width"=>"50px", "height"=>"50px"));

    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel'=>false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>'Organizations', 'url'=>array('site/page', 'view'=>'projects')),
                                         array('label'=>$volunteerIcon, 'url'=>array('site/page', 'view'=>'import')),
                                         ),
                        ));

    ?>