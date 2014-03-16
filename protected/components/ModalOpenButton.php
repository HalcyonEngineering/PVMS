<?php

class ModalOpenButton extends CWidget{

	public $buttonOptions;
	public $label;
	public $type;
	public $button_id;
	public $url;

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
	}

	public function run(){
		$this->widget('bootstrap.widgets.TbButton',$this->buttonOptions);
	}
} 