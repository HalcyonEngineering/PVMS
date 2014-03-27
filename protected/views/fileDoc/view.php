<?php
$this->breadcrumbs=array(
	'File Docs'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List FileDoc','url'=>array('index')),
array('label'=>'Create FileDoc','url'=>array('create')),
array('label'=>'Update FileDoc','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete FileDoc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FileDoc','url'=>array('admin')),
);
?>

<h1>View FileDoc #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'project_id',
		'file_name',
		'file_size',
		/*'file_data',*/
),
)); ?>

<?php 
// for educational purposes: alternate simple CHtml button version from http://stackoverflow.com/questions/14189872/yii-chtmlbutton-and-post-request-to-controller
// also see: http://www.yiiframework.com/wiki/48/by-example-chtml/
/*echo CHtml::button('Download', array('submit'=>array('FileDoc/download'),
										'confirm' => 'Download file?',
										'params'=>array('id'=>$model->id),)); */?>

<?php 

// bootstrap button post version.
$this->widget(
    'bootstrap.widgets.TbButton',
    //GET button
    array(
        'buttonType' => 'link',
        'type' => 'primary', // the chrome of the button
        'label' => 'download', // text of the button
        'url'=>Yii::app()->createUrl("fileDoc/download", array("id"=>$model->id)),
        'htmlOptions' => array('confirm' => 'Download file?',
                                'target'=>'_blank',
                                ),
        )
    
    // for educational purposes: alternate TbButton POST version 
    /*array(
    'buttonType' => 'submit',
    'type' => 'primary', // the chrome of the button
    'label' => 'download', // text of the button
    'htmlOptions' => array('submit'=>array('FileDoc/download'), // htmloptions trick got from http://stackoverflow.com/questions/17698065/tbbutton-not-sending-data-in-post-to-the-controller
                            'confirm' => 'Download file?',
                            'params'=>array('id'=>$model->id), //POST parameter
                            ),
    )*/
    
    ); ?>