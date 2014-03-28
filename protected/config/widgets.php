<?php
	return array(
		'class' => 'CWidgetFactory',
		'widgets'=> array(
			'TbGridView'=>array(
				'type'=>'bordered',
			),
		    'TbDatePicker'=>array(
			    'options'=>array(
				    'format'=>'MM d yyyy',
			        'startDate'=>'0d',
			    ),
		    ),
		),
	);
?>