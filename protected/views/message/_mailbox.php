<?php
    $this->widget('bootstrap.widgets.TbAlert', array(
                                                     'alerts'=>array(
                                                                     'error', 'success'
                                                                     ),
                                                     
                                                     ));
    ?>

<?php

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>$columns,
    'filter'=>$model,
    'emptyText'=>'<center><i>No messages here.</i></center>',
));

?>
