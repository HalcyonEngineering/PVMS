<?php

	/**
	 * Class ModalSubmitButton
	 * Submit button to be used in a modal.
	 *
	 * This button generates a random id to avoid name clashes with other ids.
	 * This helps us avoid javascript name conflicts where actions may give
	 * different results depending on the id of element.
	 *

	 *
	 */
class ModalSubmitButton extends CWidget{

	/**
	 * @var $buttonOptions array Options for the button.
	 */
	private $buttonOptions;
	/**
	 * @var $modelName string Name of the model.
	 * @deprecated
	 */
	public $modelName;
	/**
	 * @var $label string Label on the button.
	 */
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


		$this->buttonOptions['htmlOptions']['id'] = "btn-submit-".uniqid($this->modelName);



	}

	public function run(){
		$this->controller->widget('bootstrap.widgets.TbButton',$this->buttonOptions);
	}
} 
