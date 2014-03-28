<?php

/**
 * Class ModalOpenButton
 * Creates a modal open button. This button opens a modal window.
 */
class ModalOpenButton extends CWidget{

	private $buttonOptions;
	public $style;
	public $label;
	public $type;
	public $button_id;
	public $url;
	public $encodeLabel = true;

	public function init(){
		$this-> buttonOptions = array(
			'label'=> 'Missing Label',
			'type' => 'primary',

			'htmlOptions'=>array(
				//Generate a unique id for each button.
				//Required to prevent id conflicts with the modal window.
				'id'=>'no-id',
				'href' => '#',
				'ajax'=>array(
					'type'=>'POST',
					// ajax post will use 'url' specified above
					'url'=>"js:$(this).attr('href')",
					'update'=>'#modal-body',
					'complete'=>"$('#modal').modal('show')",
				),
			),
		);
		if (isset($this->encodeLabel)) {
			$this->buttonOptions['encodeLabel'] = $this->encodeLabel;
		}

		if(isset($this->label)){
			$this->buttonOptions['label'] = $this->label;
		}

		if(isset($this->type)){
			$this->buttonOptions['type'] = $this->type;
		} else {
			$this->buttonOptions['type'] = 'primary';
		}

		if (isset($this->url)){
			$this->buttonOptions['htmlOptions']['href'] = $this->url;
		} else {
			$this->buttonOptions['label'] = 'Missing url';
		}

		if (isset($this->button_id)){
			$this->buttonOptions['htmlOptions']['id'] = $this->button_id;
		} else {
			$this->buttonOptions['label'] = 'Missing button id';
		}

		if(Yii::app()->request->enableCsrfValidation)
		{
			$csrfTokenName = Yii::app()->request->csrfTokenName;
			$csrfToken = Yii::app()->request->csrfToken;
			$csrf = "$csrfTokenName=$csrfToken";
			if(!isset($this->buttonOptions['htmlOptions']['ajax']['data'])) {
				$this->buttonOptions['htmlOptions']['ajax']['data'] = $csrf;
			}
		}
		if(isset($this->style)){
			$this->buttonOptions['htmlOptions']['style'];
		}
	}

	public function run(){
		$this->widget('bootstrap.widgets.TbButton',$this->buttonOptions);
	}
}
