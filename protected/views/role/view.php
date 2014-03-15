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
<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
                          'url' => Yii::app()->createUrl("project/#"),
                          'label' => 'Project Doc Repository<NEED LINK>',
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