<?php
    $user = Yii::app()->user->name;
    echo "<h1>";
    echo "Welcome, ";
    echo $user;
    echo "</h1>";
    ?>
<p>Here are your projects. You can also create a new project by clicking on the button below</p></br>





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
'template'=>"{pager}\n{items}\n{pager}",
)); ?>
