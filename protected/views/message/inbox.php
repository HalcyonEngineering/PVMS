<?php
    
    echo "<div class=\"span-4 pull-right\" id=\"outbox-button-div\">";
    $this->widget(
                  'bootstrap.widgets.TbButton',
                  array(
                        'label' => 'Outbox',
                        'type' => 'Common',
                        'id' => 'out-box-btn',
                        'url' => array('/message/outbox'),
                        )
                  );
    echo "</div>";
    



   
    
	echo CHtml::tag('h1', array(), 'Inbox');
$this->widget('ModalOpenButton',
    array(
        'label' => 'Send Message',
        'type' => 'Common',
        'encodeLabel' =>false,
        'button_id'=>'1',
        'url' => Yii::app()->createUrl("message/compose"),
    )
);
    
    
	$columns=array(
		array(
			'class'=>'bootstrap.widgets.TbDataColumn',
		    'name'=>'sender.name',
		    'header'=>'Sender',
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
		    'class'=> 'bootstrap.widgets.TbDataColumn',
	        'name'=> 'status',
	        'value'=> 'Lookup::item("MessageStatus", $data->status);',
	        'filter'=> Lookup::items("MessageStatus"),
	    ),
	    array(
		    'class'=> 'bootstrap.widgets.TbButtonColumn',
	        'template' => '{delete}',
	    ),
	);

	$this->renderPartial('_mailbox', array(
		'dataProvider'=>$model->searchInbox(),
		'columns'=>$columns,
	    'model'=>$model,
	));
?>
