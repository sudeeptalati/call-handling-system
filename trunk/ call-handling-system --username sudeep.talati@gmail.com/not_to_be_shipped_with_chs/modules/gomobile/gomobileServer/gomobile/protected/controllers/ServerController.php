<?php

class ServerController extends Controller
{
	public function actionIndex()
	{
		
		header('Access-Control-Allow-Origin: *');  
		$datareceived=$_POST['jsonData'];
		//$datareceived='{"Details":[{"id":"27422","servicecall_number":"125685","engineer_id":"90000000","servicecall":{"service_reference_number":"125685","fault_description":"installation fail","fault_date":"1410300000","product_id":"22207","job_finished_date":"","customer|town":"dewas"},"customer":{"name":" Purva"}},{"id":"27423","servicecall_number":"125686","engineer_id":"564","servicecall":{"service_reference_number":"125686","fault_description":"installation fail","fault_date":"1410300000","product_id":"22208","job_finished_date":"","customer|town":"dewas"},"customer":{"name":" Purva"}},{"id":"27424","servicecall_number":"125687","engineer_id":"435","servicecall":{"service_reference_number":"125687","fault_description":"installation failed","fault_date":"1410300000","product_id":"22208","job_finished_date":"","customer|town":"dewas"},"customer":{"name":" Purva"}},{"id":"27425","servicecall_number":"125688","engineer_id":"403","servicecall":{"service_reference_number":"125688","fault_description":"installation failed","fault_date":"1410300000","product_id":"22209","job_finished_date":"","customer|town":"SWINDON"},"customer":{"name":" Purva"}}]} ';
		$servicecalls=array();
		$sent_servicecalls=array();
		$unsent_servicecalls=array();
		
		$datareceived_array=(array)json_decode($datareceived, true); 
		
		foreach($datareceived_array as $datareceived_array_value)
		{
			
			foreach ($datareceived_array_value as $p)
			{
				$service_reference_number=$p['service_reference_number'];	
				$engineer_email=$p['engineer_email'];
				if($this->ifengineeremailexists($engineer_email))//calling function
				{
					$model=new EngineerData;
					$model->engineer_email=$engineer_email;
					$x=array();
					$x['service_reference_number']=$service_reference_number;
					$x['engineer_email']=$engineer_email;
					$x['customer_fullname']=$p['customer_fullname'];
					$x['customer_postcode']=$p['customer_postcode'];
					$x['data']=$p['servicecall'];
					$model->data=json_encode($x);
					$model->data_status_id='1';///since 1 is recvd from CHS
					$ar=array();
					if($model->save())
						{
						$ar['service_reference_number']=$service_reference_number;
						$ar['message']='Servicecall Sent';
						}///end of if $model->save
					else
						{
						$ar['service_reference_number']=$service_reference_number;
						$ar['message']='Servicecall cannot be saved on the server. Please try again.';
						}///end of else $model->save
						
					array_push($sent_servicecalls,$ar);	
				}///end of ifengineeremailexists
				else
				{	
					$ar=array();
					$ar['service_reference_number']=$service_reference_number;
					$ar['message']='Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk';

					array_push($unsent_servicecalls,$ar);	
				}///end of else ifengineeremailexists
			}///end iof foreach($datareceived_array_value as $p)
			
			$servicecalls['unsent_servicecalls']=$unsent_servicecalls;
			$servicecalls['sent_servicecalls']=$sent_servicecalls; 
			echo json_encode($servicecalls);
		}///end of foreach ($datareceived_array as $datareceived_array_value)
		
	}///end of  actionIndex
	
	////////creating function Getengineerdataformobile
	public function actionGetengineerdataformobile()
	{
		$engineer_email=$_GET['engineer_email'];
		$engineer_pwd=$_GET['pwd'];
		
		if($this->verifyengineer($engineer_email,$engineer_pwd))
		{
		$engineer_model=EngineerData::model()->findAllByAttributes(array('engineer_email'=>$engineer_email,'data_status_id'=>'1'));
		$myarray=array();
		foreach ($engineer_model as $data)
			{
			array_push($myarray,json_decode($data->data));
			$this->deleteengineerdatarecord($data->id);
			}///end of foreach $engineer_model as $data
			echo json_encode($myarray);
		}////end of if verifyengineer
		else
		{
			echo json_encode(array('message'=>'INVALID ENGINEER'));
		}///end of else verifyengineer
	}/////end of actionGetengineerdataformobile
	
	public function actionGetdatafrommobile()
	{
		$status="";
		$status_message="";
		$engineer_email=$_GET['engineer_email'];
		$engineer_pwd=$_GET['pwd'];
		if($this->verifyengineer($engineer_email,$engineer_pwd))
		{
			$getdata=$_GET['data'];
			$model=new EngineerData;
			$model->engineer_email=$engineer_email;
			$model->data=$getdata;
			$model->data_status_id=3;
				if($model->save())
				{
				$status="OK";
				$status_message='Servicecall has been received and saved on the server.';
				}//end of if model save
				else
				{
				$status="FAILED";
				$status_message='Servicecall not saved on the server';
				}///end of else
				echo json_encode(array('status'=>$status,'status_message'=>$status_message));
		}///end of if verifyengineer
		else
		{
			echo json_encode(array('status'=>'FAILED','status_message'=>' The username or password is incorrect. Please try again.'));
		}///end of else verifyengineer
	}///end of actiongetdatafrommobile

	
	public function actionGetdatafordesktop()
	{
	$engineer_data_model=EngineerData::model()->findByAttributes(array('data_status_id'=>'3'));
	echo $engineer_data_model->data;
	}///end of actionGetdatafordesktop
	
	
	
	public function deleteengineerdatarecord($id)
	{
		$engineer_data_model=EngineerData::model()->findByPk($id);
		if($engineer_data_model===null)
			throw new CHttpException(404,'The requested page does not exist.');
			$engineer_data_model->delete();
	
	}////end of deleteengineerdatarecords
	
	public function verifyengineer($engineer_email,$engineer_pwd)
	{
		if (Engineer::model()->findByAttributes(array('engineer_email'=>$engineer_email,'pwd'=>$engineer_pwd)))
			return true;
		else
			return false;
	}//end of verifyengineer
	
	public function ifengineeremailexists($engineer_email)
	{
		if (Engineer::model()->findByAttributes(array('engineer_email'=>$engineer_email)))
			return true;
		else
			return false;
	}
	
}