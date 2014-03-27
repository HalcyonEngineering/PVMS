<?php 
	// (in the future) for educational purposes: a collapse button coded with a TbButton and JS
	//TODO: replace this jerryrig with a TbCollapse or something
	/*echo 'Upload a file:  ';
	$this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'link',
        'type' => 'primary', // the chrome of the button
        'label' => 'upload', // text of the button
        'htmlOptions' => array('onclick'=>"$('.upload-form').toggle();"),
        ));
	echo '<div class="upload-form" style="display:none">';

		$model=new FileDoc; //broken file upload form
		$model->project_id=1;

		$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'file-doc-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype' => 'multipart/form-data', 'id'=>'myidentifier'), //TODO: is this myidentifier thing enough to defuse the modal problems?
			)); 

			echo $form->errorSummary($model);
				
			echo $form->fileFieldRow($model,'uploadedfile',array());

			$this->widget('ModalSubmitButton', array( //basically broken here
						'modelName'=>'FileDoc',
						'label'=>'Create',
					));

		$this->endWidget();*/
 ?>
<?php

$template = '{download}{view}{update}';
if (Yii::app()->user->isManager()) {
	$template .= '{delete}';
}
$this->widget('bootstrap.widgets.TbGridView',
              array(
	              'id'=>'file-doc-grid',
	              'dataProvider'=>$dataProvider,
	              'columns'=> array(
		              'file_name',
		              'file_size',
		              //'file_data',
		              array(
			              'class'=>'bootstrap.widgets.TbButtonColumn', // buttoncolumn customized with documentation at: http://www.yiiframework.com/wiki/106/using-cbuttoncolumn-to-customize-buttons-in-cgridview/
			              'template'=>$template,
			              'buttons'=> array(
				              'download' => array(
					              'label'=>'Download file',
					              'imageUrl'=>Yii::app()->request->baseUrl.'/images/downloadSmall.png',
					              'icon' => 'circle-arrow-down',
					              'url'=>'Yii::app()->createUrl("fileDoc/download", array("id"=>$data->id))', //passes data over GET
					              'options' => array(
						              'confirm' => 'Download file?',
						              'target'=>'_blank',
					              ), // for opening download in new tab
				              ),
			              ),
			              'htmlOptions' => array(
				              'style'=>'width:80px'
			              ),
		              ),
	              ),
              )
);
?>
