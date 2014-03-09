<h1>Projects</h1>

<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
	                    'label'=> 'Create Project',
	                    'type' => 'primary',
						'id'=>'create-project-btn',
	                    'htmlOptions'=>array(
		                    'href' =>Yii::app()->createUrl("project/create"),
		                    'ajax'=>array(
			                    'type'=>'POST',
			                    // ajax post will use 'url' specified above
			                    'url'=>"js:$(this).attr('href')",
			                    'update'=>'#modal-body',
			                    'complete'=>"$('#modal').modal('show')",
		                    ),
	                    ),
                    ));

?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
