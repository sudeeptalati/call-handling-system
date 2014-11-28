<?php

class AuthenticationController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','authentication'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionAuthentication()
	{
		if(isset($_POST['email']) && isset($_POST["pwd"]))
		{
		$username=$_POST["email"];
		$pwd= $_POST["pwd"];
		$json_array=array();///declaring a blank array 
		$status='NOT_OK';
		$status_message='This is not status message';
		
		///checking the record in engineer model
		if($model=Engineer::model()->findByAttributes(array('engineer_email'=>$username,'pwd'=>$pwd)))
		{
			//$this->redirect('index.php?r=site/index');
			$json_array['engineer_email']=$model->engineer_email;
			$json_array['exp_date']=date('d-M-Y',$model->exp_date);
			$json_array['engineer_id']=$model->id;
			$exp_date_time=$model->exp_date;
			if ($exp_date_time > time())///checking if account is expired
			{
				$status='OK';
				$status_message='You have been successfully logged in';
		
			} ///end of if account is expired
			else
			{
				$status='ACCOUNT_EXPIRED';
				$status_message='Your account has been expired. Please contact us';
		
			}/// end of else
			
		}//end of if the record in engineer model
		else
		{
			$status='INVALID_LOGIN';
			$status_message='Your Email Id or password is incorrect';
		}///end of else the record in engineer model
		
		$json_array['status']=$status;
		$json_array['status_message']=$status_message;
		echo json_encode(array($json_array));
		}////end of isset
	}/// end of action authentication
	
}
