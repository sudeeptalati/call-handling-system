<?php

class DefaultController extends RController
{
	public function actionIndex()
	{

		$this->render('index');
	}///end of index
	
	public function actionPostdatatoserver()
	{
	$this->render('postdata');
	}///end of PostDatatoServer
	
	public function actionJobstatusselectionofservicecall()
	{
	$this->render('Jobstatusselectionofservicecall');
	}///end of Jobstatusselectionofservicecall
	
	public function actionDatabyappointmentdate()
	{
		$this->render('Databyappointmentdate');
	}///end of Databyappointmentdate
	
		
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	
	

}