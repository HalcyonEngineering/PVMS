<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List FileDoc','url'=>array('index')),
array('label'=>'Create FileDoc','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('file-doc-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage File Docs</h1>

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

<?php $this->widget('bootstrap.widgets.TbGridView',array('id'=>'file-doc-grid',
														'dataProvider'=>$model->search(),
														'filter'=>$model,
														'columns'=>array('id',
																		'project_id',
																		'file_name',
																		'file_size',
																		'file_data',
																		array('class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
																				'template'=>'{email}{view}{update}{delete}',
    																			'buttons'=>array('email' => array('label'=>'Download file',
																										            'imageUrl'=>Yii::app()->request->baseUrl.'/images/Notificationbutton.png',
																										            // note: data can be passed over GET like this: 'url'=>'Yii::app()->createUrl("fileDoc/create", array("id"=>$data->id))',
																									            	'url'=>'Yii::app()->createUrl("fileDoc/download", array("id"=>$data->id))',
																									            	//'click' => 'js:function() { alert($data->id)); return false;}', // access to data id variable: http://stackoverflow.com/questions/5539526/access-to-the-data-variable-from-buttons-in-cgridview
																									            	),
																				            	),
															            		),
													            		)
									            		)
					); 
?>
