
<!--- Uncomment if you want to add branding --->
<!--- <img src="/PVMS/images/Pitchnlogo.JPG" /> --->
<!--- <div id="logo"><?php echo CHtml::encode(Yii::app()->name);?></div>--->


<?php
    $this->widget(
                  'bootstrap.widgets.TbNavbar',
                  array(
                        'type' => null,
                        'brand' => 'Pitchn',
                        'brandUrl' => '#',
                        'collapse' => true, // requires bootstrap-responsive.css
                        'fixed' => 'top',
                        'items' => array(
                                         array(
                                               'class' => 'bootstrap.widgets.TbMenu',
                                               'items' => array(
                                                                // find logic to set active
                                                                array('label' => 'Home', 'url' =>array('post/index'), 'active' => true),
                                                                ),
                                               ),
                                         '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
                                         array(
                                               'class' => 'bootstrap.widgets.TbMenu',
                                               'items' => array(
                                                                // find logic to set active
                                                                array('label' => 'Advanced Search', 'url' =>array('post/index'), 'active' => false),
                                                                ),
                                               ),
                                         
                                         array(
                                               'class' => 'bootstrap.widgets.TbMenu','htmlOptions' => array('class' => 'pull-right'),
                                               'items' => array(array('label'=>'Notifications', 'url'=>array('post/index')                                                             
                                                                      ),

                                                                array('label' => 'Messages', 'url' => '#'),
                                                                '---',
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

