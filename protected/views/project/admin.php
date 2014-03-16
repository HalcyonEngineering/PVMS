<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('project-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<?php
    $user = Yii::app()->user->name;
    echo "<h1>";
    echo "Welcome, ";
    echo $user;
    echo "</h1>";
    ?>
<p>Here are your projects. You can also create a new project by clicking on the button below</p></br>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'project-grid',
'dataProvider'=>$model->search(),
'selectableRows'=>2,
//'filter'=>$model,
'columns'=>array(
        array(
            'name' => 'selectedNames',
            'class' => 'CCheckBoxColumn'
        ),
		'id',
		'org_id',
		'name',
		'desc',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
