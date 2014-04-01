<?php
    $user = Yii::app()->user->name;
    echo "<h1>Welcome, ". $user ."</h1>";
    ?>
<p>Here are all the organizations that are using Pitch'n's Management Dashboard</p></br>




<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'emptyText'=>'<center><i>No organizations here.</i></center>',
)); ?>
