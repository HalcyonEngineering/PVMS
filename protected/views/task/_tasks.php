<?php $this->widget('bootstrap.widgets.TbGridView',array('id'=>'file-doc-grid',
														'dataProvider'=>$dataProvider,
														'columns'=>array('name',
																		'desc',
																		'expected',
																		'actual',
																		'status',
																		array('class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
																			'template'=>$template,
															            	),
													            		),
									            		)
					); 
?>
