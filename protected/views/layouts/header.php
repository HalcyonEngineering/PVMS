
<!--- Uncomment if you want to add branding --->
<!--- <img src="/PVMS/images/Pitchnlogo.JPG" /> --->
<!--- <div id="logo"><?php echo CHtml::encode(Yii::app()->name);?></div>--->


<?php
    $this->widget(
                  'bootstrap.widgets.TbNavbar',
                  array(
                        'type' => null,
                        'brand' => CHtml::image(Yii::app()->getBaseUrl().'/images/Pitchn-Logo-Mark-317x150.png', "", array("width"=>"70px", "height"=>"50px")),
                        'brandUrl' => '#',
                        'collapse' => true, // requires bootstrap-responsive.css
                        'fixed' => 'top',
                        'items' => array(
                                         array(
                                               'class' => 'bootstrap.widgets.TbMenu',
                                               'items' => array(
                                                                // find logic to set active
                                                                array('label' => 'Home', 'url' =>array('post/index'), 'active' => false),
                                                                ),
                                               ),
                                         '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"> <button type="submit" class="btn">Search</button></form>',
                                 
                                        
                                        
                                                                
                                         array(
                                               'class' => 'bootstrap.widgets.TbMenu','htmlOptions' => array('class' => 'pull-right'),
                                               'items' => array(array('label' => 'Advanced Search', 'url' =>array('site/page', 'view'=>'advancedSearch')),array('label'=>'Notifications', 'url'=>array('site/page', 'view'=>'notifications')                                                             
                                                                      ),

                                                                array('label' => 'Messages', 'url' => array('post/index')),
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

