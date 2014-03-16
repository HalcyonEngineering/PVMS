<?php
    $user = Yii::app()->user->name;
    echo "<h1>Welcome, ". $user ."</h1>";
    ?>
<p>Here are your roles.</p></br>


<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'template'=>"{pager}\n{items}\n{pager}",
)); ?>
