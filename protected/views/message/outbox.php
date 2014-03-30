<?php
	echo CHtml::tag('h1', array(), 'Outbox');
	$columns=array(
		'recipient.email',
		'subject',
		'timestamp',
		'status',
	);
	$this->renderPartial('_mailbox', array(
		'dataProvider'=>$dataProvider,
		'columns'=>$columns,
	));

