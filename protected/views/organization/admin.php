<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('organization-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<?php
    $user = Yii::app()->user->name;
    echo "<h1>Welcome, ".$user."!</h1>";
?>
<p>Here are all the organizations that are using Pitch'n's Management Dashboard.</p>
<br>
<br>
<p>	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
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
'id'=>'organization-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'emptyText'=>'<center><i>No organizations here.</i></center>',
'columns'=>array(
		'id',
		'name',
		'desc',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
