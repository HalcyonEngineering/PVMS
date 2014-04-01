<center><?php
    $user = Yii::app()->user->name;
    echo "<h1>Hello, ". $user ."</h1>";
    ?>
<p style="width:75%;">Welcome to your Administrator Dashboard. Here is a list of the Organizations that are registered with Pitchn. You can Log in, Disable and Delete these organizational accounts at will.</p>

</center>

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
    'columns'=>array(
		'name',
		'manager.name::Manager Name',
		'manager.email::Manager Email',
		'emptyText'=>'<center><i>No organizations here.</i></center>',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{adminAccess} {disable} {enable} {delete} ',
			'buttons'=> array(
				'adminAccess' => array(
					'label' => 'Log in',
                                        'icon'=>'arrow-up',
					'url' => 'Yii::app()->createUrl("account/adminLogin", array("userID"=>$data->manager->id))',
				),
				'enable' => array(
					'label' => 'Enable',
                                        'icon'=>'ok',
					'url' => 'Yii::app()->createUrl("account/OrgEnable", array("userID"=>$data->manager->id))',
					'visible' => '$data->manager->type == User::DISABLED',
				),
				'disable' => array(
					'label' => 'Disable',
                                        'icon'=>'ban-circle',
					'url' => 'Yii::app()->createUrl("account/OrgDisable", array("userID"=>$data->manager->id))',
					'visible' => '!($data->manager->type == User::DISABLED)',
				)
            ),
        ),
	),
)
)

?>
