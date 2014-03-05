<h1>Projects</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
'id'=>'project-modal',
'options'=>array(
'title'=>'Detail view',
'autoOpen'=>false, //important!
'modal'=>true,
'width'=>550,
'height'=>470,
),
));
?>
<div id="project-modal"></div>
<?php $this->endWidget();?>