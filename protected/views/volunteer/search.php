<h1>Search Volunteers</h1>
<p>Here are your list of volunteers. You can also refine the list by searching.</p>

<?php $this->renderPartial('_search', array('model'=>$model)); ?>

<?php 

echo CHtml::beginForm();

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-search-grid',
    // Need to make sure only volunteers in manager's org show up
    //'dataProvider'=>$model->search_volunteers_in_org(Yii::app()->user->getManagedOrg()),
    'dataProvider'=>$data,
    'selectableRows' => 2,
    //'filter'=>$model,
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
            ),
        ),
)); 

$models = Yii::app()->user->getManagedOrg()->roles;
$list = CHtml::listData($models, 'id', 'name');

echo 'Add selected volunteers to role: ';
echo CHtml::dropDownList('role_list', 'empty', $list, array('empty' => '(Select a role to assign)'));
echo '  ';
echo CHtml::submitButton('Confirm', array('submit'=>'search'));
echo CHtml::endForm();

?>