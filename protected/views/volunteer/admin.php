<h1>Search Volunteers</h1>
<p>Here are all the volunteers in the system. You can also refine the list by searching.</p>

<?php
$this->widget('bootstrap.widgets.TbAlert');
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-search-grid',
    'dataProvider'=>$dataProvider,
    'selectableRows' => 2,
    'filter'=>$model,
    'emptyText'=>'<center><i>No volunteers here.</i></center>',
    'columns'=>array(
        'name',
        'email',
        'skillset',
        //array(
        //        'name' => 'Enabled',
        //        'class'=> 'bootstrap.widgets.TbDataColumn',
        //        'value'=> '$data !== null ? 
        //                ($data->type == User::DISABLEDVOLUNTEER ? "N" : "Y") 
        //                : "N"'
        //            ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'id'=>'AdminVS-ButtonColumn',
			'template'=>'{adminAccess} {disable} {enable} {delete} ',
			'buttons'=> array(
				'adminAccess' => array(
                                        'icon'=>'arrow-up',
					'label' => 'Log in',
					'url' => 'Yii::app()->createUrl("account/adminLogin", array("userID"=>$data->id))',
				),
				'delete' => array(
					'label' => 'Remove',
					'url' => 'Yii::app()->createUrl("volunteer/deleteVolunteer", array("userID"=>$data->id))',
				),
				'enable' => array(
					'label' => 'Enable',
                                        'icon'=>'ok',
					'url' => 'Yii::app()->createUrl("volunteer/volunteerEnable", array("userID"=>$data->id))',
					'visible' => '$data->type == User::DISABLEDVOLUNTEER',
				),
				'disable' => array(
                                        'icon'=>'ban-circle',
					'label' => 'Disable',
					'url' => 'Yii::app()->createUrl("volunteer/volunteerDisable", array("userID"=>$data->id))',
					'visible' => '!($data->type == User::DISABLEDVOLUNTEER)',
				)
            ),
            ),
        ),
));

?>
