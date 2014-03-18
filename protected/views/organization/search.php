<?php

// Make sure you change yiiGridView.update js BELOW!
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-search-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Search Organizations</h1>
<p>Here are your list of Organizations. You can also refine the list by searching.</p>



<?php echo CHtml::link('Search Organizations','#',array('class'=>'search-button btn')); ?>

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array('model'=>$model)); ?>
</div><!-- search-form -->

<p></p>

<?php
// Render them all with single `TbAlert`
$this->widget('bootstrap.widgets.TbAlert', array(
	'block' => true,
	'fade' => true,
	'closeText' => '&times;', // false equals no close link
	'events' => array(),
	'htmlOptions' => array(),
	'userComponentId' => 'user',
	'alerts' => array( // configurations per alert type
	// success, info, warning, error or danger
		'success' => array('closeText' => '&times;'),
		'info', // you don't need to specify full config
		'warning' => array('block' => false, 'closeText' => false),
		'error' => array('block' => false)
		),
	)
);
?>

<?php 

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'org-search-grid',
    'dataProvider'=>$model->search_Orgs(),
    'selectableRows' => 2,
    //'filter'=>$model,
    'columns'=>array(
        array(
            'name' => 'selectedNames',
            'class' => 'CCheckBoxColumn'
        ),
		'name',
		
		array(
			'name' => 'Manager Name',
			'type'=>'raw',
			'class'=> 'bootstrap.widgets.TbDataColumn',
			'value'=> '$data->manager !== null ? $data->manager->name : "null"'
			),
			'manager.email:html:Manager Email',
		array(
			'name' => 'Admin Access',
			'class'=> 'bootstrap.widgets.TbDataColumn',
			'value'=> '$data->manager !== null ? 
				($data->manager->adminAccess ? "Y" : "N") 
				: "N"'
			),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{adminAccess} {disable} {enable} {delete} ',
			'buttons'=> array(
				'adminAccess' => array(
					'label' => 'Log in',
					'url' => 'Yii::app()->createUrl("account/adminLogin", array("userID"=>$data->manager->id))',
				),
				'enable' => array(
					'label' => 'Enable',
					'url' => 'Yii::app()->createUrl("account/OrgEnable", array("userID"=>$data->manager->id))',
					'visible' => '$data->manager->type == User::DISABLED',
				),
				'disable' => array(
					'label' => 'Disable',
					'url' => 'Yii::app()->createUrl("account/OrgDisable", array("userID"=>$data->manager->id))',
					'visible' => '!($data->manager->type == User::DISABLED)',
				)
            ),
        ),
	),
)
)

?>
