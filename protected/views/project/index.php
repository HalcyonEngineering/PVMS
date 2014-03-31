<center><?php
    $user = Yii::app()->user->name;
    echo "<h1>Hello, ". $user ."</h1>";
    ?>
<div style="width: 75%;">
<p> Pitch'n is is here to assist you manage your projects and volunteers. You can organize your volunteers using the Tabs on the side. If you have any questions please see the FAQ in the top right corner.</p> </div>
</center>
<hr> </hr>
<center>
<h2> Volunteers: <?php echo $volunteerProvider->itemCount.' in organization';?></h2>
<?php if($volunteerProvider->itemCount == 0) { 
$csrfTokenName = Yii::app()->request->csrfTokenName;
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
              ));
} ?>
<h2> Projects: <?php /*if($dataProvider->itemCount != 0) {*/echo $dataProvider->itemCount.' in organization';/*}*/?></h2>
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
'emptyText' =>'<center>Welcome to Pitch\'n. Create a new project above!</center>',
)); ?>
