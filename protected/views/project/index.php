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
			                    'update'=>'#project-modal-body',
			                    'complete'=>"$('#project-modal').modal('show')",
		                    ),
	                    ),
                    ));

?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
	'id'=>'project-modal',
	'options'=>array(
		'autoOpen'=>false, //important!
		),
	));
?>
<div id="project-modal-body" class="modal-body"></div>

<?php $this->endWidget();?>
