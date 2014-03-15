<?php
    $organizationsIcon= CHtml::image(Yii::app()->getBaseUrl().'/images/organizations.png');
    $volunteerIcon=CHtml::image(Yii::app()->getBaseUrl().'/images/wlm.png');

    $this->widget(
                  'bootstrap.widgets.TbMenu',
                  array(
                        'encodeLabel'=>false,
                        'type' => 'tabs',
                        'stacked'=>true,
                        'items' => array(
                                         array('label'=>$organizationsIcon, 'url'=>array('organization/index')),
                                         array('label'=>$volunteerIcon, 'url'=>array('site/page', 'view'=>'import')),
                                         ),
                        ));

    ?>