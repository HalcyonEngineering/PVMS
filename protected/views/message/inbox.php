<?php
	echo CHtml::tag('h1', array(), 'Inbox');

	$columns=array(
		'sender.name',
	    'subject',
	    'timestamp',
	    'status',
	);

	$this->renderPartial('_mailbox', array(
		'dataProvider'=>$dataProvider,
		'columns'=>$columns,
	));
?>