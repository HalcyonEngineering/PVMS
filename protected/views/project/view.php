<h1>View Project #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'org_id',
		'name',
		'desc',
        'colour',
        'target',
),
)); ?>
