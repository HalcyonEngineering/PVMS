<center><?php
    $user = Yii::app()->user->name;
    echo "<h1>Hello, ". $user ."</h1>";
    ?>
<p>Welcome to Pitch'n, Here are your roles. Please make sure to keep your profile updated.</p></br>
</center>

<?php
    $this->widget('bootstrap.widgets.TbAlert', array(
                                                     'alerts'=>array(
                                                                     'error', 'success'
                                                                     ),
                                                     
                                                     ));
    ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'template'=>"{pager}\n{items}\n{pager}",
)); ?>
