<?php

class GomobileModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'gomobile.models.*',
			'gomobile.components.*',
		));
		
		$url = 	Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.gomobile.assets'));	
		Yii::app()->clientScript->registerCssFile($url.'\css\gomobile.css') ;
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
