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
																			'template'=>'{download}{view}{update}{delete}',
																			'buttons'=>array('download' => array('label'=>'Download file',
																									            'imageUrl'=>Yii::app()->request->baseUrl.'/images/downloadSmall.png',
																												//TODO: this would probably be better going through the 'icon' property (to go through the framework)
																								            	'url'=>'Yii::app()->createUrl("fileDoc/download", array("id"=>$data->id))', //passes data over GET
																								            	//'click' => 'js:function() { alert($data->id)); return false;}', // example of how we can't access data id variable outside 'url' (note: disregard the bad advice at http://stackoverflow.com/questions/5539526/access-to-the-data-variable-from-buttons-in-cgridview )
																										       	//'options'=> array(
																										       					// CHtml post style. Problems: no access to $data
																										       					//'submit'=>array('FileDoc/download'),
																																//'confirm' => 'Download file?',
																																//'params'=>array('id'=>1),

																																//ajax style. Problems: no access to $data, download echo getting lost (!!!)
																																//insired by: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/#c2788
																									       						/*'ajax'=>array('type'=>'POST', // this is the 'html' array but we specify the 'ajax' element
																																				'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
																										           								'data' => array('id'=> 1),
																										           								'update'=>'#secretIFrame', // should save to: <iframe id="secretIFrame" src="" style="display:none; visibility:hidden;"></iframe>
																										       									),*/
																										       					//),
																												'options' => array('confirm' => 'Download file?',
																																	'target'=>'_blank',) // for opening download in new tab
																								            ),
																			            	),
																			'htmlOptions' => array('style'=>'width:80px'),
															            	),
													            		),
									            		)
					); 
?>