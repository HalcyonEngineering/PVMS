<center><?php
    $user = Yii::app()->user->name;
    echo "<h1>Hello, ". $user ."</h1>";
    ?>
<div style="width: 75%;">
<p> Pitch'n is is here to assist you manage your projects and volunteers. You can organize your volunteers using the Tabs on the side. If you have any questions please see the FAQ in the top right corner.</p> </div>
</center>
<hr> </hr>
<center>
<h2> Projects </h2>
<p> Here are your projects. You can also create a new project by clicking on the button below</p></br>

<?php $this->widget('ModalOpenButton',
                    array(
	                    'button_id'=>'create-project-btn',
	                    'url' => Yii::app()->createUrl("project/create"),
	                    'label' => 'Create Project',
	                    'type' => 'primary',
                    ));
?>
</center>
<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'template'=>"{pager}\n{items}\n{pager}",
)); ?>
