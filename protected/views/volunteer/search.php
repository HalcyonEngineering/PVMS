<h1>Search Volunteers</h1>
<p>Here are your list of volunteers. You can also refine the list by searching.</p>

<?php $this->renderPartial('_search', array('model'=>$model)); ?>

<?php 

echo CHtml::beginForm();

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-search-grid',
    'dataProvider'=>$data,
    'selectableRows' => 2,
    'columns'=>array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'name',
        'location',
        'skillset',
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
$list = CHtml::listData($models, 'id', 'name');
asort($list);

echo 'Add selected volunteers to role: ';
echo CHtml::dropDownList('role_list', 'empty', $list, array('empty' => '(Select a role to assign)'));
echo '  ';
echo CHtml::submitButton('Confirm', array('submit'=>'search'));
echo CHtml::endForm();

?>
