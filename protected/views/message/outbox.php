<?php
	echo CHtml::tag('h1', array(), 'Outbox');
	$columns=array(
		array(
			'class'=>'bootstrap.widgets.TbDataColumn',
			'name'=>'recipient.name',
		),
		array(
			'class'=>'bootstrap.widgets.TbRelationalColumn',
			'name'=>'subject',
			'value'=>'$data->subject',
			'url'=>$this->createUrl("/message/relational"),
		),
		array(
			'class'=> 'bootstrap.widgets.TbDataColumn',
			'name'=> 'timestamp',
			'type'=> 'datetime',
			'filter'=> '',
		),
		array(
			'class'=> 'bootstrapwidgets.TbDataColumn',
			'name'=> 'status',
			'value'=> 'Lookup::item("MessageStatus", $data->status);',
			'filter'=> Lookup::items("MessageStatus"),
		),
	);
	$this->renderPartial('_mailbox', array(
		'dataProvider'=>$model->searchOutbox(),
		'columns'=>$columns,
	    'model'=>$model,
	));

