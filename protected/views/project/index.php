<h1>Projects</h1>

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