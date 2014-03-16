<div class="span-9 pull-right" ><!--Buttons-->
<div class="span-3" style="padding:5px;" >
<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
                          'url' => Yii::app()->createUrl("project/index"),
                          'label' => 'Back to Projects',
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
</div><!--End of Buttons-->

<h1> <?php echo $model->name; ?></h1>

<p><?php echo $model->desc; ?> </p>

<p> <?php $target = $model->target; if ($target!=null)echo "Target Date: ".$model->target; ?> </p>

<h3> Volunteers and Roles</h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'org_id',
        'colour',
),
)); ?>

<div class="span-3" style="padding:5px;" >

<?php $this->widget('ModalOpenButton',
                    array(
                          'button_id'=>'add-role-btn',
                          'url' => Yii::app()->createUrl("role/create"),
                          'label' => 'Add Role',
                          'type' => 'common',
                          ));
    ?>
</div>

