<div class="span-9 pull-right" ><!--Buttons-->
<div class="span-3" style="padding:5px;" >
<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
                          'url' => Yii::app()->createUrl("role/index"),
                          'label' => 'Back to Roles',
                          ));
    ?>
</div>
<div class="span-3" style="padding:5px;" >

<?php $this->widget('ModalOpenButton',
                    array(
                          'button_id'=>'project-doc-repo-btn',
                          'url' => Yii::app()->createUrl("fileDoc/Index"),
                          'label' => 'Project Doc Repository',
                          'type' => 'common',
                          ));
    ?>

</div>
<div class="span-3" style="padding:5px;" >
<?php $this->widget('ModalOpenButton',
                    array(
                      'button_id'=>'list-tasks-btn',
                      'url' => Yii::app()->createUrl("task/listTasks",array("role_id"=>$model->id)),
                      'label' => 'View tasks in project',
                      'type' => 'common',
                    ));
?>
</div>
<div class="span-3" style="padding:5px;" >
<?php $this->widget('ModalOpenButton',
                    array(
                      'button_id'=>'create-task-btn',
                      'url' => Yii::app()->createUrl("task/create",array("role_id"=>$model->id)),
                      'label' => 'Create task in project',
                      'type' => 'common',
                    ));
?>
</div>
</div><!--End of Buttons-->

<h1> <?php echo $model->name; ?></h1>

<p><?php echo $model->desc; ?></p>

<h3>Tasks:</h3>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'project_id',
),
));
?>


<div class="span-3" style="padding:5px;" >
<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
                          'url' => Yii::app()->createUrl("#"),
                          'label' => 'Save<NEED Functionality>',
                          ));
    ?>
</div>