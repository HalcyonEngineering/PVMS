<?php

$template = '{view}';
if (Yii::app()->user->isManager()) {
	$template .= '{delete}';
}

$taskStatus = Lookup::items('TaskStatus');
if (Yii::app()->user->isVolunteer()){
	unset($taskStatus[Task::STATUS_COMPLETE_VERIFIED]);
}
$params=array();

if (Yii::app()->request->enableCsrfValidation) {
	$csrfTokenName = Yii::app()->request->csrfTokenName;
	$csrfToken = Yii::app()->request->csrfToken;
	if(!isset($params[$csrfTokenName])) {
		$params[$csrfTokenName] = $csrfToken;
	}
}
?>
<br>
<br>
<div><h2 style="margin-bottom:0em; line-height:0px;">Tasks </h2></div>
<?php
$this->widget('bootstrap.widgets.TbGridView',
              array('id'=>'task-grid',
                    'dataProvider'=>$dataProvider,
                    'template'=>'{items}',
                    'emptyText'=>'<center><i>No tasks here.</i></center>',
                    'columns'=>array(
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'name',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'inputclass'=>'input-small',
		                          'apply'=>Yii::app()->user->isManager(),
		                          'emptytext'=>'Not Set',
		                          'params'=>$params,
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
		                          'type'=>'textarea',
		                          'params'=>$params,
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
		                          'params'=>$params,
	                          )
	                    ),
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'actual',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'inputclass'=>'input-small',
		                          'emptytext'=>'Not Set',
		                          'params'=>$params,
	                          )
	                    ),
	                    array('class'=>'bootstrap.widgets.TbEditableColumn',
	                          'name'=>'status',
	                          'sortable'=>'true',
	                          'editable'=> array(
		                          'url'=>$this->createUrl('/task/dynamicUpdate'),
		                          'type'=>'select',
		                          'source'=>$taskStatus,
		                          'emptytext'=>'Complete (Verified)',
		                          'params'=>$params,
	                              'options'=>array(
		                              'emptyclass'=>'fake-empty',
									  'display'=> 'js: function(value, sourceData) {

									                // Putting this into scope.
									                var newText;

													// Iterate through data and set text to matching.
									                $(sourceData).each(function( index ) {
									                    if(value == sourceData[index].value){
									                        newText = sourceData[index].text;
									                    }
									                });
													// Set
									                $(this).html(newText);

									                // If value has no match, prevent changes.
									                // This works since status is always required.
									                // The unset verified status cannot be modified by volunteers.
									                // There is a server side check to be sure.
	                                                if (typeof newText === "undefined"){
		                                                $(this).off("click").click(function (e) {
		                                            e.preventDefault();
		                                      });
										  }
	                                    }',

	                              ),
	                          ),
	                    ),
	                    array('class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
	                          'template'=>$template,
	                          'viewButtonUrl'=>'Yii::app()->controller->createUrl("/task/view",array("id"=>$data->primaryKey))',
	                          'deleteButtonUrl'=>'Yii::app()->controller->createUrl("/task/delete",array("id"=>$data->primaryKey))',

	                    ),
                    ),
              )
);

//	echo CHtml::script('$().ready(function (){
//	$(".fake-empty").click(function(e) {
//		e.preventDefault();
//		});
//	});');
?>
