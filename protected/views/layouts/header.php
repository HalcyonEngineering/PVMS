		<?php echo CHtml::encode(Yii::app()->name);
           $this->widget('zii.widgets.CMenu',array(
                                                   'items'=>array(array('label'=>'Advanced Search', 'url'=>array('site/page', 'view'=>'advancedSearch')),
                                                                  array('label'=>'User Name', 'url'=>array('site/page', 'view'=>'userName')),
                                                                  array('label'=>'Login', 'url'=>array('account/login'), 'visible'=>Yii::app()->user->isGuest),
                                                                  array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('account/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                                                  ),
                                                   ));
            ?>

