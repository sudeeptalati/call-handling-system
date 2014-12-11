<?php

class DefaultController extends Controller
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
	
	public function actionAccountsetup()
	{
	$this->render('accountsetup');
	
	}///end of accountsetup
	
	public function actionAccountsetupview()
	{
	
	
	$account_id=$_POST['account_id'];
	$id=$_POST['advance_parameter_id'];
	$advancesettingsmodel=AdvanceSettings::model()->findByPK(array('id'=>$id));
	$advancesettingsmodel->value=$account_id;
	if ($advancesettingsmodel->save())
		$this->render('accountsetup_view', array('account_id'=>$account_id));
	
	}///end of accountsetupview
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	
	

}