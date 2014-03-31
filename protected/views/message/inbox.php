<?php
	echo CHtml::tag('h1', array(), 'Inbox');

	$columns=array(
		array(
			'class'=>'bootstrap.widgets.TbDataColumn',
		    'name'=>'sender.name',
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
		'dataProvider'=>$model->searchInbox(),
		'columns'=>$columns,
	    'model'=>$model,
	));
?>