<center><?php
    $user = Yii::app()->user->name;
    echo "<h1>Hello, ". $user ."</h1>";
    ?>
<div style="width: 75%;">
<p> Pitch'n is is here to assist you manage your projects and volunteers. You can organize your volunteers using the Tabs on the side. If you have any questions please see the FAQ in the top right corner.</p> </div>
</center>
<hr> </hr>
<center>
<h3><b>Current Organization Status:</b></h3>
<h4> Number of Volunteers: <?php echo "<b>$volunteerProvider->itemCount</b>" ?></h4>
<h4> Number of Projects: <?php /*if($dataProvider->itemCount != 0) {*/echo "<b>$dataProvider->itemCount</b>"/*}*/?></h4>
    <?php if($volunteerProvider->itemCount == 0) : ?>
<!--/*        $csrfTokenName = Yii::app()->request->csrfTokenName;
        $csrfToken = Yii::app()->request->csrfToken;
        $this->widget('bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'link',
                'type' => 'primary',
                'label' => 'Add volunteers',
                'encodeLabel' =>false,
                'htmlOptions'=>array('submit'=>array('volunteer/add'),
                    'params'=>array($csrfTokenName=>$csrfToken,),
                    'title' => 'Add Volunteers',
                    'data-toggle'=>'tooltip',
                ),
            ));*/-->
        <div><i>You currently have no volunteers. <a href=<?php echo Yii::app()->createUrl('volunteer/add')?>><b>Click here</b></a> to view the "Add Volunteers" page to start adding volunteers</i></div>
    <?php endif; ?>
    <br><hr> </hr>
<h1>Projects</h1>
<?php if($dataProvider->itemCount != 0) : ?>
<p> Here are your projects. You can also create a new project by clicking on the button below</p>
<?php endif; ?>
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
'emptyText' =>'', //no real point to having anything for empty here //'<center><i>You currently have no projects, click the button above to create a new project</i></center>',
)); ?>
