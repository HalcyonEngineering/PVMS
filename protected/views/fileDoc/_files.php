<?php
echo CHtml::openTag('h1');
echo "Project Document List";
echo CHtml::closeTag('h1');
$template = '{download}';
if (Yii::app()->user->isManager()) {
	$template .= '{update}{delete}';
}
$this->widget('bootstrap.widgets.TbGridView',
              array(
	              'id'=>'file-doc-grid',
	              'dataProvider'=>$dataProvider,
	              'template'=>'{items}{summary}{pager}',

	              'columns'=> array(
		              'file_name',
		              array(
			              'class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
			              'template'=>$template,
			              'buttons'=> array(
				              'download' => array(
					              'label'=>'Download file',
					              'imageUrl'=>Yii::app()->request->baseUrl.'/images/downloadSmall.png',
					              'icon' => 'circle-arrow-down',
					              'url'=>'Yii::app()->createUrl("fileDoc/download", array("id"=>$data->id))', //passes data over GET
					              'options' => array(
						              'confirm' => 'Download file?',
						              'target'=>'_blank',
					              ), // for opening download in new tab
				              ),
			              ),
			              'htmlOptions' => array(
				              'style'=>'width:80px'
			              ),
			              'updateButtonUrl'=>'Yii::app()->controller->createUrl("/fileDoc/update",array("id"=>$data->id))',
			              'deleteButtonUrl'=>'Yii::app()->controller->createUrl("/fileDoc/delete",array("id"=>$data->id))',
		              ),
	              ),
              )
);
?>
