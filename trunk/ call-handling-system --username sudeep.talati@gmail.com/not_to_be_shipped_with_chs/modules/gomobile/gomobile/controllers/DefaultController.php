<?php

class DefaultController extends RController
{
	public function actionIndex()
	{
		$this->renderpartial('index');
	}
		
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

}