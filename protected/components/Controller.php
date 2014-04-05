<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/**
	 * @var WebUser The currently logged in user.
	 */
	public $curUser;
	/**
	 * Our custom redirect. Uses yii's CController's redirect when it is a normal request and
	 * does a forced javascript redirect when it's an ajax redirect.
	 *
	 * @param mixed $url
	 * @param bool  $terminate
	 * @param int   $statusCode
	 */
	public function redirect($url, $terminate=true, $statusCode=302){
		if(is_array($url))
		{
			$route=isset($url[0]) ? $url[0] : '';
			$url=$this->createUrl($route,array_splice($url,1));
		}
		if(Yii::app()->request->isAjaxRequest){
			//HTML redirect.
			echo CHtml::script("window.location.href = '$url';");
		} else {
			parent::redirect($url,$terminate,$statusCode);
		}
	}

	/**
	 * Renders a view in a modal.
	 *
	 * If the request is an ajax request, this method calls {@link renderPartial} to render the view
	 * (called content view).
	 * Otherwise, it calls {@link render} to render the view.
	 *
	 * @param string $view name of the view to be rendered. See {@link getViewFile} for details
	 * about how the view script is resolved.
	 * @param array $data data to be extracted into PHP variables and made available to the view script
	 */
	public function renderModal($view,$data=null){
		if (Yii::app()->request->isAjaxRequest)
		{
			$this->renderPartial($view,$data,false,true);
			Yii::app()->end();
		} else {
			$this->render($view,$data);
		}
	}

	public function getCurUser(){
		if (!isset($this->curUser)){
			$this->curUser = Yii::app()->user;
		}
		return $this->curUser;
	}
}