<?php 
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array(), // success, info, warning, error or danger
            'error'=>array(), // success, info, warning, error or danger
        ),
    ));
?>
<h1>Search Volunteers</h1>
<p>Here are your list of volunteers. You can also refine the list by searching.</p>
<?php $this->renderPartial('_search', array('model'=>$model)); ?>

<?php 

echo CHtml::beginForm();

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-search-grid',
    'dataProvider'=>$data,
    'selectableRows' => 2,
    'emptyText'=>'<center><i>You have no volunteers. Add volunteers to the left.</i></center>',
    'columns'=>array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'name',
        'location',
        'skillset',
        array(
            'name' => 'Availability',
            'class'=> 'bootstrap.widgets.TbDataColumn',
            'value'=> 'User::availabilityString($data->availability)',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{remove}',
            'buttons'=>array(
                'remove'=>array(
                    'label'=>'Remove from organization',
                    'icon' => 'trash',
                    'url'=>'Yii::app()->createUrl("volunteer/remove",array("id"=>$data->id))',
                    'options'=>array('confirm'=>'Are you sure you want to remove this volunteer from your organization?')
                ),
            ),
        ),
    ),
)); 

$models = Yii::app()->user->getManagedOrg()->roles;
$list = CHtml::listData($models, 'id', function($model) {return $model->name.' -- '.$model->project->name;});
asort($list);
echo 'Add selected volunteers to role: ';
echo CHtml::dropDownList('role_list', 'empty', $list, array('empty' => '(Select a role to assign)'));
echo '  ';
echo CHtml::submitButton('Confirm', array('submit'=>'search'));
?>


<?php
echo CHtml::submitButton('Mail selected', array(
    'submit'=>$this->createURL('//message/bulkMail'),
	'class'=>'pull-right',
));
echo CHtml::endForm();
?>
