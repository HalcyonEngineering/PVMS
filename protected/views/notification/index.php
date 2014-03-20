<h1>Notifications</h1>
<p>List of all notifications in order of recency.</p>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
