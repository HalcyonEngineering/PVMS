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

echo CHtml::beginForm();

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-search-grid',
    // Need to make sure only volunteers in manager's org show up
    'dataProvider'=>$model->search_volunteers_in_org(Yii::app()->user->getManagedOrg()),
    'selectableRows' => 2,
    //'filter'=>$model,
    'columns'=>array(
            array(
                'id' => 'selectedIds',
                'class' => 'CCheckBoxColumn'
            ),
            'email',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
            ),
        ),
)); 

echo CHtml::submitButton('Submit', array('name'=>'EmailVolunteersButton', 'submit'=>'email'));
echo CHtml::endForm();

?>
