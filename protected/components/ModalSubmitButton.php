<?php

class ModalSubmitButton extends CWidget{

	public $buttonOptions;
	public $modelName;
	public $label;

	public function init(){

		$this->buttonOptions = array(
			'buttonType'=> 'ajaxSubmit',
			'label'=> 'Missing Label',
			'type' => 'submit',
			//url has to be outside ajax options so it doesn't get overwritten.
			// YiiBooster doesn't have a check to see if url exists in ajax first.
			'url'=>"js:$(this).attr('href')",
		);

		$this->buttonOptions['htmlOptions'] = array(
			'id'=>"modal-submit",
			'href' => Yii::app()->request->getHostInfo().Yii::app()->request->url,
		);

		$this->buttonOptions['ajaxOptions'] = array(
			'type'=>'POST',
			// ajax post will use 'url' specified above
			'update'=>'#modal-body',
		);

		if(isset($this->label)){
			$this->buttonOptions['label'] = $this->label;
		}

		if(!isset($this->modelName)){
			$this->buttonOptions['label'] = 'Missing Model Name';
		} else {
			$this->buttonOptions['htmlOptions']['id'] = $this->modelName."-submit";
		}


	}

	public function run(){
		$this->controller->widget('bootstrap.widgets.TbButton',$this->buttonOptions);
	}
} 