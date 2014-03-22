<?php

$template = '{view}{update}';
if (Yii::app()->user->isManager()) {
	$template .= '{delete}';
}

$taskStatus = Lookup::items('TaskStatus');
if (Yii::app()->user->isVolunteer()){
	unset($taskStatus[3]);
}

$this->widget('bootstrap.widgets.TbGridView',
              array('id'=>'file-doc-grid',
                    'dataProvider'=>$dataProvider,
                    'template'=>'{items}',
                    'columns'=>array(
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'name',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'inputclass'=>'input-small',
		                          'apply'=>Yii::app()->user->isManager(),
		                          'emptytext'=>'Not Set',
	                          )
	                    ),
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'desc',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'inputclass'=>'input-large',
		                          'apply'=>Yii::app()->user->isManager(),
		                          'emptytext'=>'Not Set',
	                              'type'=>'textarea'
	                          )
	                    ),
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'expected',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'inputclass'=>'input-small',
		                          'apply'=>Yii::app()->user->isManager(),
		                          'emptytext'=>'Not Set',
	                          )
	                    ),
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'actual',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'inputclass'=>'input-small',
		                          'emptytext'=>'Not Set',
	                          )
	                    ),
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'status',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'type'=>'select',
		                          'source'=>$taskStatus,
	                          ),
	                    ),
	                    array('class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
	                          'template'=>$template,
	                          'viewButtonUrl'=>'Yii::app()->controller->createUrl("/task/view",array("id"=>$data->primaryKey))',
	                          'updateButtonUrl'=>'Yii::app()->controller->createUrl("/task/update",array("id"=>$data->primaryKey))',
	                          'deleteButtonUrl'=>'Yii::app()->controller->createUrl("/task/delete",array("id"=>$data->primaryKey))',

	                    ),
                    ),
              )
);
?>
