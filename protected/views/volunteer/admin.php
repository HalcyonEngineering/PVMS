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
            'class'=>'bootstrap.widgets.TbButtonColumn',
            ),
        ),
));

?>