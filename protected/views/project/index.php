<h1>Projects</h1>

<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
	                    'label'=> 'Create Project',
	                    'type' => 'primary',

	                    'htmlOptions'=>array(
		                    'data-toggle' => 'modal',
		                    'data-target' => '#project-modal',
		                    'href' =>Yii::app()->createUrl("project/create", array("asDialog"=>1)),
		                    'ajax'=>array(
			                    'type'=>'POST',
			                    // ajax post will use 'url' specified above
			                    'url'=>"js:$(this).attr('href')",
			                    'update'=>'#project-modal-body',
			                    'complete'=>"$('#project-modal').modal({show : true})",
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
