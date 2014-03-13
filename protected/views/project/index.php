<h1>Projects</h1>

<?php $this->widget('ModalOpenButton',
                    array(
	                    'button_id'=>'create-project-btn',
	                    'url' => Yii::app()->createUrl("project/create"),
	                    'label' => 'Create Project',
	                    'type' => 'primary',
                    ));
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
