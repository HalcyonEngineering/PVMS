
<!--- Uncomment if you want to add branding --->
<!--- <img src="/PVMS/images/Pitchnlogo.JPG" /> --->
<!--- <div id="logo"><?php echo CHtml::encode(Yii::app()->name);?></div>--->


<?php
    $this->widget(
                  'bootstrap.widgets.TbNavbar',
                  array(
                        'type' => 'inverse',
                        'brand' => CHtml::image(Yii::app()->getBaseUrl().'/images/Pitchn-Logo-Mark-317x150.png', "", array("width"=>"70px", "height"=>"50px")),
                        'brandUrl' => '#',
                        'collapse' => false, // requires bootstrap-responsive.css
                        'fixed' => 'top',
                        'items' => array(
                                         array(
                                               'class' => 'bootstrap.widgets.TbMenu','htmlOptions' => array('class' => 'pull-right'),
                                               'items' => array(array('label'=>'Notifications', 'url'=>array('post/index')                                                             
                                                                      ),

                                                                array('label' => 'Messages', 'url' => '#'),
                                                                array(
                                                                      'label' => 'Hello ('.Yii::app()->user->name.')',
                                                                      'url' => '#',
                                                                      'items' => array(
                                                                                       array('label' => 'Signout', 'url' => array('account/logout')),
                                                                                       array('label'=>'Settings', 'url'=>array('account/settings')),
                                                                                       ),
                                                                      'visible'=>!Yii::app()->user->isGuest
                                                                      ),
                                                                array('label'=>'Login', 'url'=>array('account/login'), 'visible'=>Yii::app()->user->isGuest),
                                                                
                                                                ),
                                               ),
                                         ),
                        )
                  );
    
    
    
    ?>

