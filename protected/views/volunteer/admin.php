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

<h1>Search Volunteers</h1>
<p>Here are your list of volunteers. You can also refine the list by searching.</p>

<?php echo CHtml::link('Search Volunteers','#',array('class'=>'search-button btn')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array('model'=>$model)); ?>
</div><!-- search-form -->

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-search-grid',
    'dataProvider'=>$model->search_volunteers(),
    'selectableRows' => 2,
    //'filter'=>$model,
    'columns'=>array(
        array(
            'name' => 'selectedNames',
            'class' => 'CCheckBoxColumn'
        ),
        'name',
        'email',
		array(
			'name' => 'Admin Access',
			'class'=> 'bootstrap.widgets.TbDataColumn',
			'value'=> '$data->adminAccess ? "Y" : "N"' 
			),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{adminAccess} {disable} {enable} {delete} ',
			'buttons'=> array(
				'adminAccess' => array(
					'label' => 'Log in',
					'url' => 'Yii::app()->createUrl("account/adminLogin", array("userID"=>$data->id))',
				),
				'delete' => array(
					'label' => 'Remove',
					'url' => 'Yii::app()->createUrl("volunteer/deleteVolunteer", array("userID"=>$data->id))',
				),
				'enable' => array(
					'label' => 'Enable',
					'url' => 'Yii::app()->createUrl("volunteer/volunteerEnable", array("userID"=>$data->id))',
					'visible' => '$data->type == User::DISABLEDVOLUNTEER',
				),
				'disable' => array(
					'label' => 'Disable',
					'url' => 'Yii::app()->createUrl("volunteer/volunteerDisable", array("userID"=>$data->id))',
					'visible' => '!($data->type == User::DISABLEDVOLUNTEER)',
				)
            ),
            ),
        ),
));

?>