<?php $this->widget('bootstrap.widgets.TbGridView',array('id'=>'file-doc-grid',
														'dataProvider'=>$dataProvider,
														'columns'=>array('name',
																		'desc',
																		'expected',
																		'actual',
																		'status',
																		array('class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
																			'template'=>'{view}{update}{delete}',
																			//maybe useful for later: copied code for creating more buttons. Add the corresponding entry to the template string above.
																			/*'buttons'=>array('download' => array('label'=>'Download file',
																									            'imageUrl'=>Yii::app()->request->baseUrl.'/images/downloadSmall.png',
																												'icon' => 'circle-arrow-down',
																								            	'url'=>'Yii::app()->createUrl("fileDoc/download", array("id"=>$data->id))', //passes data over GET
																												'options' => array('confirm' => 'Download file?',
																																	'target'=>'_blank',) // for opening download in new tab
																								            ),
																			            	),
																			'htmlOptions' => array('style'=>'width:80px'),*/
															            	),
													            		),
									            		)
					); 
?>
