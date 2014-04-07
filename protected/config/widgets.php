<?php
	return array(
		'class' => 'CWidgetFactory',
		'widgets'=> array(
			'TbAlert'=>array(
				'block'=>true,
				'fade'=>true,
			    'closeText'=>'&times;',
			    'alerts'=>array(
				    'success',
			        'error',
			    ),
			),
			'TbGridView'=>array(
				'type'=>'bordered',
			),
			'TbExtendedGridView'=>array(
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