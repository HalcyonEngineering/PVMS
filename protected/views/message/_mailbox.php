<?php

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>$columns,
    'filter'=>$model,
));

?>