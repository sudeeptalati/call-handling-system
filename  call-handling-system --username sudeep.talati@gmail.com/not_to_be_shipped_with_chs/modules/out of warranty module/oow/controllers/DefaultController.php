<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->redirect('index.php?r=oow/search/admin');
	}
}