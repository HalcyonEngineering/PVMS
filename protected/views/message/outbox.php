<?php
    
    echo "<div class=\"span-4 pull-right\">";
    $this->widget(
                  'bootstrap.widgets.TbButton',
                  array(
                        'label' => 'Back to Inbox',
                        'type' => 'Common',
                        'url' => array('/message/inbox'),
                        )
                  );
    echo "</div>";
    
	echo CHtml::tag('h1', array(), 'Outbox');
	$columns=array(
		array(
			'class'=>'bootstrap.widgets.TbDataColumn',
			'name'=>'recipient.name',
		    'header'=>'Recipient',
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

